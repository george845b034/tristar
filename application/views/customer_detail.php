	<?php
		$id = '';
		$categoryIndex = 1;
		$name = '';
		$title = '';
		$nicename = '';
		$phone1 = '';
		$extension1 = '';
		$phone2 = '';
		$extension2 = '';
		$mobile1 = '';
		$mobile2 = '';
		$address1 = '';
		$address2 = '';
		$address3 = '';
		$email = '';
		$comment = '';
		if(count($result) > 0)
		{
			$id = $result[0]["id"];
			$categoryIndex = $result[0]["category"];
			$name = $result[0]["name"];
			$title = $result[0]["title"];
			$nicename = $result[0]["nicename"];
			$phone1 = $result[0]["phone1"];
			$extension1 = $result[0]["extension1"];
			$phone2 = $result[0]["phone2"];
			$extension2 = $result[0]["extension2"];
			$mobile1 = $result[0]["mobile1"];
			$mobile2 = $result[0]["mobile2"];
			$address1 = $result[0]["address1"];
			$address2 = $result[0]["address2"];
			$address3 = $result[0]["address3"];
			$email = $result[0]["email"];
			$comment = $result[0]["comment"];
		}
	?>
	<!-- Begin page content -->
	<div class="container">
		<!-- Begin main wrapper -->
		<div class="main_wrapper">
			<div class="">
				<legend>客戶資料</legend>
				<div class="example example-four">
					<div class="hider">
						<div class="slider-wrap" id="example-four-slider-wrap">
							<!--update && insert-->
							<div class="summary">
								<form method="post" id="getFormData">
									<div class="main_wrapper_inner">
										<div class="col-md-3">
											<legend>基本資料</legend>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">類別</label>
												</span>
												<select class="form-control" name="category">
													<?php
														foreach($category as $key => $value)
														{
															$selected = '';
															if($key == $categoryIndex)$selected = 'selected="selected"';
															echo '<option value="'. $key .'" '. $selected .'>'. $value .'</option>';
														}
													?>
												</select>
											</div>
											<br/>
											<input type="hidden" name="id" value="<?php echo $id;?>">
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">業主</label>
												</span>
												<input type="text" name="name" value="<?php echo $name;?>" class="form-control" placeholder="輸入業主名稱">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">職稱</label>
												</span>
												<input type="text" name="title" value="<?php echo $title;?>" class="form-control" placeholder="輸入業主職稱">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">稱呼</label>
												</span>
												<input type="text" name="nicename" value="<?php echo $nicename;?>" class="form-control" placeholder="輸入業主稱呼">
											</div>
											<br/>
											
											
											<legend>備註</legend>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">備註</label>
												</span>
												<textarea class="form-control" name="comment" rows="3" value=""><?php echo $comment;?></textarea>
											</div>
										</div>
										<div class="col-md-4">
											<legend>聯絡方式</legend>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">電話1</label>
												</span>
												<input type="text" name="phone1" value="<?php echo $phone1;?>" class="form-control" placeholder="輸入電話1" style="width:60%;margin-right:4px;">
												<input type="text" name="extension1" value="<?php echo $extension1;?>" class="form-control" placeholder="輸入分機1" style="width:30%;margin-right:4px;">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">電話2</label>
												</span>
												<input type="text" name="phone2" value="<?php echo $phone2;?>" class="form-control" placeholder="輸入電話2" style="width:60%;margin-right:4px;">
												<input type="text" name="extension2" value="<?php echo $extension2;?>" class="form-control" placeholder="輸入分機2" style="width:30%;margin-right:4px;">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">手機1</label>
												</span>
												<input type="text" name="mobile1" value="<?php echo $mobile1;?>" class="form-control" placeholder="輸入手機1">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">手機2</label>
												</span>
												<input type="text" name="mobile2" value="<?php echo $mobile2;?>" class="form-control" placeholder="輸入手機2">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">地址1</label>
												</span>
												<input type="text" name="address1" value="<?php echo $address1;?>" class="form-control" placeholder="輸入地址1">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">地址2</label>
												</span>
												<input type="text" name="address2" value="<?php echo $address2;?>" class="form-control" placeholder="輸入地址2">
											</div>
											<br/>
											<div class="input-group">
												<span class="input-group-btn">
													<label class="col-lg-2 control-label">地址3</label>
												</span>
												<input type="text" name="address3" value="<?php echo $address3;?>" class="form-control" placeholder="輸入地址3">
											</div>
											<br/>
											
										</div>
										<div class="col-md-5">
											
											<legend>個案列表</legend>
											<table class="table table-hover">
												<thead>
													<tr>
														<th>年度</th>
														<th>部門</th>
														<th>設計師</th>
														<th>公司</th>
														<th><span class="glyphicon glyphicon-plus-sign cursor insert_dom"></span></th>
													</tr>
												</thead>
												<tbody>
													
													<?php
														$i = 0;
														$dom = '';
														foreach($projectList as $key => $value)
														{
															if($i > 0)$dom = '<span class="glyphicon glyphicon-remove-sign cursor remove_dom"></span>';
															echo '
																<tr>
																	<td><input type="text" name="annual[]" value="'.$value["ca_annual"].'" class="form-control" placeholder="輸入年度" style=""></td>
																	<td><input type="text" name="department[]" value="'.$value["ca_department"].'" class="form-control" placeholder="輸入部門" style=""></td>
																	<td><input type="text" name="designer[]" value="'.$value["ca_designer"].'" class="form-control" placeholder="輸入設計師" style=""></td>
																	<td><input type="text" name="company[]" value="'.$value["ca_company"].'" class="form-control" placeholder="輸入公司" style=""></td>
																	<td>'. $dom .'</td>
																</tr>
															';
															$i++;
														}
													?>
													<!--<tr>
														<td><input type="text" name="annual[]" value="" class="form-control" placeholder="輸入年度" style=""></td>
														<td><input type="text" name="department[]" value="" class="form-control" placeholder="輸入部門" style=""></td>
														<td><input type="text" name="designer[]" value="" class="form-control" placeholder="輸入設計師" style=""></td>
														<td><input type="text" name="company[]" value="" class="form-control" placeholder="輸入公司" style=""></td>
														<td></td>
													</tr>-->
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-6 col-md-offset-9">
										<button class="btn btn-success" id="save" type="button"><span class="glyphicon glyphicon-ok icon-white"></span> save</button>
										<button class="btn btn-danger" id="delete" type="button"><span class="glyphicon glyphicon-remove icon-white"></span> delete</button>
										<button class="btn btn-info" id="insert" type="button"><span class="glyphicon glyphicon-plus icon-white"></span> insert</button>
									</div>
									<div class="height50 clear"></div><!-- just for layout -->
								</form>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.main wrapper inner -->
			<div id="page_bar"></div>
			<div class="height50 clear"></div><!-- just for layout -->
		</div><!-- /.main-wrapper -->
	</div><!-- /.container -->
