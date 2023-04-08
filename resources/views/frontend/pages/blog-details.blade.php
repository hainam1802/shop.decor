@extends('frontend.layouts.index')
@section('title','Bài viết')
@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href=" {{route('blog.index')}} ">Bài viết</a>
                    <span> {{$data->title}} </span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="blog__details__content">
                    <div class="blog__details__item">
                        <img style="width:780px;height:520px" src="{{\App\Library\Files::media( $data->image)}}" alt="">
                        <div class="blog__details__item__title">
                            <span class="tip"> {{date('H:i', strtotime($data->updated_at))}} </span>
                            <h4>{{$data->title}} </h4>
                            <ul>
                                <li>Tác giả:  <span> {{$data->author}} </span></li>
                                <li>{{date('d-m-Y', strtotime($data->updated_at))}}</li>
                                <li>39 bình luận</li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog__details__desc">
                        {!! $data->content !!}
                    </div>
                    <div class="blog__details__tags">
                        <a href="#">Thời trang</a>
                        <a href="#">Phong cách đường phố</a>
                        <a href="#">Đa dạng</a>
                        <a href="#">Vẻ đẹp</a>
                    </div>
                    <div class="blog__details__btns">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__btn__item">
                                    <h6><a href="{{url('blog/bai-viet/'.$random)}}"><i class="fa fa-angle-left"></i> Bài viết trước</a></h6>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__btn__item blog__details__btn__item--next">
                                    <h6><a href="{{url('blog/bai-viet/'.$random_s)}}">Bài viết sau <i class="fa fa-angle-right"></i></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog__details__comment">
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=267207311357197&autoLogAppEvents=1" nonce="E0l11Go0"></script>

                        <div class="fb-comments" data-href="https://www.facebook.com/Th%C3%ADch-Th%C3%AC-L%E1%BA%ADp-Th%C3%B4i-100368618461351" data-numposts="5" data-width=""></div>
                        <br>
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=267207311357197&autoLogAppEvents=1" nonce="1vaqTjqw"></script>
                        <div class="fb-like" data-href="https://www.facebook.com/Th%C3%ADch-Th%C3%AC-L%E1%BA%ADp-Th%C3%B4i-100368618461351" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="blog__sidebar">
                    {{-- <div class="blog__sidebar__item">
                        <div class="section-title">
                            <h4>Danh mục</h4>
                        </div>
                        <ul>
                            <li><a href="#">Tất cả <span>(250)</span></a></li>
                            <li><a href="#">Tuần lễ thời trang <span>(80)</span></a></li>
                            <li><a href="#">Phong cách đường phố <span>(75)</span></a></li>
                            <li><a href="#">Cách sống <span>(35)</span></a></li>
                            <li><a href="#">Vẻ đẹp <span>(60)</span></a></li>
                        </ul>
                    </div> --}}
                    <div class="blog__sidebar__item">
                        <div class="section-title">
                            <h4>Bài viết nổi bật</h4>
                        </div>
                        @foreach ($product as $item)
                        <a href="{{url('blog/bai-viet/'.$item->slug)}}" class="blog__feature__item">
                            <div class="blog__feature__item__pic">
                                <img width="100" height="60" src="{{\App\Library\Files::media( $item->image )}}" alt="">
                            </div>
                            <div class="blog__feature__item__text">
                                <h6>{{Str::limit( $item->title,50)}}</h6>
                                <span>{{date('d-m-Y', strtotime($data->updated_at))}}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="blog__sidebar__item">
                        <div class="section-title">
                            <h4>Liên kết</h4>
                        </div>
                        <div class="blog__sidebar__tags">
                            <a href="#">Thời trang</a>
                            <a href="#">Phong cách đường phố/a>
                            <a href="#">Đa dạng</a>
                            <a href="#">Vẻ đẹp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Blog Details Section End -->
    
@stop 