<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8"/>
    <title> Administrator System </title>
    <meta name="description" content="Administrator System">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!--begin::Base Styles -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/assets/backend/theme/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/backend/theme/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--begin::Base Scripts -->
    <script src="/assets/backend/theme/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="/assets/backend/theme/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

    {{--datatable--}}
    <link href="/assets/backend/theme/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="/assets/backend/theme/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

    {{--nestable--}}
    <link rel="stylesheet" href="/assets/backend/plugins/nestable/nestable.css">
    <script src="/assets/backend/plugins/nestable/jquery.nestable.js"></script>

    <!-- jasny-bootstrap-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="/assets/backend/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css">
    <script src="/assets/backend/plugins/jasny-bootstrap/js/jasny-bootstrap.js"></script>

    {{--bootstrap-select--}}
    {{--<script src="/assets/backend/theme/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>--}}
    {{----------base js datetimepicker theme-------}}
    <script src="/assets/backend/theme/assets/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>

    {{--fancybox--}}
    <link rel="stylesheet" href="/assets/backend/plugins/fancybox/dist/jquery.fancybox.min.css">
    <script type="text/javascript" src="/assets/backend/plugins/fancybox/dist/jquery.fancybox.min.js"></script>

    {{--ckeditor--}}

    <script src="/assets/backend/plugins/ckeditor/ckeditor.js" charset="utf-8"></script>
    <script src="/assets/backend/plugins/ckfinder/ckfinder.js" charset="utf-8"></script>

    {{--bootbox--}}
    <script src="/assets/backend/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>

    {{--notify--}}
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script src="https://james-muriithi.github.io/jCheckBox/dist/jquery.jCheckBox.min.js"></script>
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css"/>
    {{-- <link href="/assets/backend/css/custom-input.css" rel="stylesheet" type="text/css"/> --}}
    <link href="/assets/backend/css/image.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="/assets/backend/images/favicon.jpg" type="image/x-icon">
    {{--  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    
</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- BEGIN: Header -->

    @include('admin._layouts.includes.header')

    <!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

        <!-- BEGIN: Aside Menu -->

        @include('admin._layouts.includes.sidebar')

            <!-- END: Aside Menu -->
        </div>

        <!-- END: Left Aside -->
        <!-- content -->
        @yield('content')



    </div>

    <!-- end:: Body -->

    <!-- begin::Footer -->

<!-- footer -->
        @include('admin._layouts.includes.footer')

    <!-- end::Footer -->
</div>

<!-- end:: Page -->

<!-- begin::Quick Sidebar -->

<!-- end::Quick Sidebar -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->

<!-- begin::Quick Nav -->

<!-- begin::Quick Nav -->

<!--begin::Global Theme Bundle -->


<script src="/assets/backend/theme/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors -->
<script src="/assets/backend/theme/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts -->
<script src="/assets/backend/theme/assets/app/js/dashboard.js" type="text/javascript"></script>
<script src="/assets/backend/theme/assets/demo/default/custom/crud/forms/widgets/dropzone.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{--common run js--}}
<script src="/assets/backend/js/common.js" type="text/javascript"></script>

<!--end::Page Scripts -->
<script src="/assets/backend/js/fileinput.js" type="text/javascript"></script>
<script src="/assets/backend/js/popper.min.js" type="text/javascript"></script>
<script src="/assets/backend/js/render-img.js" type="text/javascript"></script>
<script src="/assets/backend/theme/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"></script>
</body>


</html>