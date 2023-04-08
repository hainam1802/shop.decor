@extends('frontend.layouts.index')
@section('title','Trang chủ')
@section('content')

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg"
                     data-setbg="img/categories/category-1.jpg">
                    <div class="categories__text">
                        <h1 style="font-family: 'Architects Daughter', cursive;">Vẻ đẹp hoàn mỹ</h1>
                        <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                            edolore magna aliquapendisse ultrices gravida.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-2.jpg">
                            <div class="categories__text">
                                <h4>Thời trang nam</h4>
                                <p>Sản phẩm:  <span class="count" style="font-weight: 600" data-count="250">250</span>+</p>
                                <a href="#">Mua sắm ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-3.jpg">
                            <div class="categories__text">
                                <h4>Thời trang trẻ em</h4>
                                <p>Sản phẩm: <span class="count" style="font-weight: 600" data-count="100">100</span>+</p>
                                <a href="#">Mua sắm ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-4.jpg">
                            <div class="categories__text">
                                <h4>Mỹ phẩm</h4>
                                <p>Sản phẩm: <span class="count" style="font-weight: 600" data-count="150">150</span>+</p>
                                <a href="#">Mua sắm ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-5.jpg">
                            <div class="categories__text">
                                <h4>Thời trang nữ</h4>
                                <p>Sản phẩm: <span class="count" style="font-weight: 600" data-count="250">250</span>+</p>
                                <a href="#">Mua sắm ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Sản phẩm mới</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls" style="font-weight: bold">
                    <li class="active" data-filter="*">Tất cả</li>
                    @foreach ($category as $cat)
                        <li data-filter=".{{$cat->slug}}"> {{$cat->title}} </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row property__gallery">
            @foreach ($category as $cat)
            @foreach ($cat->product->take(8) as $item)
            @if($item)
            <div id="item" class="col-lg-3 col-md-4 col-sm-6 mix {{$cat->slug}}">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{\App\Library\Files::media( $item->image )}}">
                        <div class="label new">Mới</div>
                        <ul class="product__hover">
                            <li><a href="{{\App\Library\Files::media( $item->image )}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="{{url('san-pham/'.$item->slug)}}"><span class="far fa-eye"></span></a></li>
                            <li data-id="{{$item->id}}" class="cart-add"><a href=""><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div style="height: 100px" class="product__item__text">
                    <h6><a href="{{url('san-pham/'.$item->slug)}}"> {{$item->title}} </a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    <div class="product__price">{{ number_format($item->price) }}  VNĐ</div>
                    </div>
                </div>
            </div>
            @else
            <h4 class="text-center">Hiện chưa có sản phẩm</h4>
            @endif
            
            @endforeach
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>Bộ sưu tập Chloe</span>
                            <h1>Dự án áo khoác</h1>
                            <a href="#">Mua sắm ngay</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>Bộ sưu tập Chloe</span>
                            <h1>Dự án áo khoác</h1>
                            <a href="#">Mua sắm ngay</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>Bộ sưu tập Chloe</span>
                            <h1>Dự án áo khoác</h1>
                            <a href="#">Mua sắm ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Xu hướng</h4>
                    </div>
                    @foreach ($trend as $item)
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <a href="{{url('san-pham/'.$item->slug)}}"><img width="90" height="110" src="{{\App\Library\Files::media( $item->image )}}" alt=""></a>
                        </div>
                        <div class="trend__item__text">
                            <h6><a class="text-dark" href="{{url('san-pham/'.$item->slug)}}">{{$item->title}}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price"> {{ number_format($item->price) }}  VNĐ </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Bán chạy nhất</h4>
                    </div>
                    @foreach ($run as $item)
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <a href="{{url('san-pham/'.$item->slug)}}"><img width="90" height="110" src="{{\App\Library\Files::media( $item->image )}}" alt=""></a>
                        </div>
                        <div class="trend__item__text">
                            <h6><a class="text-dark" href="{{url('san-pham/'.$item->slug)}}">{{$item->title}}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price"> {{ number_format($item->price) }}  VNĐ </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Nổi bật</h4>
                    </div>
                   
                    @foreach ($hight as $item)
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <a href="{{url('san-pham/'.$item->slug)}}"><img width="90" height="110" src="{{\App\Library\Files::media( $item->image )}}" alt=""></a>
                        </div>
                        <div class="trend__item__text">
                            <h6><a class="text-dark" href="{{url('san-pham/'.$item->slug)}}">{{$item->title}}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price"> {{ number_format($item->price) }}  VNĐ </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="img/discount.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Giảm giá</span>
                        <h2>Hè 2019</h2>
                        <h5><span>Giảm</span> 50%</h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item">
                            <span>22</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Hour</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Min</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Sec</p>
                        </div>
                    </div>
                    <a href="#">Mua sắm ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Miễn phí giao hàng</h6>
                    <p>Cho tất cả đơn hàng từ $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Đảm bảo hoàn tiền</h6>
                    <p>Nếu có vấn đề</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Hỗ trợ trực tuyến 24/7</h6>
                    <p>Hỗ trợ tận tâm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Thanh toán an toàn</h6>
                    <p>Thanh toán an toàn 100%</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 400;font-family: 'Roboto', sans-serif;font-size:16px">Chi tiết sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    Sản phẩm: <span style="font-weight: 500" id="title-details"></span> 
                </div>
                <form name="product-add" id="product-add">
                    <div class="row">
                        <div class="details-id"></div>
                        <div class="col-lg-6">
                        <div class="product__details__pic__slider owl-carousel owl-loaded">
                            <img class="img-fluid" id="details-image" src="" alt="">
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product__details__text">
                            <h6 style="font-family: 'Roboto', sans-serif">Danh mục: <span style="font-weight: bold" class="" id="details-cat"></span></h6>
                                <div class="rating" style="clear: left">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span>( Không có bình luận )</span>
                                </div>
                                    <div class="product__details__price"><b id="details-price-sale"></b> VNĐ<span id="details-price"></span><span>VNĐ</span></div>
                                <div class="" id="details-description"></div>
                            </div>
                        </div>
                    </div>
                    <div class="product__details__widget mb-4">
                        <ul>
                            <li>
                                <span>Màu có sẵn:</span>
                                <div id="details-color" class="color__checkbox">
                                    
                                </div>
                            </li>
                            <li>
                                <span>Kích thước có sẵn:</span>
                                <div id="details-size" class="size__btn">
                                    
                                </div>
                            </li>
                            <li>
                                <span>Khuyến mãi:</span>
                                <p>Miễn phí giao hàng</p>
                            </li>
                        </ul>
                    </div>
                    <div class="product__details__button" style="text-align: center">
                        <button type="submit" style="border: none;float:none" id="button-add" class="cart-btn"><span class="icon_bag_alt"></span> Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="color: #fff" data-dismiss="modal">ĐÓNG</button>
            </div>
        </div>
    </div>
