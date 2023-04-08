@extends('admin._layouts.index')
@section('title','Ngôn ngữ hệ thống')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Ngôn ngữ hệ thống')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{route('language-nation.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Quản lí ngôn ngữ')}} </span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    @if(isset($data))
                                        {{__('Chỉnh sửa ngôn ngữ')}}: {{$data->title}}
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
                                   Ngôn ngữ: {{$data->title}}
                                @else
                                   Thêm mới
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
                    <form class="m-form m-form--fit m-form--label-align-right"  method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('language-nation.update',$data->id):route('language-nation.store')}}">
                        {{csrf_field()}}
                        @if(isset($data))
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label> {{__('Ngôn ngữ')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="text" name="title" required class="form-control m-input" value="{{old('title',isset($data) ? $data->title : null)}}" placeholder="{{__('Nhập tên ngôn ngữ')}}...">
                                </div>
                                <span class="m-form__help"> {{__('Ngôn ngữ được sử dụng trong quốc gia')}} </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Locale')}} </label>
                                <div class="input-group m-input-group">
                                    <input type="text" name="locale" required class="form-control m-input" value="{{old('locale',isset($data) ? $data->locale : null)}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group">
                                <label> {{__('Mô tả ngôn ngữ')}} </label>
                                <textarea name="description" class="form-control" id="message" rows="3" placeholder="{{__('Mô tả ngôn ngữ')}}..">@if(isset($data)) {{$data->description}} @endif</textarea>
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
                                    @if(isset($data))
                                        <img src="{{\App\Library\Files::media(old('image', isset($data) ? $data->image : "/assets/backend/images/empty-photo.jpg") )}}" class="mt-3 p-1 border rounded" width="50px" height="50px" id="image" />
                                    @else
                                        <img src="http://nicklolmobile.vn/assets/backend/images/empty-photo.jpg" class="mt-5" width="50" height="50px" id="image" />
                                    @endif
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
        <!-- END: Subheader -->
        <script>
            document.getElementById("files").onchange = function () {
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
