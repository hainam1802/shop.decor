@extends('admin._layouts.index')
@section('title','Module hệ thống')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Module hệ thống')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{route('setting-module.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Module hệ thống')}} </span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">@if(isset($data)) {{__('Chỉnh sửa chức năng')}} @else {{__('Thêm mới')}} @endif</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-subheader mb-4">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            @if(isset($data))
                                 {{__('Chỉnh sửa')}} : {{$data->title}}
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
                            <strong>{{__('Thông báo')}} !</strong> {{$errors->first()}}<br>
                    </div>
                @endif
                <form class="m-form m-form--fit m-form--label-align-right" method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('setting-module.update',$data->id):route('setting-module.store')}}">
                    {{csrf_field()}}
                    @if(isset($data))
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label> {{__('Thể loại')}} </label>
                            <div class="input-group m-input-group">
                                @if(isset($data))
                                <select name="status" class="form-control m-input">
                                    <option {{$data->status == 1? 'selected': ''  }} value="1">Blog</option>
                                    <option {{$data->status == 2? 'selected': ''  }} value="2">Product</option>
                                </select>
                                @else
                                <select name="status" class="form-control m-input">
                                    <option value="1">Blog</option>
                                    <option value="2">Product</option>
                                </select>
                                @endif
                            </div>
                            <span class="m-form__help"> {{__('Tên module không được phép trùng')}} </span>
                        </div>
                        <div class="form-group m-form__group">
                            <label> {{__('Tên')}} </label>
                            <div class="input-group m-input-group">
                                <input type="text" name="title" class="form-control m-input" value="{{old('name',isset($data) ? $data->title : null)}}" autocomplete="off" placeholder=" {{__('Nhập tên module')}} ..">
                            </div>
                            <span class="m-form__help"> {{__('Tên module không được phép trùng')}} </span>
                        </div>
                        <div class="form-group m-form__group">
                                <label> {{__('Mô tả')}} </label>
                                <textarea name="description" required class="form-control" id="message" rows="3" placeholder="{{__('Mô tả')}}..">@if(isset($data)) {{$data->description}} @endif</textarea>
                        </div>
                        <div class="form-group m-form__group">
                            <label>{{__('Nội dung')}}</label>
                            <textarea name="content" class="form-control ckeditor" rows="3">@if(isset($data)) {{$data->content}} @endif</textarea>
                        </div>
                        <div class="form-group m-form__group">
                            <label> {{__('Class icon')}} </label>
                            <div class="input-group m-input-group">
                                <input type="text" name="icon" class="form-control m-input" value="{{old('icon',isset($data) ? $data->icon : null)}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <label> {{__('Chiều dài ảnh')}} </label>
                            <div class="input-group m-input-group">
                                <input required type="number" name="width_image" class="form-control m-input" value="{{old('width_image',isset($data) ? $data->width_image : null)}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <label> {{__('Chiều rộng ảnh')}} </label>
                            <div class="input-group m-input-group">
                                <input required type="number" name="height_image" class="form-control m-input" value="{{old('height_image',isset($data) ? $data->height_image : null)}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <label> {{__('Chiều dài ảnh mở rộng')}} </label>
                            <div class="input-group m-input-group">
                                <input required type="number" name="width_image_extension" class="form-control m-input" value="{{old('width_image_extension',isset($data) ? $data->width_image_extension : null)}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <label> {{__('Chiều rộng ảnh mở rộng')}} </label>
                            <div class="input-group m-input-group">
                                <input required type="number" name="height_image_extension" class="form-control m-input" value="{{old('height_image_extension',isset($data) ? $data->height_image_extension : null)}}" autocomplete="off">
                            </div>
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
    </div>
@stop
