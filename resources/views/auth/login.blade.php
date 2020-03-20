@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="columns">
            <div class="card">
                <div class="card-divider">{{ __('Login') }}</div>

                <div class="card-section">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <fieldset>
                            <label for="email"  class="column text-md-right">{{ __('E-Mail Address') }}</label>

                            <div  class="column">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </fieldset>

                        <fieldset>
                            <label for="password" class="column text-md-right">{{ __('Password') }}</label>

                            <div  class="column">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="column">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="column">
                                <button type="submit" class="button primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="button warning" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
