<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use App\Mail\ResetPassword;
use App\Models\Cart;
use App\Models\PasswordReset;
use App\Models\TokenUser;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = base64_encode(random_bytes(20));
        TokenUser::create([
            'email' => $request->email,
            'token' => $token
        ]);
        Mail::to($request->email)->send(new ConfirmEmail($request->email, $token));
        return redirect()->route('home')->with(['success' => 'Berhasil daftar, silahkan cek email untuk login']);
    }

    public function emailCheck(Request $request)
    {
        $cek = User::where('email', $request->email)->first();
        if ($cek) return response()->json('fail', 500);
        else return response()->json('success');
    }

    public function confirm(Request $request)
    {
        $email = $request->email;
        $token = urldecode($request->token);

        $user = TokenUser::where('email', $email)->firstOrFail();
        $expire = new DateTime($user->created_at);
        $expire->modify('+1 hour');
        if (strcmp($token, $user->token) == 0) {
            $usr = User::where('email', $email)->first();
            $usr->is_active = 1;
            $usr->save();
            $user->delete();
            return redirect()->route('home')->with(['success' => 'Konfirmasi berhasil silahkan Login']);
        }
        return redirect()->route('home')->with(['error' => 'Link Expired']);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $cre = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($cre)) {
            if ($user && $user->is_active == 0 && $user->role != 1) {
                Auth::logout();
                return redirect()->route('home')->with('error', 'Akun anda belum di verifikasi.')->withInput();
            } else if ($user && $user->role == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                $booking = Cart::where('user_id', $user->id)->where('status', 'unpaid')->get()->count();
                $request->session()->put('booking', $booking);
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home')->with('error', 'Email atau Password anda salah')->withInput();
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('booking');
        $request->session()->flush();
        return redirect()->route('home');
    }

    public function lupapassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->is_active == 0 && $user->role != 1) {
                return redirect()->route('lupapassword')->with('error', 'Akun anda belum di verifikasi. Silahkan cek email untuk verifikasi terlebih dahulu.')->withInput();
            } else {
                PasswordReset::where('email', $request->email)->delete();
                $tok = base64_encode(random_bytes(17));
                PasswordReset::insert([
                    'email' => $request->email,
                    'token' => $tok,
                    'created_at' => Carbon::now()
                ]);
                Mail::to($request->email)->send(new ResetPassword($request->email, $tok));
                return redirect()->route('lupapassword')->with('success', 'Silahkan Cek Email Anda.');
            }
        } else {
            return redirect()->route('lupapassword')->with('error', 'Email ini tidak terdaftar')->withInput();
        }
    }

    public function reset(Request $request)
    {
        $email = $request->email;
        $token = urldecode($request->token);

        $user = PasswordReset::where('email', $email)->firstOrFail();
        $expire = new DateTime($user->created_at);
        $expire->modify('+1 hour');
        if (new DateTime() < $expire) {
            if (strcmp($token, $user->token) == 0) {
                return view('resetpw');
            }
        }
        return redirect()->route('lupapassword')->with('error', 'Link Expired');
    }

    public function postReset(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $rules = [
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ];
        $messages = [
            'required' => 'Tolong :attribute di isi',
            'confirmPassword.same' => 'Password haruslah sama',
        ];
        $valid = Validator::make($request->all(), $rules, $messages);
        if ($valid->fails()) {
            return redirect()->route('resetPass', ['email' => $email, 'token' => $token])->withErrors($valid)->withInput();
        }
        $user = User::where('email', $email)->first();
        if (Hash::check($request->password, $user->password)) return redirect()->route('resetPass', ['email' => $email, 'token' => $token])->with('status', 'Password anda sama dengan sebelumnya, silahkan gunakan password yang lain');
        $user->password = Hash::make($request->password);
        $user->save();
        PasswordReset::where('email', $email)->delete();
        return redirect()->route('home')->with('success', 'Password berhasil diubah silahkan login');
    }
}
