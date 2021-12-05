@component('mail::message')
# Confirm Email

Silahkan klik link di bawah untuk konfirmasi email anda
Batas link dapat dibuka adalah 1 jam
@component('mail::table')
| | | |
| :------------- | :------------ | --------:|
| <img src="https://via.placeholder.com/150" width="50px"> | Paralauang | $10 |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent