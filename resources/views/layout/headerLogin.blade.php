<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(gambar/latar.jpg)">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-6.5 text-center">

                <div class="row row-mt-15em">
                    @guest
                    <div class="logout">
                        <div class="col-md-7 col-md-push-1 mt-text animate-box mobile-info" data-animate-effect="fadeInUp">
                            <h1>PANDAN SARI</h1>
                            <span class="intro-text-small">Dive & Watersport</span>
                        </div>
                        <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
                            <div class="form-wrap">
                                <div class="tab">
                                    <ul class="tab-menu">
                                        <li class="active gtco-first"><a href="#" data-tab="login">Login</a>
                                        </li>
                                        <li class="gtco-second"><a href="#" data-tab="signup">Sign Up</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-content-inner" data-content="signup">
                                            <form action="{{ route('register') }}" method="POST" id="form-signup"
                                                validated='false'>
                                                @csrf
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="email">Email</label>
                                                        <input type="email" id="regEmail" required class="form-control"
                                                            name="email">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="password">Password</label>
                                                        <input type="password" required class="form-control"
                                                            name="password" id="pw1">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="password2">Repeat Password</label>
                                                        <input type="password" required class="form-control"
                                                            name="password2" id="pw2">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <input type="submit" class="btn btn-primary" value="Sign up">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-content-inner active" data-content="login">
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                @if(session('success'))
                                                <div class="alert alert-success alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">&times;</button>
                                                    {{session('success')}}
                                                </div>
                                                @elseif(session('error'))
                                                <div class="alert alert-danger alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">&times;</button>
                                                    {{session('error')}}
                                                </div>
                                                @endif
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="username">Email</label>
                                                        <input required type="email" class="form-control" name="email"
                                                            value="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="password">Password</label>
                                                        <input required type="password" class="form-control"
                                                            name="password">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <input type="submit" class="btn btn-primary" value="Login">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-md-push-1 mt-text animate-box desktop-info" data-animate-effect="fadeInUp">
                            <h1>PANDAN SARI</h1>
                            <span class="intro-text-small">Dive & Watersport</span>
                        </div>
                    </div>
                    @endguest

                    @auth
                    <div class="login">
                        <div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
                            <h1>PANDAN SARI</h1>
                            <span class="intro-text-small">Dive & Watersport</span>
                        </div>
                    </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</header>