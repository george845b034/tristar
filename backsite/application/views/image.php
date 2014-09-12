	
	<div class="container">
		<?php $this->load->view('menu');?>
		<div class="col-lg-10">
			<span class="btn btn-info pull-right insert_dom" name="image_popup">新增</span>
			<table class="table table-striped">
				<thead>
				<tr>
					<th>圖片名稱</th>
					<th>圖片種類</th>
					<th>圖片</th>
					<th>編輯</th>
				</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						foreach ($result as $key => $value) {
							$lightboxDom = '';
							//給lightbox使用
							$imageArray = json_decode($value["mp_image"]);
							foreach ($imageArray as $key2 => $value2) {
								$lightboxDom .= '<input class="lightbox_'. $value["mp_id"] .'" type="hidden" value="../uploads/'. $value2 .'"/>';
							}
							echo '
								<tr>
									<td>'. $value["mp_name"] .'</td>
									<td>'. $value["it_name"] .'</td>
									<td><img onClick="popupLightBox(\'lightbox_'. $value["mp_id"] .'\')" src="../uploads/thumb/'. $imageArray[0] .'" /></td>
									<td>
										<span class="glyphicon glyphicon-edit cursor edit_dom" name="image_popup"></span>
										<span class="glyphicon glyphicon-trash cursor remove_dom" name="'. $value["mp_id"] .'" data-delete="2" data-idKey="mp_id"></span>
									</td>
									'. $lightboxDom .'
									<input type="hidden" name="mp_id" value="'. $value["mp_id"] .'"/>
									<input type="hidden" name="mp_name" value="'. $value["mp_name"] .'"/>
									<input type="hidden" name="mp_type" value="'. $value["mp_type"] .'"/>
								</tr>
							';
							$i++;
						}
					?>
				</tbody>
			</table>
		</div>
		<div id="page_bar"></div>
		<div class="height50 clear"></div><!-- just for layout -->
    </div><!-- /.container -->
	
	<!-- Begin 新增圖片 -->
	<div class="panel panel-primary" id="image_popup">
		<div class="panel-heading text-center">新增圖片<span class="glyphicon glyphicon-remove pull-right cursor" onClick="javascript:$.unblockUI();"></span></div>
		<div class="panel-body">
			<form class="dom_form" name="image" method="POST" enctype="multipart/form-data">
				<!-- <input type="hidden" value="1" name="type"/> -->
				<input type="hidden" name="id" value=""/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">圖片種類</label>
					</div>
					<div class="col-lg-3">
						<select class="form-control" name="mp_type">
							<?php
								foreach ($category as $key => $value) {
									echo '<option value="'. $key .'">'. $value .'</option>';
								}
							?>
							
						</select>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">圖片名稱</label>
					</div>
					<div class="col-lg-3">
						<input type="text" class="form-control required " value="" name="mp_name"/>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">上傳圖片</label>
					</div>
					<div class="col-lg-3">
						<input type="file" multiple="multiple" class="required " name="mp_image[]"/>
					</div>
				</div>
				<hr>
				<div id="image_div" class="pull-right">
					<button class="btn btn-primary pull-right dom_submit" type="button" data-insert="1" data-edit="3"><span class="glyphicon glyphicon-plus icon-white"></span> submit</button>
				</div>
			</form>
		</div>
	</div>
	<!-- End 新增圖片 -->