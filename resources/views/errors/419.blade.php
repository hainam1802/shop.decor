@extends('errors.layouts.index')
@section('title','419')
@section('content')
<div class="m-error_container">
	<div class="m-error_subtitle m--font-light">
		<h1>Oops...</h1>
	</div>
	<p style="font-family: Arial, Helvetica, sans-serif;" class="m-error_description m--font-light"> 
    <script>
               alert('Phiên làm việc đã hết hạn.Vui lòng tải lại trang và thực hiện lại');
               window.location.href = "{{url('')}}";

            </script>
	</p>
</div>
@stop