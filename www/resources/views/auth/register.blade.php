@extends('layouts.admin.app_auth')

@section('content')
<div class="signup-box">
        <div class="logo">
            <a href="/"><img src="/img/logo.png" ><br/></a>
            <small></small>
        </div>
		
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST" novalidate="novalidate"  action="{{ route('register') }}">
				
					{{ csrf_field() }}
				
                    <div class="msg"><h3>sign up</h3></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
							 <input id="name" type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') }}" required="" autofocus="" aria-required="true">
                        </div>
                    </div>
					@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">							
							 <input id="email" type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required="" aria-required="true">
                        </div>
                    </div>
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
								
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
							<input id="password" type="password" class="form-control" name="password" minlength="6" placeholder="pass" required="" aria-required="true">
                        </div>
                    </div>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
								
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="6" placeholder="pass confirm" required="" aria-required="true">
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line">
                            <input id="mobile" type="text" class="form-control" name="mobile" placeholder="mobile" value="{{ old('mobile') }}" required="" aria-required="true">
                        </div>
                    </div>
                    @if ($errors->has('mobile'))
                        <span class="help-block">
							<strong>pls enter mobile number.</strong>
						</span>
                    @endif




                    <div class="form-group">
                        <input type="checkbox" name="checkbox1" id="terms" value="1" class="filled-in chk-col-pink">
                        <label for="terms">I agree <a data-toggle="modal" href="#" data-target="#modal_agreement">service agreement</a> and <a data-toggle="modal" href="#" data-target="#modal_privacy">privacy policy</a></label>
                    </div>


                    @if ($errors->has('checkbox1'))
                        <span class="help-block">
							<strong>please agree service agreement and privacy policy</strong>
						</span>
                    @endif


                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">sign up</button>
                    <div class="m-t-25 m-b--5 align-center">
                        <a href="/">cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal: 이용약관 -->
    <div class="modal fade" id="modal_agreement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="height:450px;overflow-y: scroll;">
                        @include('privacy.agreement')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal: 개인정보 -->
    <div class="modal fade" id="modal_privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="height:450px;overflow-y: scroll;">
                        @include('privacy.privacy')
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
