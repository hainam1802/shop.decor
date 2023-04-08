@extends('admin._layouts.index')
@section('title','Màu sắc sản phẩm')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Sản phẩm')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{ route('color-product.index') }}" class="m-nav__link">
                                <span class="m-nav__link-text"> Màu sản phẩm </span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    @if(isset($data))
                                        {{__($data->title)}}
                                        @else
                                        {{__('Thêm mới')}}
                                    @endif

                                </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-subheader">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                               @if(isset($data))
                                   {{__('Danh mục')}}: {{$data->title}}
                                @else
                                   {{__('Thêm mới')}}
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="">
                    @if(count($errors)>0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            @foreach($errors->all() as $err)
                                <strong>{{__('Thông báo')}} !</strong> {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    <form class="m-form m-form--fit m-form--label-align-right"  method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('color-product.update',$data->id):route('color-product.store')}}">
                        {{csrf_field()}}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label> {{__('Màu')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="text" name="title" class="form-control m-input" value="{{old('title',isset($data) ? $data->title : null)}}" placeholder="{{__('Nhập màu sắc')}}...">
                                </div>
                                <span class="m-form__help"> {{__('Màu sắc')}} </span>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                @if(isset($data))
                                    <button type="submit" class="btn btn-primary"> {{__('Chỉnh sửa')}} </button>
                                @else
                                    <button type="submit" class="btn btn-primary"> {{__('Thêm mới')}} </button>
                                @endif
                                <button type="reset" class="btn btn-secondary"> {{__('Nhập lại')}} </button>
                            </div>
                        </div>
                    </form>
                </div>
    
            </div>
        </div>
        <!-- END: Subheader -->
        <script>
            document.getElementById("file").onchange = function () {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("image").src = e.target.result;
                };

                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);

            };
        </script>
    </div>
@stop
