@extends('admin._layouts.index')
@section('title','Cài đặt')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Cấu hình hệ thống')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Cấu hình')}} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    <!-- END: Subheader -->
    <form method="post" action="{{ route('setting.store') }}">
        {!! csrf_field() !!}
        <div class="m-content">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="">

                    <div class="m-portlet__head">
                        <div class="m-portlet__head-progress">

                            <!-- here can place a progress bar-->
                        </div>
                        <div class="m-portlet__head-wrapper">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Cấu hình hệ thống
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success  m-btn m-btn--icon m-btn--wide m-btn--custom">
                                                    <span>
                                                        <i class="la la-check"></i>
                                                        <span> {{__('Lưu lại')}} </span>
                                                    </span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body">
                        <ul class="nav nav-tabs  m-tabs-line m-tabs-line--success" role="tablist">

                            @if(count(config('setting_fields', [])) )
                                @foreach(config('setting_fields') as $section => $fields)
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link {{array_get($fields, 'class')}}" data-toggle="tab" href="#{{$section}}" role="tab" aria-selected="true"><i class="{{ array_get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i> {{ $fields['title'] }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                        <div class="tab-content">
                            @if(count(config('setting_fields', [])) )

                                @foreach(config('setting_fields') as $section => $fields)
                                    <div class="tab-pane {{array_get($fields, 'class')}}" id="{{$section}}" role="tabpanel">

                                        @foreach($fields['elements'] as $field)
                                            @includeIf('admin.setting.fields.' . $field['type'] )
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="m-portlet__foot">
                        <div class="row align-items-center">

                            <div class="col-lg-12 m--align-right">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success  m-btn m-btn--icon m-btn--wide m-btn--custom">
                                                    <span>
                                                        <i class="la la-check"></i>
                                                        <span> {{__('Lưu lại')}} </span>
                                                    </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- <div class="m-portlet__body">--}}
                        {{--<form class="m-form m-form--label-align-left- m-form--state-" id="m_form">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xl-8 offset-xl-2">--}}
                                    {{--@if(count(config('setting_fields', [])) )--}}
                                        {{--@foreach(config('setting_fields') as $section => $fields)--}}
                                            {{--<div class="panel panel-info">--}}
                                                {{--<div class="panel-heading">--}}
                                                    {{--<i class="{{ array_get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>--}}
                                                    {{--{{ $fields['title'] }}--}}
                                                {{--</div>--}}
                                                {{--<div class="panel-body">--}}
                                                    {{--<p class="text-muted">{{ $fields['desc'] }}</p>--}}
                                                {{--</div>--}}
                                                {{--<div class="panel-body">--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-md-7  col-md-offset-2">--}}
                                                            {{--@foreach($fields['elements'] as $field)--}}
                                                                {{--@includeIf('admin.setting.fields.' . $field['type'] )--}}
                                                            {{--@endforeach--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--<!-- end panel for {{ $fields['title'] }} -->--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div> --}}
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>
    </form>
    </div>
@stop
