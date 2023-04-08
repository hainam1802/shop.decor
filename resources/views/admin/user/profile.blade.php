@extends('admin._layouts.index')
@section('title','Chỉnh sửa thông tin')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Thông tin cá nhân')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    {{__('Chỉnh sửa thông tin')}}
                                </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-content">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__body">
                            <div class="m-card-profile">
                                <div class="m-card-profile__title m--hide">
                                    {{__('Thông tin cá nhân')}}
                                </div>
                                <div class="m-card-profile__pic">
                                    <div class="m-card-profile__pic-wrapper">
                                        @if($data->image)
                                            <img src="{{\App\Library\Files::media( $data->image )}}" alt="">
                                        @else
                                            <img src="/assets/backend/images/image-user.jpg" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="m-card-profile__details">
                                    <span class="m-card-profile__name">{{$data->name}}</span>
                                    <p class="m-card-profile__email m-link"> {{$data->email}} </p>
                                </div>
                                <!--           -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <ul class="nav nav-tabs  m-tabs-line m-tabs-line--success" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_2_1" role="tab"> {{__('Thông tin')}} </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_2_3" role="tab"> {{__('Đổi mật khẩu')}} </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="m_tabs_2_1" role="tabpanel">
                                        @if(count($errors)>0)
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                </button>
                                                @foreach($errors->all() as $err)
                                                    <strong>{{__('Thông báo')}} !</strong> {{$err}}<br>
                                                @endforeach
                                            </div>
                                        @endif
                                        <form action="{{route('user.post-profile')}}" method="post" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="m-portlet__body">

                                                <div class="form-group m-form__group row">
                                                    <label class="col-sm-3 col-form-label"> {{__('Tên hiển thị')}} </label>
                                                    <div class="col-7">
                                                        <input type="text" name="name" class="form-control m-input" value="{{old('name',$data->name)}}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label class="col-sm-3 col-form-label"> {{__('Email')}} </label>
                                                    <div class="col-7">
                                                        <input type="email" name="email" class="form-control m-input" value="{{old('name',$data->email)}}" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label class="col-sm-3 col-form-label"> {{__('Địa chỉ')}} </label>
                                                    <div class="col-7">
                                                        <input type="text" name="address" class="form-control m-input" value="{{old('address',$data->address)}}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label class="col-sm-3 col-form-label"> {{__('Số điện thoại')}} </label>
                                                    <div class="col-7">
                                                        <input type="text" name="phone" class="form-control m-input" value="{{old('phone',$data->phone)}}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label class="col-sm-3 col-form-label"> {{__('Hình ảnh')}} </label>
                                                    <div class="col-sm-7">
                                                        <label>
                                                            <input type="file" id="files" name="image">
                                                        </label>
                                                        {{-- <img src="assets/app/media/img/users/user4.jpg" class="mt-5" width="100px" height="100px" id="image" /> --}}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="m-portlet__foot m-portlet__foot--fit">
                                                <div class="m-form__actions">
                                                    <div class="col-12 text-right">
                                                        <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom"> {{__('Cập nhật')}} </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="m_tabs_2_3" role="tabpanel">
                                        <form action="{{route('user.post-profile')}}" method="post" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="m-portlet__body">

                                                <div class="form-group m-form__group row">
                                                    <label class="col-sm-3 col-form-label"> {{__('Mật khẩu mới')}} </label>
                                                    <div class="col-7">
                                                        <input type="password" name="password" required class="form-control m-input" placeholder=" {{__('Mật khẩu mới')}} ...">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-sm-3 col-form-label"> {{__('Nhập lại mật khẩu')}} </label>
                                                    <div class="col-7">
                                                        <input type="password" name="re_password" required class="form-control m-input" placeholder=" {{__('Nhập lại mật khẩu')}} ..." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-portlet__foot m-portlet__foot--fit">
                                                <div class="m-form__actions">
                                                    <div class="col-12 text-right">
                                                        <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom"> {{__('Cập nhật')}} </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->

    </div>
@stop