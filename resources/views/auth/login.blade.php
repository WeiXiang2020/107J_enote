<x-guest-layout>

    <x-slot name="logo">
        <x-jet-authentication-card-logo />
    </x-slot>

    <x-jet-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="container">
            <div class="left">
                <div class="header">
                    <h2 class="animation a1">登入|Login</h2>
                    <h4 class="animation a2">請輸入帳號密碼</h4>
                </div>
                <div class="form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <x-jet-input id="email" class="form-field animation a3" placeholder="帳號" type="text" name="email" :value="old('email')" required autofocus />
                        <x-jet-input id="password" class="form-field animation a4" placeholder="密碼" type="password" name="password" required autocomplete="current-password" />


                        @if (Route::has('password.request'))
                            <p class="animation a5"><a href="{{ route('password.request') }}">忘記密碼?</a></p>
                        @endif

                        <x-jet-button class="btn btn-primary btn-ghost animation a6">
                            登入
                        </x-jet-button>

                    </form>
                </div>
            </div>
            <div class="right"></div>
        </div>
    </form>

</x-guest-layout>

<style>
    * { box-sizing: border-box; }
    @import url('https://fonts.googleapis.com/css?family=Rubik:400,500&display=swap');


    body {
        font-family: 'Rubik', sans-serif;
    }

    .container {
        display: flex;
        height: 100vh;
    }

    .left {
        overflow: hidden;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        justify-content: center;
        animation-name: left;
        animation-duration: 1s;
        animation-fill-mode: both;
        animation-delay: 1s;
    }

    .right {
        flex: 1;
        background-color: black;
        transition: 1s;
        background-image: url(https://images.unsplash.com/photo-1517842645767-c639042777db?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=750&q=80);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }



    .header > h2 {
        margin: 0;
        color: #4f46a5;
    }

    .header > h4 {
        margin-top: 10px;
        font-weight: normal;
        font-size: 15px;
        color: rgba(0,0,0,.4);
    }

    .form {
        max-width: 80%;
        display: flex;
        flex-direction: column;
    }

    .form > p {
        text-align: right;
    }

    .form > p > a {
        color: #000;
        font-size: 14px;
    }

    .form-field {
        height: 46px;
        padding: 0 16px;
        border: 2px solid #ddd;
        border-radius: 4px;
        font-family: 'Rubik', sans-serif;
        outline: 0;
        transition: .2s;
        margin-top: 20px;
    }

    .form-field:focus {
        border-color: #0f7ef1;
    }

    .animation {
        animation-name: move;
        animation-duration: .4s;
        animation-fill-mode: both;
        animation-delay: 2s;
    }

    .a1 {
        animation-delay: 2s;
    }

    .a2 {
        animation-delay: 2.1s;
    }

    .a3 {
        animation-delay: 2.2s;
    }

    .a4 {
        animation-delay: 2.3s;
    }

    .a5 {
        animation-delay: 2.4s;
    }

    .a6 {
        animation-delay: 2.5s;
    }

    @keyframes move {
        0% {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-40px);
        }

        100% {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    }

    @keyframes left {
        0% {
            opacity: 0;
            width: 0;
        }

        100% {
            opacity: 1;
            padding: 20px 40px;
            width: 440px;
        }
    }


    .btn {
        padding: 8px 20px;
        border-radius: 0;
        overflow: hidden;
    }

    .btn:hover {
        background: transparent;
        box-shadow: 0 0 20px 10px hsla(204, 70%, 53%, 0.5);
    }


</style>
