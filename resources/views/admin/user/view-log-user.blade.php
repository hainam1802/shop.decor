@extends('admin._layouts.index')
@section('title','Nhật kí hoạt động')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Nhật kí hoạt động')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Thành viên')}} : {{$user->name}} </span>
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
                            {{__('Nhật kí hoạt động')}}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <form class="mt-3" action="{{url('admin/log-user/export/'.$user->id)}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-success m-btn m-btn--custom m-btn--icon"> <i class="fas fa-file-export"></i> {{__('Xuất Excel')}} </button>
                    </form>
                </div>
            </div>
            <div class="m-portlet__body">
                {{-- <div class="m-form m-form--fit">
                    <div class="row m--margin-bottom-20">
                        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user "></i></span></div>
                                <input type="text" class="form-control m-input" value="{{request('name')}}" autocomplete="off" id="name" name="name" placeholder=" {{__('Nhập tên người dùng')}} ..">
                            </div>
                        </div>
                        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                <input type="text" class="form-control m-input" value="{{request('phone')}}" autocomplete="off" id="phone" name="phone" placeholder=" {{__('Nhập số điện thoại')}}.. ">
                            </div>
                        </div>
                        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-address-book"></i></span></div>
                                <input type="text" class="form-control m-input" value="{{request('address')}}" autocomplete="off" id="address" name="address" placeholder=" {{__('Nhập địa chỉ')}}.. ">
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="m-section" >
                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer text-center" role="grid" aria-describedby="m_table_1_info" id="table_main">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th> {{__('Ngày')}} </th>
                                <th> {{__('Thời gian')}} </th>
                                <th> {{__('Hành động')}} </th>
                                <th> {{__('Url')}} </th>
                                <th> {{__('Ip')}} </th>
                                <th> {{__('Trình duyệt')}} </th>
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
    var id = @json($id);
    // console.log('{!! url('admin/log-user') !!}'+'/'+id);
    var datatable;
    jQuery(document).ready(function (){
        datatable = $('#table_main').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('admin/log-user') !!}'+'/'+id,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'data' },
                    { data: 'time', name: 'time' },
                    { data: 'description', name: 'description' },
                    { data: 'url', name: 'url' },
                    { data: 'ip_address', name:'ip_address' },
                    { data: 'user_agent', name:'user_agent' } 
                ]
        });
        // $('#name').donetyping(function () {
        //     datatable.search( this.value ).draw();
        // }, 600);
        // $('#phone').donetyping(function () {
        //     datatable.search( this.value ).draw();
        // }, 600);
        // $('#address').donetyping(function () {
        //     datatable.search( this.value ).draw();
        // }, 600);
    })
    </script>

@stop
