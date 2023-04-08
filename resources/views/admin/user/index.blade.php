@extends('admin._layouts.index')
@section('title','Danh sách thành viên')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Quản lí thành viên')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Danh sách thành viên')}} </span>
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
                            {{__('Danh sách thành viên')}}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <a href="{{route('user.create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon">
                        <span>
                            <i class="la la-calendar-check-o"></i>
                            <span> {{__('Thêm thành viên')}} </span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form m-form--fit">
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
                </div>

                <div class="m-section" >
                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer text-center" role="grid" aria-describedby="m_table_1_info" id="table_main">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th> {{__('Họ tên')}} </th>
                                <th> {{__('Email')}} </th>
                                <th> {{__('Địa chỉ')}} </th>
                                <th> {{__('Số điện thoại')}} </th>
                                <th> {{__('Hành động')}} </th>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{__('Xóa thành viên')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('Bạn có muốn xóa')}} ?
                </div>
                <div class="modal-footer">
                    <form id="form-delete" role="form" method="POST" enctype="multipart/form-data" action="">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Quay lại')}} </button>
                        <button type="submit" class="btn btn-primary"> {{__('Xóa')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    $(document).ready(function(){

        $('#exampleModal').on('show.bs.modal', function(e) {
            var action=$( e.relatedTarget).data('action');
            $('#form-delete').attr('action',action );
        });
    });
    var datatable;
    jQuery(document).ready(function (){
        datatable = $('#table_main').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('user.datatable') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'address', name: 'address' },
                    { data: 'phone', name: 'phone' },
                    { data: 'action', name:'action' } 
                    // { data: 'id',"render":function(data,type,row){
                    //     var table = $('#user-table').DataTable(),
                    //     id = table.row(this).id();
                    //     html = '<a href="admin/user/'+data+'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-edit"></i></a>'
                    // } }
                ]
        });
        $('#name').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);
        $('#phone').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);
        $('#address').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);
    })
    </script>

@stop
