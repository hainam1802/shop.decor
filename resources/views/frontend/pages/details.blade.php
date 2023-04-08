@extends('frontend.layouts.index')
@section('title','Chi tiết sản phẩm')
@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="#">Chi tiết sản phẩm </a>
                    <span> {{$data->title}} </span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-hash="product-1" class="product__big__img" src="{{\App\Library\Files::media( $data->image )}}" alt="">
                            @foreach ($image_extension as $item)
                            <img data-hash="product-1" class="product__big__img" src="{{\App\Library\Files::media( $item )}}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form name="details-cart" id="details-cart">
                <div id="details-id" data-id="{{$data->id}}"></div>
                    <div class="product__details__text">
                        <h3>{{$data->title}} <span>Danh mục: {{$data->category->title}}</span></h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>( 138 Bình luận )</span>
                            </div>
                            @if($data->sale == null)
                                <div class="product__details__price"> {{ number_format($data->price) }} VNĐ</div>
                            @else
                                <div class="product__details__price">{{ number_format($data->price) }} VNĐ<span>{{ number_format($data->price_old) }} VNĐ</span></div>
                            @endif
                        <div class="">{!! $data->description !!}</div>
                            <div class="product__details__button mt-4">
                                <button type="submit" style="border: none;float:none" id="button-add" class="cart-btn"><span class="icon_bag_alt"></span> Thêm vào giỏ hàng</button>
                            </div>
                            <div class="product__details__widget">
                                <ul>
                                    <li>
                                        <span>Màu có sẵn:</span>
                                        <div class="color__checkbox">
                                            @foreach (json_decode($data->color) as $item)
                                            <label>
                                                <input type="radio" class="refresh" name="color" value="{{$item}}" />{{$item}}
                                            </label>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li>
                                        <span>Kích thước có sẵn:</span>
                                        <div class="size__btn">
                                            @foreach (json_decode($data->size) as $item)
                                            <label>
                                            <input type="checkbox" class="refresh" name="size" value="{{$item}}" />{{$item}}
                                            </label>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li>
                                        <span>Khuyến mãi:</span>
                                        <p>Miễn phí giao hàng</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                </form>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Mô tả</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Mô tả</h6>
                            <div class="">
                                {!! $data->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>Sản phẩm liên quan</h5>
                </div>
            </div>
            @foreach ($product_item as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{\App\Library\Files::media( $item->image )}}">
                        {{-- <div class="label new">Mới</div> --}}
                        <ul class="product__hover">
                            <li><a href="{{\App\Library\Files::media( $item->image )}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Buttons tweed blazer</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">{{ number_format($data->price) }} VNĐ</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </section>
    <script>

    $(".color__checkbox").on("click","label", function(){
        // alert("success");
        $('label').removeClass("active");
        $(this).addClass("active");
    });
    $(".size__btn").on("click","label", function(){
        $('label').removeClass("active-color");
        $(this).addClass("active-color");
    });

    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']"; 
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    // ajax

    $("#details-cart").on('submit',function(event) {
        event.preventDefault();
        var id = $("#details-id").data("id");
        // alert(id);
        var formData = new FormData(this);
        // alert(formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/cart/add/'+id,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                if(data.errors){
                    swal(
                        'Lỗi !',
                        data.errors,
                        'error'
                    )
                }else{
                    $('.refresh').val('');
                    // $("#tip-cart").reload();
                    // $("#tip-cart").fadeIn('fast');
                    swal(
                        'Thành công !',
                        data.success,
                        'success'
                    )
                }
            },
        });

    });

    </script>    
@stop