<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="/"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <nav class="header__menu">
                    <ul class="d-none d-lg-block" style="float: right">
                        <li class="active"><a href="/">Trang chủ</a></li>
                        {{-- <li><a href="#">Thời trang nữ</a></li>
                        <li><a href="#">Thời trang nam</a></li> --}}
                        <li><a href=" {{url('san-pham')}} ">Sản phẩm</a></li>
                        <li><a href=" {{route('blog.index')}} ">Bài viết</a></li>
                        <li><a href="{{url('lien-he')}}">Liên hệ</a></li>
                        <li><a href="{{url('chinh-sach')}}">Chính sách</a></li>
                    </ul>
                    <ul class="d-lg-none">
                        <li class="active"><a href="/">Trang chủ</a></li>
                        {{-- <li><a href="#">Thời trang nữ</a></li>
                        <li><a href="#">Thời trang nam</a></li> --}}
                        <li><a href="">Cửa hàng</a></li>
                        <li><a href="#">Trang</a>
                            <ul class="dropdown">
                                <li><a href="">Chi tiết sản phẩm</a></li>
                                <li><a href="">Giỏ hàng</a></li>
                                <li><a href="">Thanh toán</a></li>
                                <li><a href="">Chi tiết bài viết</a></li>
                            </ul>
                        </li>
                        <li><a href=" {{route('blog.index')}} ">Bài viết</a></li>
                        <li><a href=" {{url('lien-he')}} ">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="{{url('cart/show')}}"><span class="icon_bag_alt"></span>
                            <div id="tip-cart" class="tip tip-cart">{{Cart::count()}}</div>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
