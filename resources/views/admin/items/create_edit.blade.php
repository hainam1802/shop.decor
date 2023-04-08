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
                            <a href="{{url('admin/module-item/'.$module)}}" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__($name_module->title)}} </span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    @if(isset($data))
                                        {{$data->title}}
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
                                   {{__('Bài viết')}}: {{$data->title}}
                                @else
                                   {{__('Thêm mới')}}
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            @foreach($errors->all() as $err)
                                <strong>{{__('Thông báo')}} !</strong> {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    <form class="m-form m-form--fit m-form--label-align-right"  method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? url('admin/module-item/'.$module.'/edit/'.$data->id):url('admin/module-item/'.$module)}}">
                        {{csrf_field()}}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label class="mb-3"> {{__('Danh mục')}} :</label>
                                    @if(isset($data))
                                        <select class="form-control" name="parrent_id" id="">
                                        <option value="0">---- {{__('Không chọn')}} ----</option>
                                            {!! getCategories($groups, 0, "",$data['parrent_id'] ) !!}
                                        </select>
                                    @else
                                        <select class="form-control" name="parrent_id" id="">
                                        <option value="0">---- {{__('Không chọn')}} ----</option>
                                            {!! getCategories($groups, 0, "", 0 ) !!}
                                        </select>
                                    @endif
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Tiêu đề')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="text" id="title" onload="ChangeToSlug();" onkeyup="ChangeToSlug();" name="title" required class="form-control m-input" value="{{old('title',isset($data) ? $data->title : null)}}" placeholder="{{__('Nhập tiêu đề bài viết')}}...">
                                </div>
                                <span class="m-form__help">{{__('Tiêu đề bài viết')}}</span>
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Slug')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="text" onload="ChangeToSlug();" onkeyup="ChangeToPermalink()"; disabled id="slug" name="slug" required class="form-control m-input slug" value="{{old('slug',isset($data) ? $data->slug : null)}}" placeholder="{{__('Nhập tiêu đề bài viết')}}...">
                                </div>
                                <div class="input-group m-input-group mt-4">
                                Permalink : <p>{{ \Request::ip().'/'.$module }}/<span id="slug-text"></span></p>
                                </div>
                            </div>
                                <div class="form-group m-form__group">
                                    <label class="m-checkbox m-checkbox--state-success">
                                        <input type="checkbox" name="changeTitle" id="changeTitle">{{__(' Chỉnh sửa Slug')}}
                                        <span></span>
                                    </label>
                                </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Mô tả')}} </label>
                                <textarea name="description" required class="form-control" id="message" rows="3" placeholder="{{__('Mô tả')}}..">@if(isset($data)) {{$data->description}} @endif</textarea>
                            </div>
                            <div class="form-group m-form__group">
                            <label>{{__('Nội dung')}}</label>
                                <textarea name="content" class="form-control ckeditor" rows="3">@if(isset($data)) {{$data->content}} @endif</textarea>
                            </div>
                            @if($name_module->status == 2)
                            <div class="form-group m-form__group">
                                <label> {{__('Giá bán')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="number" name="price_old" class="form-control m-input" value="{{old('price_old',isset($data) ? $data->price_old : null)}}" autocomplete="off" placeholder=" {{__('Giá gốc')}} ..">
                                </div>
                                <span class="m-form__help"> {{__('Giá gốc cho sản phẩm')}} </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Sale')}} (%) </label>
                                <div class="input-group m-input-group">
                                    <input type="number" name="sale" class="form-control m-input" value="{{old('sale',isset($data) ? $data->sale : null)}}" autocomplete="off" placeholder=" {{__('Mức Sale (%)')}} ..">
                                </div>
                                <span class="m-form__help"> {{__('Mức Sale của sản phẩm')}} </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Tổng số sản phẩm')}}</label>
                                <div class="input-group m-input-group">
                                    <input type="number" name="totalitems" class="form-control m-input" value="{{old('totalitems',isset($data) ? $data->totalitems : null)}}" autocomplete="off" placeholder=" {{__('Tổng số mặt hàng')}} ..">
                                </div>
                            </div>
                            <div class="form-group m-form__group">
                                <label class="col-form-label">Chọn Size</label>
									<select class="form-control m-bootstrap-select m_selectpicker" name="size[]" multiple>
									    <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
									</select>
                            </div>
                            <div class="form-group m-form__group">
                                <label class="col-form-label">Màu sắc</label>
                                <select class="form-control color" id="m_select2_3" name="color[]" multiple="multiple">
                                    @foreach($color as $colors)
                                        <option value="{{$colors->title}}">{{$colors->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            @if($name_module->status == 1)
                            <div class="form-group m-form__group">
                                <label> {{__('Nguồn bài viết')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="text" name="url" class="form-control m-input" value="{{old('url',isset($data) ? $data->title : null)}}" autocomplete="off" placeholder=" {{__('Nguồn bài viết')}} ..">
                                </div>
                                <span class="m-form__help"> {{__('Nguồn bài viết (nếu có)')}} </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Trạng thái url')}} </label>
                                <div class="input-group m-input-group">
                                    <select name="target" class="form-control m-input">
                                        <option value="_blank">Mở trong tab mới</option>
                                        <option value="_self">Mở trong tab hiện tại</option>
                                        <option value="_parent">Mở trong khung chính</option>
                                        <option value="_top"> Mở trong toàn bộ phần nội dung của cửa sổ</option>
                                    </select>
                                </div>
                                <span class="m-form__help"> {{__('Tên module không được phép trùng')}} </span>
                            </div>
                            @endif
                            <div class="form-group m-form__group">
                                <label> {{__('Nổi bật')}} </label>
                                <div class="input-group m-input-group">
                                    <select name="status" class="form-control m-input">
                                        <option value="0">Không</option>
                                        <option value="1">Có</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group m-form__group">
                                <div class="mb-5">
                                    <label class="mb-3"> {{__('Ảnh hiển thị')}} :</label>
                                    <div></div>
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="image" id="file">
										<label class="custom-file-label" for="customFile">Chọn ảnh</label>
									</div>
                                    <br/>
                                        <img src="{{\App\Library\Files::media(old('image', isset($data) ? $data->image : "/assets/backend/images/empty-photo.jpg") )}}" class="mt-3 p-1 border rounded" width=" {{($name_module->width_image)/3}} " height=" {{($name_module->height_image)/3}} " id="image" />
                                </div>
                            </div>
                            <div class="form-group m-form__group">
                                <label class="mb-3" > {{__('Ảnh mở rộng')}} :</label>
                                <input id="input-b3" name="image_extension[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-msg-placeholder="Chọn ảnh...  ">
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
        <script src="/assets/backend/theme/assets/demo/default/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
     
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".file-preview-thumbnails").draggable({
                scroll: false,
                axis: "x",
                containment: "parent",
                revert: true,
                helper: "orginal",
                disable: false,
                start: function( event, ui ) {
                    $(ui.item).addClass("active-draggable");
                },
                drag: function( event, ui ) {
                },
                stop:function( event, ui ) {
                    $(ui.item).removeClass("active-draggable");
                }
                });
                     
                $( ".file-preview" ).droppable({
                    accept: ".file-preview-thumbnails",
                    class: {
                    "ui-droppable-active":"ac",
                    "ui-droppable-hover":"hv"
                },
                acivate: function( event, ui ) {
                    $(this).css('background','red');
                },
                over: function( event, ui ) {
                    $(this).css('background','yellow');
                },
                out: function( event, ui ) {
                    $(this).css('background','blue');
                },
                drop: function( event, ui ) {
                    $(this).css('background','white');
                },
                deactivate: function( event, ui ) {
                    $(ui.item).css('background','green');
            },
                });
            });
        </script>
        <script src="/assets/backend/js/slug.js" type="text/javascript"></script>
    </div>
@stop
