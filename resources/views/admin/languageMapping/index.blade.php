@extends('admin._layouts.index')
@section('title','Biên dịch')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"> {{__('Biên dịch')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text"> {{__('Thêm bản dịch từ khóa')}} </span>
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
                            {{__('Biên dịch')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet">
				<div class="m-portlet__body  m-portlet__body--no-padding">
					<div class="row m-row--no-padding m-row--col-separator-xl">
						<div class="col-xl-6 text-center">
                            <div class="m-widget1">
                                <div class="well">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="flaticon-light"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            <ul>
                                                <li> {{__('Tại đây người dùng có thể xuất ra file excel các từ khóa trong hệ thống bao gồm những từ khóa đã được phiên dịch và những từ khóa chưa được phiên dịch')}} </li>
                                                <li> {{__('Những từ khóa này được lấy từ bảng từ khóa trong')}} <a href=" {{route('language-key.index')}} "> {{__('bảng ngôn ngữ hệ thống')}} </a>, {{__('bạn có thể thêm mới từ khóa')}} <a href="{{route('language-key.create')}}"> {{__('tại đây')}} </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <form class="mt-3" action="{{route('language.export')}}" method="post">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-primary ml-4"> {{__('Xuất Excel')}} </button>
                                </form>
                            </div>
                        </div>
					    <div class="col-xl-6 text-center">
                            <div class="m-widget1">
                            <div class="well">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="flaticon-light"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            <ul>
                                                <li> {{__('Nhập dữ liệu trực tiếp từ file excel để gửi lên hệ thống')}} </li>
                                                <li> {{__('Vui lòng dữ nguyên bản form của dữ liệu khi tải về')}} </li>
                                                <li> {{__('Trường bản dịch có thể để trống nếu không cần thiết')}} !</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <form class="mt-5" action="{{route('language.import')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <input required id="file_language" type="file" name="file_language" class="hidden" accept=".xlsx, .xls, .csv, .ods">
                                    <button type="submit" class="btn btn-primary"> {{__('Nhập Excel')}} </button>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
            <div class="m-portlet">
				<div class="m-portlet__body  m-portlet__body--no-padding">
                        <div class="m-widget1">
                            @if(count($errors)>0)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                @foreach($errors->all() as $err)
                                    <strong> {{__('Thông báo')}} !</strong> {{$err}}<br>
                                @endforeach
                            </div>
                            @endif
                                <div class="well">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="flaticon-light"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            <ul>
                                                <li> {{__('Tại đây sẽ ghi kí tự được dịch vào hệ thống, sau bước này bạn có thể biên dịch theo ngôn ngữ mình đã dịch')}} </li>
                                                <li> {{__('Những từ khóa này được lấy từ bảng từ khóa trong')}}  <a href=" {{route('language-key.index')}} "> {{__('bảng ngôn ngữ hệ thống')}} </a>, {{__('bạn có thể thêm mới từ khóa')}} <a href="{{route('language-key.create')}}"> {{__('tại đây')}} </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <form class="mt-3 text-center" action="{{route('language.render')}}" method="post">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-primary ml-4"> {{__('Ghi bản dịch')}} </button>
                                </form>
                            </div>
				</div>
			</div>

            <!--end::Form-->
        </div>
        </div>
        <!-- END: Subheader -->
    </div>
@stop
