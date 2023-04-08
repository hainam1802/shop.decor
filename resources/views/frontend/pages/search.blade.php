@extends('frontend.layouts.index')
@section('title','Tìm kiếm')
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
            <div class="col-lg-8 col-md-8">
                <div class="section-title">
                    <h4>Kết quả tìm kiếm cho từ khóa: " <span style="color: #0000007a">{{$title}}</span> " - {{$count}} kết quả</h4>
                </div>
            </div>
        </div>
        <div class="row property__gallery">
            @foreach ($data as $item)
            <div id="item" class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{\App\Library\Files::media( $item->image )}}">
                        <ul class="product__hover">
                            <li><a href="{{\App\Library\Files::media( $item->image )}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="{{url('san-pham/'.$item->slug)}}"><span class="far fa-eye"></span></a></li>
                            <li><a href="{{url('cart/add'.'/'.$item->id)}}"><span class="icon_bag_alt"></span></a></li>
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
                    <div class="product__price"> {{ number_format($item->price) }}  VNĐ </div>
                    </div>
                </div>
            </div>
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


<script>
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
});
</script>

@stop