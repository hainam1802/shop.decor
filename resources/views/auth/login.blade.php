@extends('auth.layouts.index')
@section('title','Đăng nhập')
@section('content')

    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../../../assets/app/media/img//bg/bg-3.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img src="assets/app/media/img/logos/logo-1.png">
                        </a>
                    </div>
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Đăng nhập</h3>
                        </div>
                        @if(count($errors)>0)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                @foreach($errors->all() as $err)
                                    <strong>Thông báo !</strong> {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('status'))
                            <div  style="font-family: Arial, Helvetica, sans-serif;" class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong>Thông báo !</strong>  {{ session('status') }}
                            </div>
                        @endif
                        <form  role="form" class="m-login__form m-form" method="post">
                            @csrf
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="email" placeholder="Email" name="email" >
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Mật khẩu" name="password">
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--focus">
                                        <input type="checkbox" name="remember"> Nhớ tài khoản
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col m--align-right m-login__form-right">
                                    <a href="javascript:;" id="m_login_forget_password" class="m-link">Quên mật khẩu ?</a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__signup">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Đăng kí </h3>
                            <div class="m-login__desc">Thông tin đăng kí: </div>
                        </div>
                        <form class="m-login__form m-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Họ tên" name="name">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="password" placeholder="Mật khẩu" name="password">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation">
                            </div>
                            <div class="row form-group m-form__group m-login__form-sub">
                                <div class="col m--align-left">
                                    <label class="m-checkbox m-checkbox--focus">
                                        <input type="checkbox" name="agree">Tôi đồng ý với <a href="#" class="m-link m-link--focus">điều khoản và dịch vụ</a>.
                                        <span></span>
                                    </label>
                                    <span class="m-form__help"></span>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">Đăng kí</button>
                                <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">Quay lại</button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__forget-password">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Quên mật khẩu ?</h3>
                            <div class="m-login__desc">Nhập Email thiết lập mật khẩu của bạn: </div>
                        </div>
                        <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email">
                            </div>
                            <div class="m-login__form-action">
                                <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">Gửi</button>
                                <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Quay lại</button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__account">
							<span class="m-login__account-msg">
								Chưa có tài khoản
							</span>&nbsp;&nbsp;
                        <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">Đăng kí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop