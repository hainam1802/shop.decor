@extends('frontend.layouts.index')
@section('title','Thanh toán')
@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Giỏ hàng</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        @if(Cart::count() > 0)
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> Sự hài lòng của bạn là niềm vui của chúng tôi !</h6>
                </div>
            </div>
        <form action="{{url('cart/cart-done')}}" class="checkout__form" method="post">
            {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Chi tiết thanh toán</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Họ và tên <span>*</span></p>
                                    <input type="text" name="name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Địa chỉ <span>*</span></p>
                                    <input type="text" name="address">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Điện thoại <span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input type="text" name="email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__checkbox">
                                    {{--  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Đơn đặt hàng của bạn</h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>
                                            <span class="top__text">Sản phẩm</span>
                                            <span class="top__text__right">Tổng cộng</span>
                                        </li>
                                        @foreach($data as $item)
                                        <li>{{$item->qty}}. {{$item->name}} (Size: {{$item->options->size}} , Màu: {{$item->options->color}}) <span>{{ number_format($item->price*$item->qty) }} VNĐ</span></li>
                                        <input style="display: none" type="text" name="content[]" value="{{$item->qty}}  {{$item->name}} (Size: {{$item->options->size}} , Màu: {{$item->options->color}} ) Giá: {{ number_format($item->price*$item->qty) }} VNĐ">
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                    <li>Tổng tiền hàng <span>{{$total}} VNĐ</span></li>
                                        <li>Tổng thanh toán <span>{{$total}} VNĐ</span></li>
                                    </ul>
                                </div>
                                <button type="submit" class="site-btn">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
        <h5 class="text-center mb-5">Giỏ hàng rỗng</h5>
        <div class="cart__btn text-center">
            <a href="/">Bắt đầu mua sắm</a>
        </div>
        @endif

    </section>
    <!-- Checkout Section End -->

@stop
