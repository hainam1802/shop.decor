@extends('admin._layouts.index')
@section('title','Quản lí bài viết')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__($name_module->title)}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Danh sách')}} </span>
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
                            {{__('Danh sách: '.$name_module->title)}}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{url('admin/module-item/'.$module.'/create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon">
                                <span>
                                    <i class="la la-calendar-check-o"></i>
                                    <span> {{__('Thêm mới')}} </span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                        @if($name_module->status == 2)
                        <li class="m-portlet__nav-item">
                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                    <i class="la la-ellipsis-h m--font-brand"></i>
                                </a>
                                <div class="m-dropdown__wrapper" style="z-index: 101;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">Cấu Hình</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href=" {{route('color-product.index')}} " class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">Danh sách màu sản phẩm</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form m-form--fit">
                    <div class="row m--margin-bottom-20">
                        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon-list-3 "></i></span></div>
                                <input type="text" class="form-control m-input" value="{{request('title')}}" autocomplete="off" id="title" name="title" placeholder=" {{__('Nhập tiêu đề')}} ..">
                            </div>
                        </div>
                        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la  la-user "></i></span></div>
                                <input type="text" class="form-control m-input" value="{{request('author')}}" autocomplete="off" id="author" name="author" placeholder=" {{__('Người đăng bài')}} ..">
                            </div>
                        </div>
                        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon-interface-3"></i></span></div>
                                <input type="text" class="form-control m-input" value="{{request('description')}}" autocomplete="off" id="description" name="description" placeholder="{{__('Mô tả')}} ..">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-section">
                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer text-center" role="grid" aria-describedby="m_table_1_info" id="table_main">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th> {{__('Tiêu đề')}} </th>
                                <th> {{__('Mô tả')}} </th>
                                <th> {{__('Hình ảnh')}} </th>
                                <th> {{__('Danh mục')}} </th>
                                <th> {{__('Người tạo')}} </th>
                                <th> {{__('Ngày tạo')}} </th>
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
                    <h5 class="modal-title" id="exampleModalLabel"> {{__('Xóa bài viết')}} </h5>
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
    var value = @json($module);
    var datatable;
    jQuery(document).ready(function (){
        datatable = $('#table_main').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('admin/module-item') !!}'+'/'+value,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'description', name: 'description' },
                    { data: 'image', title: 'Hình ảnh',
                        render: function ( data, type, row ) {
						if(row.image=="" || row.image==null){
							return  "<img class=\"image-item\" src=\"/assets/backend/images/empty-photo.jpg\" style=\"max-width: 50px;max-height: 50px\">";
						}
						else{
							return  "<a target='_blank' class=\"test-popup-link\" href="+row.image+"><img class=\"text-pop-link\" src=\""+row.image+"\" style=\"max-width: 50px;max-height: 50px\">";
						}
					}
                     },
                    { data: 'parrent_id', name: 'parrent_id' },
                    { data: 'author', name: 'author' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name:'action' } 
                ]
        });
        $('#title').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);

        $('#author').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);
        
        $('#description').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);

        $('#parrent_id').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);
        $('#started_at').donetyping(function () {
            datatable.search( this.value ).draw();
        }, 600);
    })
    </script>

@stop
