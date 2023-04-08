@extends('frontend.layouts.index')
@section('title','Giỏ hàng')
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
    
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
    <div class="container">
        @if(Cart::count() > 0)
        <form name="update-cart" id="update-cart">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table id="details-cart">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="cart__product__item">
                                    {{-- <input style="display: none" type="text" name="rowId[]" value="{{$item->rowId}}"> --}}
                                        <img width="120" height="130" src="{{\App\Library\Files::media( $item->options->image )}}" alt="">
                                        <div class="cart__product__item__title">
                                            <h6> {{$item->name}} </h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        <p style="font-weight:bold" >Size: {{$item->options->size}} <br /> Màu: {{$item->options->color}} </p>
                                        </div>
                                    </td>
                                <td class="cart__price" data-value="{{ $item->price}}">{{ number_format($item->price) }} VNĐ</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty" data-id="{{$item->rowId}}">
                                            <input type="text" class="data-qty" readonly name="qty" value="{{$item->qty}}">
                                        </div>
                                    </td>
                                <td class="cart__total" data-value="{{ $item->price*$item->qty }}">{{ number_format($item->price*$item->qty) }} VNĐ</td>
                                    <td class="cart__close">
                                            {{-- <button style="border: none;" type="submit"><span class="icon_close"></span></button> --}}
                                            <span class="icon_close" data-id="{{$item->rowId}}"></span>
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="/">Tiếp tục mua sắm</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                        <button type="submit" style="border:none;background:red;color:#fff;border-radius:1px;padding: 14px 30px 12px;font-weight: 600;"><span class="icon_loading" style="display: none"></span> Cập nhật giỏ hàng</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Tổng giỏ hàng</h6>
                    <ul>
                        <li>Tổng tiền hàng <span id="cartTotal">{{$total}} VNĐ</span></li>
                        <li>Tổng thanh toán <span id="cartPayTotal">{{$total}} VNĐ</span></li>
                    </ul>
                    <a href="{{url('cart/cart-done')}}" class="primary-btn">Đặt hàng</a>
                </div>
            </div>
        </div>
        @else
        <h5 class="text-center mb-5">Giỏ hàng rỗng</h5>
        <div class="cart__btn text-center">
            <a href="/">Bắt đầu mua sắm</a>
        </div>
        @endif
    </div>
    </section>
    
    <div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 400;font-family: 'Roboto', sans-serif;font-size:16px">Xóa sản phẩm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có muốn xóa sản phẩm này khỏi giỏ hàng ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
              <div id="button-action">

              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Shop Cart Section End -->
    
    <script>
        $(document).ready(function(){
            var cart = {};
            $('.pro-qty').each(function(){
                cart[$(this).data('id')] = parseFloat($(this).parents('tr').find('.cart__total').data('value'));
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".pro-qty").on("click",".qtybtn", function(event){
                var product = $(this).parents('tr');
                setTimeout(function(){
                    $.ajax({
                        url: '/cart/update',
                        type: 'POST',
                        dataType: 'json',
                        data: {qty: product.find('[name="qty"]').val(),rowId: product.find('.pro-qty').data('id')}
                    }).done(function(data) {
                        if(data.success){
                            if(product.find('[name="qty"]').val() == '0'){
                                product.remove();
                                delete(cart[product.find('.pro-qty').data('id')]);
                            }else{
                                var product_total = product.find('[name="qty"]').val()*product.find('.cart__price').data('value');
                                cart[product.find('.pro-qty').data('id')] = product_total;
                                product.find('.cart__total').text(formatNumber(product_total)+' VNĐ')
                            }
                            update_cart();
                        }
                    });
                }, 100)
                
            });

            function update_cart(){
                var total = Object.values(cart).reduce(getSum, 0);
                // console.log(total)
                $('#cartTotal').text(formatNumber(total)+ 'VNĐ');
                $('#cartPayTotal').text(formatNumber(total)+ 'VNĐ');
            }

            $(".icon_close").click(function(event){
                event.preventDefault();
                var id = $(this).data("id");
                $("#button-action").html('<button type="button" class="btn btn-danger" id="button-delete" data-id='+id+' style="color: #fff">Xóa</button>');
                $("#modal-cart").modal('show');
            });
            $("#button-action").on('click',"#button-delete",function(event){
                event.preventDefault();
                var id = $(this).data("id");
                // alert(id);
                $.ajax({
                    type: 'POST',
                    url: '/cart/delete/'+id,
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
                            $("#modal-cart").modal('hide');
                            $("#details-cart").load(window.location + " #details-cart");
                            // $(".cart__total__procced").load(window.location + " .cart__total__procced");
                            // location.reload();
                            delete(cart[id]);
                            update_cart()
                            toastr.success(data.success, 'Thông báo', {timeOut: 3000});
                        }
                    }
                });
            })
        })
    </script>
@stop