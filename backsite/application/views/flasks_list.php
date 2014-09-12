	
	<div class="container">
		<?php $this->load->view('menu');?>
		<div class="col-lg-10">
			<span class="btn btn-info pull-right insert_dom" name="plants_popup">新增</span>
			<table class="table table-striped">
				<thead>
				<tr>
					<th>母本</th>
					<th>父本</th>
					<th>種類</th>
					<th>售價</th>
					<th>圖片</th>
					<th>備註</th>
					<th>編輯</th>
				</tr>
				</thead>
				<tbody>
					<?php
						foreach ($result as $key => $value) {
							$imageArray = json_decode($value['pl_image']);
							$i = 0;
							$imageDom = '';
							foreach ($imageArray as $key2 => $value2) {
								$isHidden = ($i > 0)?'hide':'';
								$imageDom .= '
									<a href="../uploads/'. $value2 .'" class="lightview '. $isHidden .'" 
										data-lightview-group="thumbnail'. $key .'" data-lightview-group-options="skin: \'mac\',controls: \'thumbnails\'">
										<img src="../uploads/thumb/'. $value2 .'" alt="">
									</a>
								';
								$i++;
							}

							if($value['pl_name1_img'] == '')
							{
								$name1 = $value['pl_name1'];
							}else{
								$name1 = '<a href="../uploads/'. $value['pl_name1_img'] .'" class="lightview" 
										data-lightview-group-options="skin: \'mac\'">
										'. $value['pl_name1'] .'</a>';
							}

							if($value['pl_name2_img'] == '')
							{
								$name2 = $value['pl_name2'];
							}else{
								$name2 = '<a href="../uploads/'. $value['pl_name2_img'] .'" class="lightview" 
										data-lightview-group-options="skin: \'mac\'">
										'. $value['pl_name2'] .'</a>';
							}
							//種類
							$category = ($value['pl_category'] == 0)?'仙履蘭':'其它';

							echo '
								<tr>
									<td>'. $name1 .'</td>
									<td>'. $name2 .'</td>
									<td>'. $category .'</td>
									<td>'. $value['pl_size'] .'</td>
									<td>'. $value['pl_price'] .'</td>
									<td>
										'. $imageDom .'
									</td>
									<td>'. $value['pl_comment'] .'</td>
									<td>
										<span class="glyphicon glyphicon-edit cursor edit_dom" name="plants_popup"></span>
										<span class="glyphicon glyphicon-trash cursor remove_dom" name="'. $value["pl_id"] .'" data-delete="2" data-idKey="pl_id"></span>
									</td>
								</tr>
							';
						}
					?>
				</tbody>
			</table>
		</div>
		<div id="page_bar"></div>
		<div class="height50 clear"></div><!-- just for layout -->
    </div><!-- /.container -->
	
	<!-- Begin 新增圖片 -->
	<div class="panel panel-primary" id="plants_popup">
		<div class="panel-heading text-center">新增瓶苗列表<span class="glyphicon glyphicon-remove pull-right cursor" onClick="javascript:$.unblockUI();"></span></div>
		<div class="panel-body">
			<form class="dom_form" name="image" method="POST" enctype="multipart/form-data">
				<!-- <input type="hidden" value="1" name="type"/> -->
				<input type="hidden" name="id" value=""/>
				<input type="hidden" name="pl_type" value="1"/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">種類</label>
					</div>
					<div class="col-lg-4">
						<select class="form-control" name="pl_category">
							<option value="0">仙履蘭</option>
							<option value="1">其它</option>
						</select>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">母本</label>
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control " value="" name="pl_name1"/>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">母本圖片</label>
					</div>
					<div class="col-lg-4">
						<input type="file" name="pl_name1_img[]"/>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">父本</label>
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control " value="" name="pl_name2"/>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">父本圖片</label>
					</div>
					<div class="col-lg-4">
						<input type="file" name="pl_name2_img[]"/>
					</div>
				</div>
				<br/>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">售價</label>
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control required " value="" name="pl_price"/>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">上傳圖片</label>
					</div>
					<div class="col-lg-4">
						<input type="file" multiple="multiple" name="pl_image[]"/>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-2 col-lg-offset-1">
						<label class="control-label">備註</label>
					</div>
					<div class="col-lg-4">
						<textarea  class="form-control" name="pl_comment"></textarea>
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