</div>
<!--  -->
<script>
    $(document).ready(function(){
        var cart_count = parseInt($('#tip-cart').text());
        $(".cart-add").click(function(event){
            event.preventDefault();
            $("#modal-cart").modal('show');
            var id = $(this).data("id");
            $(".details-id").html('<div id="details-id" data-id="'+id+'"></div>')
            $.ajax({
                url: "/details/"+id,
                type: "GET",
                success: function(data){
                    $("#title-details").html(data.data.title);
                    $("#details-cat").html(data.cat);
                    $("#details-price").html(formatNumber(data.data.price_old));
                    $("#details-price-sale").html(formatNumber(data.data.price));
                    $("#details-description").html(data.data.description);
                    $('#details-image').attr('src', data.data.image);
                    let size = "";
                    $.each(data.size,function(key,value){
                        size += '<label>';
                        size += '<input class="refresh" type="radio" name="size" value="'+value+'" />';
                        size += value;
                        size += '</label>';
                    });
                    $("#details-size").html(size);

                    // 
                    let color ="";
                    $.each(data.color,function(key,value){
                        color += '<label>';
                        color += '<input class="refresh" type="checkbox" name="color" value="'+value+'" />';
                        color += value;
                        color += '</label>';
                    });
                    $("#details-color").html(color);
                }
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#product-add").on('submit',function(event) {
            event.preventDefault();
            var id = $("#details-id").data("id");
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '/cart/add/'+id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#tip-cart').removeClass('tip-cart');
                },
                success: (data) =>{
                    if(data.errors){
                        swal(
                            'Lỗi !',
                            data.errors,
                            'error'
                        )
                    }else{
                        $('.refresh').val('');
                        $("#modal-cart").modal('hide');
                        // $('#tip-cart').removeClass('tip-cart').addClass('tip-cart')
                        cart_count++;
                        $('#tip-cart').text(cart_count);
                        toastr.success(data.success, 'Thông báo', {timeOut: 3000});
                    }
                },
                // complete: function(){
                //     $('#tip-cart').addClass('tip-cart');
                // }
            })
        })

        $('#modal-cart').on('show.bs.modal', function(e) {
            var action=$( e.relatedTarget).data('action');
            $('#form-delete').attr('action',action );
        });

    });


    $("#details-size").on("click","label", function(){
        // alert("success");
        $('label').removeClass("active");
        $(this).addClass("active");
    });
    $("#details-color").on("click","label", function(){
        $('label').removeClass("active-color");
        $(this).addClass("active-color");
    });


    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 3000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
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
    });
</script>
@stop
