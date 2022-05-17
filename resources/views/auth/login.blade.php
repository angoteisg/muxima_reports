@extends('layouts.guest')
@section('content')
<div class="autentica">
<div class="autenticacao">
   
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

       <center> <img  src="{{ asset('imagens/MuximaReports.png') }}" style="width:70%" alt=""></center>
     
        <br>
        <br>
        <form class="formAuth" method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="login" value="{{ __('Email / Utilizador') }}"  /> 
                <x-jet-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600" >{{ __('Lembra-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}" >
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Entrar') }}
                </x-jet-button>
            </div>
        </form>
    
    </div>
</div>
@endsection
