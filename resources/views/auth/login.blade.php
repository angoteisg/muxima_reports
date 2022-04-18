@extends('layouts.guest')
@section('content')

<div class="autenticacao">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <img src="{{ asset('imagens/MuximaReports.png') }}" alt="">
        <br>
        <br>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="login" value="{{ __('Email / Utilizador') }}" style="color: #ffffff" /> 
                <x-jet-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" style="color: #ffffff"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600" style="color: #ffffff">{{ __('Lembra-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}" style="color: #ffffff">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Entrar') }}
                </x-jet-button>
            </div>
        </form>
    
    </div>
@endsection
