@extends('frontend.layouts.index')
@section('title','Sản phẩm')
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href=" {{ url('/') }} "><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Danh mục sản phẩm</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul>
                                                @foreach($category as $cat)
                                                    <li><a href="{{url('danh-muc/'.$cat->slug)}}"> {{$cat->title}} </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Theo giá</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                     data-min="33" data-max="99"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Giá:</p>
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                            <a href="#">Lọc</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    {{--            --}}
                    <div class="section-title">
                        <h4>Kết quả cho danh mục: {{$name}} </h4>
                    </div>
                    <div class="row">
                        @if($data)
                            @foreach($data as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{\App\Library\Files::media( $item->image )}}">
                                            @if(isset($item->sale))
                                                <div class="label sale">Giảm giá</div>
                                            @else
                                                <div style="background: #e3c01c" class="label">Nổi bật</div>
                                            @endif
                                            <ul class="product__hover">
                                                <li><a href="{{\App\Library\Files::media( $item->image )}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="{{url('san-pham/'.$item->slug)}}"><span class="far fa-eye"></span></a></li>
                                                <li data-id="{{$item->id}}" class="cart-add"><a href=""><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="{{url('san-pham/'.$item->slug)}}">{{$item->title}}</a></h6>
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
                            @endforeach
                            @else
                                <h5 class="text-center">Không có sản phẩm</h5>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </section>
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
    <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
        $(document).ready(function(){
    
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
                            size += '<input type="radio" name="size" value="'+value+'" />';
                            size += value;
                            size += '</label>';
                        });
                        $("#details-size").html(size);
    
                        // 
                        let color ="";
                        $.each(data.color,function(key,value){
                            color += '<label>';
                            color += '<input type="radio" name="color" value="'+value+'" />';
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
                    // $("#tip-cart").reload();
                    // $("#tip-cart").fadeIn('fast');
                    toastr.success(data.success, 'Thông báo', {timeOut: 3000});
                }
            },
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
    </script>
    <!-- Shop Section End -->
@stop

