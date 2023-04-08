@extends('frontend.layouts.index')
@section('title','Blog')
@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Bài viết</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            @foreach ($data as $item)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{\App\Library\Files::media( $item->image )}}"></div>
                    <div class="blog__item__text">
                        <h6><a href=" {{url('blog/bai-viet/'.$item->slug)}} "> {{Str::limit( $item->title, 70)}} </a></h6>
                        <ul>
                            <li>Tác giả: <span> {{$item->author}} </span></li>
                            <li>{{date('d-m-Y', strtotime($item->updated_at))}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="col-lg-12 text-center">
                <a href="#" class="primary-btn load-btn">Tải thêm bài viết</a>
            </div> --}}
        </div>
    </div>
</section>
<!-- Blog Section End -->

@stop