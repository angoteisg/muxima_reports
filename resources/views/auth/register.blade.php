@extends('layouts.guest')
@section('content')

<div class="autenticacao" style=" ">
    <center> <img  src="{{ asset('imagens/MuximaReports.png') }}" style="width:70%; height:auto" alt=""></center>
     
    <br>
    <br>
        <form method="POST" class="formAuth" action="{{ route('register') }}">
            @csrf

            <div>
                <b> <x-jet-label for="name" value="{{ __('Nome') }}"  /></b>
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <strong><x-jet-label for="email" value="{{ __('Email') }}" style="color: #000000 !important; font-weight: bold;"/></strong>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Senha') }}" style="color: #547c8e !important; font-weight: bold;"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirme a Senha') }}" style="color: #8c1014 !important; font-weight: bold;"/>
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}" style="color: #8c1014 !important; font-weight: bold;">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4" style="color: #ffffff !important; font-weight: bold;">
                    {{ __('Registar') }}
                </x-jet-button>
            </div>
        </form>
    </div>


@endsection
