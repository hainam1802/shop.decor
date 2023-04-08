<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        {{-- <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li> --}}
        <li><a href="{{url('cart/show')}}"><span class="icon_bag_alt"></span>
                {{-- <div class="tip">{{Cart::count()}}</div> --}}
                <div class="tip tip-cart">{{Cart::count()}}</div>
            </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="index.php"><img src="img/logo.png" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
</div>
