<div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="form_result"></div>
				<form enctype="multipart/form-data" id="addData" name="addData">
					{{csrf_field()}}
					<div class="form-group">
						<label for="">Danh mục cha:</label>
						<select class="form-control" name="parrent_id" id="">
							<option value="0">----ROOT----</option>
							{!! getCategories($data, 0, "", 0 ) !!}
						</select>
					</div>
					<div class="form-group">
						<label class="form-control-label">Tên danh mục</label>
						<input type="text" class="form-control refresh" value="" autocomplete="off" name="title">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Mô tả</label>
						<textarea class="form-control refresh" name="description"></textarea>
					</div>
					<div class="input-group m-input-group">
						<label>Nội dung</label>
							<textarea required class="ckeditor ckeditor-add refresh " name="content" id="ckeditor-add" ></textarea>
					</div>
					<div class="form-group m-form__group">
						<div class="mb-5">
							<label class="my-3"> {{__('Ảnh hiển thị')}} :</label>
							<div></div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="image" id="file">
								<label class="custom-file-label" for="customFile">Chọn ảnh</label>
							</div>
							<br/>
								<img src="/assets/backend/images/empty-photo.jpg" class="mt-3 p-1 border rounded" width="100" height="100" id="image" />
						</div>
					</div>
					<div class="modal-footer">
						<button style="font-family: Arial, Helvetica, sans-serif" type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
						<button style="font-family: Arial, Helvetica, sans-serif" type="submit" class="btn btn-primary">Thêm mới</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	// add
	var slug = @json($module);
	// console.log(value);
	$("#addData").on('submit',function (event){
                event.preventDefault();
               var formData = new FormData(this);
               formData.append('content',CKEDITOR.instances['ckeditor-add'].getData());
               $.ajax({
                   type: 'POST',
                   url: slug,
                   data: formData,
                   cache: false,
                   contentType: false,
                   processData: false,
                   success: (data) => {
                       // window.setTimeout(window.location.reload.bind(window.location), 2000);
                       if(data.errors){
                           html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                           html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                           html += '</button>';
                           html += '<span>' + data.errors + '</span>' + '<br>';
                           html += '</div>';
                           $('#form_result').html(html);
                       }else{
                           $('#m_modal_4').modal('hide');
                           $('.alert-dismissible').hide();
                           location.reload();
                           CKEDITOR.instances['ckeditor-add'].setData('');
                           $('.refresh').val('');
                           jQuery("#files").val('');
                           toastr.success(data.success, 'Thông báo', {timeOut: 3000});
                       }

                   },   
                //    error: function (data) {
                //        toastr.error(data, 'Lỗi', {timeOut: 1000});
                //    },
               })
            });

</script>