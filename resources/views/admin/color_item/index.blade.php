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
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Màu sắc sản phẩm')}} </span>
                            </a>
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
                            {{__('Danh sách ngôn ngữ')}}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <a href="{{route('color-product.create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon">
                        <span>
                            <i class="la la-calendar-check-o"></i>
                            <span> {{__('Thêm màu sắc')}} </span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section" >
                    @if(count($errors)>0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            @foreach($errors->all() as $err)
                                <strong>{{__('Thông báo')}} !</strong> {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer text-center" role="grid" id="table_main">
                        <thead> 
                            <tr>
                                <th>ID</th>
                                <th> {{__('Màu sắc')}} </th>
                                <th> {{__('Hành động')}} </th>
                            </tr>
                            @foreach($data as $key => $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                                    <a href="{{route('color-product.edit',[$item->id])}}" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
            <!--end::Form-->
        </div>
        </div>
        <!-- END: Subheader -->
    </div>
@stop
