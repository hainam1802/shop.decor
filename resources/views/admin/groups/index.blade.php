@extends('admin._layouts.index')
@section('title','Quản lí danh mục')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <ul class="bread_custom m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="/admin" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home" style="width:28px"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        /
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link active">
                            <span class="m-nav__link-text">
                                Danh mục bài viết
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Danh mục bài viết
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <button type="button" class="btn btn-success m-btn m-btn--custom m-btn--icon" data-toggle="modal" data-target="#m_modal_4">
                                        <span>
                                            <i class="la la-calendar-check-o"></i>
                                            <span>Thêm danh mục</span>
                                        </span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--begin::Portlet_body-->
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-sm-8" id="#content_well">
                                <div class="well">
                                    <div class="lead text-right">
                                        <div class="" style="float: right">
                                            <a  href="#" class="btn btn-danger m-btn  delete_selected"  style="display: none">
                                                Xóa mục đã chọn
                                            </a>
                                            <a href="#" id="nestable-menu-action" data-action="collapse-all" class="btn btn-info m-btn">
                                                Thu gọn tất cả
                                            </a>
                                        </div>
                                        <p class="success-indicator" style="display:none; margin-right: 15px;float: left;color: #34bfa3;font-size: 14px">
                                            <span class="glyphicon glyphicon-ok"></span> Danh mục đã được cập nhật !
                                        </p>
    
                                    </div>
                                    <div class="" style="clear: both"></div>
                                    <div class="dd" id="nestable">
                                        {!! $datatable !!}
                                    </div>
                                    {{ Form::close() }}
    
                                </div>
                            </div>
                            <div class="col-sm-4 d-none d-sm-block">
                                <div class="well">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="flaticon-light"></i>
                                        </div>
                                        <div class="m-demo-icon__class" style="font-size: 14px">
                                            Kéo thả để sắp xếp danh mục
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('admin.groups.addgroups')
    
                        <!-- edit item Modal -->
                        <div class="modal fade" id="editModal"  role="dialog" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                </div>
                            </div>
                        </div>
    
                        <!-- delete item Modal -->
                        <div class="modal fade" id="deleteModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    {{Form::open(array('url'=>array('admin/module-category/'.$module,0),'class'=>'form-horizontal','method'=>'POST'))}}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận thao tác</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn thực sự muốn xóa?
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id" value=""/>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-danger m-btn m-btn--custom">Xóa</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet_body-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
    <script>
        var value = @json($module);
        // console.log('{!! url('admin/module-category') !!}'+'/'+value+'/'+'postUpdateOrder');
		// edit button
		$('.edit_toggle').each(function (index, elem) {
			$(elem).click(function (e) {

				e.preventDefault();
				$('#editModal .modal-content').empty();
				$('#editModal .modal-content').load($(this).attr("href"),function(){
					$('#editModal').modal({show:true});
				});
			});
		});

		// delete button
		$('.delete_toggle').each(function (index, elem) {
			$(elem).click(function (e) {

				e.preventDefault();
				$('#deleteModal .id').attr('value', $(elem).attr('rel'));
				$('#deleteModal').modal('toggle');
			});
		});
		// delete button all
		$('.delete_selected').click(function (e) {

			var id_delete = '';
			var total = $("#nestable input[type=checkbox]").length;

			$("#nestable input[type=checkbox]").each(function (index, elem) {
				if ($(elem).is(':checked')) {
					id_delete = id_delete + $(elem).attr('rel');
					if (index !== total - 1) {
						id_delete = id_delete + ',';
					}
				}
			});
			$('#deleteModal .id').attr('value', id_delete);
			$('#deleteModal').modal('toggle');
		});
		// end delete button all


		$(".m-checkbox input[type='checkbox']").change(function() {


			if($(".m-checkbox input[type='checkbox']:checked").length==0){
				$('.delete_selected').hide();
			}
			else{
				$('.delete_selected').show();
			}
		});

		//nestable
		$(function () {
			$('.dd').nestable({
				dropCallback: function (details) {
					var order = new Array();
					$("li[data-id='" + details.destId + "']").find('ol:first').children().each(function (index, elem) {
						order[index] = $(elem).attr('data-id');
					});

					if (order.length === 0) {
						var rootOrder = new Array();
						$("#nestable > ol > li").each(function (index, elem) {
							rootOrder[index] = $(elem).attr('data-id');
						});
					}
                    
                    
					$.post('{!! url('admin/module-category') !!}'+'/'+value+'/update-order',
							{
								_token:'{{ csrf_token() }}',
								source: details.sourceId,
								destination: details.destId,
								order: JSON.stringify(order),
								rootOrder: JSON.stringify(rootOrder)
							},
							function (data) {
								// console.log('data '+data);
							})
							.done(function () {

								$(".success-indicator").fadeIn(100).delay(1000).fadeOut();
							})
							.fail(function () {
							})
							.always(function () {
							});
				}
			});


		});
		//nestable action
		$('#nestable-menu-action').on('click', function(e)
		{
			action =$(this).attr('data-action');
			if (action === 'expand-all') {


				$(this).text('Thu gọn tất cả');
				$(this).attr('data-action','collapse-all');
				//thực hiện thao tác expand-all
				$('.dd').nestable('expandAll');
			}
			else{
				$(this).text('Mở rộng tất cả');
				$(this).attr('data-action','expand-all');
				//thực hiện thao tác collapse-all
				$('.dd').nestable('collapseAll');
			}

		});
		//end nestable action
		$("#nestable input[type='checkbox']").change(function () {

			//click children
			$(this).closest('.dd-item').find("input[type='checkbox']").prop('checked', this.checked);
			var is_checked = $(this).is(':checked');

			$('.delete_selected').hide();
			$("#nestable input[type='checkbox']").each(function (index, elem) {

				if ($(elem).is(':checked')) {
					$('.delete_selected').show();
					return;
				}
			});
		});

	</script>
</div>

@stop