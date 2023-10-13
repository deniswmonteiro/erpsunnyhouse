@section('page_title', 'Login')

<x-guest-layout>

    <div id="auth-left">
        <div class="auth-logo">
            <a href="login"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a>
        </div>
        <h1 class="auth-title">Olá.</h1>
        <p class="auth-subtitle mb-3">Faça login para continuar.</p>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input class="form-control form-control-lg" type="email" name="email" placeholder="Email" id="email"
                       value="{{ old('email') }}">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-lg" name="password" id="password"
                       placeholder="Senha">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <div class="form-check form-check-md d-flex align-items-center ms-1">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="flexCheckDefault">
                <label class="form-check-label text-gray-600" for="flexCheckDefault">
                    Me manter logado
                </label>
            </div>
            <button class="btn bg-orange btn-block btn-lg shadow-lg mt-5">Login</button>
        </form>

        <x-slot name="image">
            <img src="{{ asset('/images/bg/main-bg-3.jpg') }}" alt="bg" class="vh-100">
        </x-slot>
    </div>
</x-guest-layout>
