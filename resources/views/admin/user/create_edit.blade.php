@extends('admin._layouts.index')
@section('title','Quản lí thành viên')
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
                            <a href="{{route('user.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Quản lí thành viên')}} </span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    @if(isset($data))
                                         {{__('Thành viên')}} : {{$data->name}}
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
                                   {{__('Thành viên')}} : {{$data->name}}
                                @else
                                   {{__('Thêm thành viên')}}
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
                    <form class="m-form m-form--fit m-form--label-align-right"  method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('user.update',$data->id):route('user.store')}}">
                        {{csrf_field()}}
                        @if(isset($data))
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label> {{__('Họ tên')}} :</label>
                                <div class="input-group m-input-group">
                                    <input type="text" name="name" class="form-control m-input" value="{{old('name',isset($data) ? $data->name : null)}}" placeholder="{{__('Nhập họ tên')}}..">
                                </div>
                                <span class="m-form__help"> {{__('Vui lòng nhập đúng họ tên')}} </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label>Email:</label>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control m-input" value="{{old('email',isset($data) ? $data->email : null)}}" @if(isset($data)) readonly @endif placeholder="{{__('Nhập email')}}..">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2">@gmail.com</span></div>
                                </div>
                            </div>
                            @if(isset($data))
                            <div class="form-group m-form__group">
                                <label class="m-checkbox m-checkbox--state-success">
                                    <input type="checkbox" name="changePassword" id="changePassword"> {{__('Thay đổi mật khẩu')}}
                                    <span></span>
                                </label>
                            </div>
                            @endif
                            <div class="form-group m-form__group">
                                <label>{{__('Mật khẩu')}}:</label>
                                <div class="input-group m-input-group">
                                    <input @if(isset($data)) disabled @endif type="password" name="password" value="" class="form-control m-input password" placeholder="{{__('Nhập mật khẩu')}}...">
                                </div>
                            </div>
                                <div class="form-group m-form__group">
                                    <label>{{__('Nhập lại mật khẩu')}} :</label>
                                    <div class="input-group m-input-group">
                                        <input @if(isset($data)) disabled @endif type="password" name="re_password" class="form-control m-input password" placeholder="{{__('Nhập lại mật khẩu')}}...">
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
    <script>
        $(document).ready(function (){
                $("#changePassword").change(function (){
                    if($(this).is(':checked')){
                        $(".password").removeAttr('disabled');
                    }else{
                        $(".password").attr('disabled','');
                    }
                });
            });
    </script>
@stop
