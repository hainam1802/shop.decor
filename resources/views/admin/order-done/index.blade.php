@extends('admin._layouts.index')
@section('title','Xử lí đơn hàng')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Xử lí đơn hàng')}} </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator mr-3">-  </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text"> {{__('Đơn hàng đã xử lí')}} </span>
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
                        {{__('Đơn hàng đã xử lí')}}
                    </h3>
                </div>
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
                            <th> {{__('Khách hàng')}} </th>
                            <th> {{__('Địa chỉ')}} </th>
                            <th> {{__('Email')}} </th>
                            <th> {{__('Số điện thoại')}} </th>
                            <th> {{__('Sản phẩm')}} </th>
                            <th> {{__('Tổng tiền')}} </th>
                            <th> {{__('Ngày mua')}} </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--end::Form-->
    </div>
    </div>
    <!-- END: Subheader -->
</div>
<script>
    var datatable;
    jQuery(document).ready(function (){
    datatable = $('#table_main').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('order-done.index') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'address', name:'address' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'content', name: 'content' },
                { data: 'total', name: 'total' },
                { data: 'created_at', name: 'created_at' },
            ]
        });
    })

</script>
@stop