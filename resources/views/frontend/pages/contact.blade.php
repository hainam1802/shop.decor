@extends('frontend.layouts.index')
@section('title','Liên hệ')
@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Liên hệ</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Contact Section Begin -->
    <section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__content">
                    <div class="contact__address">
                        <h5>Thông tin liên hệ</h5>
                        <ul>
                            <li>
                                <h6><i class="fa fa-map-marker"></i> Địa chỉ</h6>
                                <p>218 Lĩnh Nam, Hoàng Mai, Hà Nội</p>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone"></i> Điện thoại</h6>
                                <p><span>0388 119 141</span><span>+ 84 88119141</span></p>
                            </li>
                            <li>
                                <h6><i class="fa fa-headphones"></i> Hỗ trợ</h6>
                                <p>Truongdv.hqgroup@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                    <div class="contact__form">
                        <h5>Đóng góp ý kiến</h5>
                        <form id="feedback-form" name="feedback-form">
                            <input type="text" name="name" class="refresh" required placeholder="Tên">
                            <input type="text" name="email" class="refresh" placeholder="Email">
                            <textarea name="content" required class="refresh" placeholder="Ý kiến đóng góp"></textarea>
                            <button type="submit" class="site-btn">Gửi <i style="font-size: 15px;display:none" class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom icon-loading"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5690.154770026653!2d105.87692939211317!3d20.98058976150521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135afd765487289%3A0x21bd5839ba683d5f!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaW5oIHThur8gLSBL4bu5IHRodeG6rXQgQ8O0bmcgbmdoaeG7h3A!5e0!3m2!1svi!2s!4v1601451907170!5m2!1svi!2s" width="600" height="750" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
    </div>
    </section>
    <!-- Contact Section End -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#feedback-form").on('submit',function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '/lien-he',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('.icon-loading').show();
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
                            swal(
                            'Thành công !',
                            data.success,
                            'success'
                        )
                    }
                },
                complete: function(){
                    $('.icon-loading').hide();
                }
            });
        });
        
    </script>
@stop
    