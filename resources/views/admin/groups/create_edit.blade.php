@extends('admin._layouts.index')
@section('title','Danh mục')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Quản lí danh mục')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{ url('admin/module-category/'.$module) }}" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Danh mục: '.$name_module->title)}} </span>
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
                    <form class="m-form m-form--fit m-form--label-align-right"  method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? url('admin/module-category/'.$module.'/edit/'.$data->id):url('admin/module-category/'.$module)}}">
                        {{csrf_field()}}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label> {{__('Tiêu đề')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="text" name="title" class="form-control m-input" value="{{old('title',isset($data) ? $data->title : null)}}" placeholder="{{__('Nhập tên danh mục')}}...">
                                </div>
                                <span class="m-form__help"> {{__('Tiêu đề danh mục')}} </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Mô tả')}} </label>
                                <textarea name="description" class="form-control" id="message" rows="3" placeholder="{{__('Mô tả danh mục')}}..">@if(isset($data)) {{$data->description}} @endif</textarea>
                            </div>
                            @if(isset($data))
                        <div class="form-group m-form__group">
                            <label for="">{{__('Danh mục cha')}}:</label>
                            <select class="form-control" name="parrent_id" id="">
                                <option value="0">---- {{__('Không chọn')}} ----</option>
                                {!! getCategories($groups, 0, "", $data['parrent_id']) !!}
                            </select>
                        </div>
                        @else
                        <div class="form-group m-form__group">
                            <label for="">{{__('Danh mục cha')}}:</label>
                            <select class="form-control" name="parrent_id" id="">
                                <option value="0">---- {{__('Không chọn')}} ----</option>
                                {!! getCategories($groups, 0, "", 0 ) !!}
                            </select>
                        </div>
                        @endif
                            <div class="form-group m-form__group">
                                <div class="mb-5">
                                    <label class="mb-3">{{__('Ảnh hiển thị')}}:</label>
                                    <div></div>
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="image" id="file">
										<label class="custom-file-label" for="customFile">Chọn ảnh</label>
									</div>
                                    <br/>
                                    <img src="{{\App\Library\Files::media(old('image', isset($data) ? $data->image : "/assets/backend/images/empty-photo.jpg") )}}" class="mt-3 p-1 border rounded" width="100px" height="100px" id="image" />
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
