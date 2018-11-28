@extends('layouts.admin.app_auth')

@section('content')
<div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">BCX<br></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" method="POST" action="{{ route('password.email') }}" novalidate="novalidate">
					{{ csrf_field() }}
					
                    <div class="msg"><h3>비밀번호 찾기</h3></div>
					@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="이메일" required="" autofocus="" aria-required="true">
                        </div>
                    </div>
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
								
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">비밀번호 재설정</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="/login">로그인</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
