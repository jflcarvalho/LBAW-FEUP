@extends('layouts.head')

@section('body')
<body>
<header class="sticky-top">
    <div id="navbar" class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <!-- Logo -->
            <a class="navbar-brand py-0 order-0 mr-0 mr-sm-3"href="{{ url('questions/recent') }}">
                <img src="{{ asset('img/logo.png') }}" width="40" height="40" class="d-inline-block align-center" alt="">
                <span>SegFault</span>
            </a>

            <!-- Collapse Menu -->
            <button class="navbar-toggler mr-auto-sm order-2 ml-sm-3" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-sm-1 ml-3" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link @if(strcmp(Request::segment(1), 'questions') == 0) <?="active"?>  @endif" href="{{ route('recent_questions') }}">Questions
                        <span class="sr-only">(current)</span>
                    </a>
                    <a class="nav-item nav-link @if(strcmp(Request::segment(1), 'tags') == 0) <?="active"?>  @endif" href="{{ url('tags') }}">Categories</a>
                </div>

                <!-- Search Bar -->
                <form class="form-inline" method="GET" action="{{ url('questions') }}">
                    <input id="search-input-nav" class="form-control mx-sm-2" type="text" name="search" placeholder="Search" aria-label="Search"
                    @if(isset($_GET['search'])) <?php echo 'value="' . htmlspecialchars($_GET['search']) . '"' ?> @endif>
                    <button id="search-button-nav" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

            <!-- START OF NAVBAR RIGHT-SIDE OPTIONS -->
            <div class="ml-auto-sm px-0 order-1 order-sm-2 d-flex justify-content-between justify-content-sm-end">

            @if (Auth::check())
                <!-- Notifications Dropdown -->
                    <div class="dropdown mx-2">
                        <div class="big-icon" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                            <div class="pt-1">
                                <i class="fa fa-bell"></i>
                            </div>
                            <div id="unread-notification" class="notify">
                                <span class="heartbit"></span>
                                <span class="point"></span>
                            </div>
                        </div>
                        <div id="drop-notifications" class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="notifications">
                            <div id="notificationsHeader">Notifications</div>
                            <div id="notificationsMenu">
                                <span class="text-center">No Unread Notifications.</span>
                                <!-- Notifications populated with JS -->
                            </div>
                        </div>
                    </div>

                    <!-- Options Dropdown-->
                    <div class="dropdown px-1">
                    <span class="big-icon mx-2" id="profile-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                        <img class="rounded-circle" src="<?=Auth::user()->getImage('profile')?>" alt="profile picture">
                    </span>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profile-options">
                            <a href="{{ route('profile') }}" class="dropdown-item" role="button">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('settings', ['username' => Auth::user()->username]) }}" class="dropdown-item" role="button">Settings</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                {{ csrf_field() }}
                                <button id="login" type="submit" class="dropdown-item">Log out</button>
                            </form>
                        </div>
                    </div>

            </div>

        @else
            <!-- Sign In/Sign Up -->
                <div class="dropdown mx-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        Sign In
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form id="signin_form" class="px-4 py-3" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input id="email" class="form-control" type="text" name="email"  placeholder="email@example.com" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password" >Password</label>
                                <input id="password" class="form-control" type="password" name="password" placeholder="Password" required>
                            </div>

                            <div class="form-check">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>

                            <button id="login" type="submit" class="btn btn-primary btn-signin">Sign in</button>


                            <!-- Sign-In with External APIs: GitHub and Google -->
                            <a href="{{ url('/auth/github') }}" class="btn btn-github btn-social btn-signin mt-0">
                                <i class="fab fa-github"></i>
                                <div class="mx-2">Sign in with Github</div>
                            </a>
                            <a href="{{ url('/auth/google') }}" class="btn btn-google btn-social btn-signin mt-0">
                                <i class="fab fa-google"></i>
                                <div class="mx-2">Sign in with Google</div>
                            </a>

                        </form>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('register') }}">New around here? Sign up</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/password/reset') }}">Forgot Password? Click here!</a>
                    </div>
                </div>

                <!-- Sign up -->
                <div class="dropdown mx-2">
                    <a class="btn btn-outline-success" href="{{ route('register') }}" role="button">Sign Up!</a>
                </div>

                <!-- END OF NAVBAR RIGHT-SIDE OPTIONS -->
            @endif

        </nav>
    </div>
    <div class="container-messages">
        @if ($errors->isNotEmpty())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <div>{{ $error }}</div>
                            <button type="button" class="close" style="position: inherit; padding: inherit" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @yield('question-title')
</header>

<main>
    @yield('content')
</main>

<footer class="bg-light">
    <div class="container align-items-center row py-2 mx-auto">
        <div class="col text-left">
            © 2018 SegFault
        </div>
        <div class="col text-center">
            <a class="" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" width="50" height="50" class="d-inline-block align-center" alt="Segfault Logo">
            </a>
        </div>
        <div class="col text-right">
            <a class="nav-item" href="{{ route('about') }}">
                About us
            </a>
        </div>
    </div>
</footer>
</body>
@endsection
