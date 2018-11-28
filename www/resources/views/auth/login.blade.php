@extends('layouts.coin.app_auth')

@section('content')
<div class="login-box">
        <div class="logo">
            <a href="/"><img src="/img/logo.png" ><br/></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
			
                <form id="sign_in" class="form-horizontal" method="POST" action="/login" novalidate="novalidate">
					{{ csrf_field() }}
					
					<div class="msg"><h3>login</h3></div>
					
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required autofocus="" aria-required="true">
                        </div>
                    </div>
					
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
							<input id="password" type="password" class="form-control" name="password" placeholder="pass" required="" aria-required="true">
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
							<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">remember me</label>
                        </div>
                        <div class="col-xs-4">

                            <button class="btn btn-block bg-pink waves-effect" type="submit">login</button>
                        </div>
                    </div>
					@if ($errors->has('email'))
						<span class="help-block">
							<strong class="font-bold col-pink">{{ $errors->first('email') }}</strong>
						</span>
					@endif
					
					@if ($errors->has('password'))
						<span class="help-block">
							<strong class="font-bold col-pink">{{ $errors->first('password') }}</strong>
						</span>
					@endif
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="register">sign up</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}">fotgot pass?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
