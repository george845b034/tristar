	
	<!-- Begin page content -->
	<div class="container">
		<!-- Begin main wrapper -->
		<div class="main_wrapper">
			<div class="">
				<legend>客戶資料
					<h5 style="display:inline-block;margin-left:20px;"><?php echo $lang->line('total_count');?>：<?php echo count($result);?></h5>
					<span class="right">
						<button class="btn btn-info right" id="form-insert-button" type="button">
							<i class="glyphicon glyphicon-plus"></i> <?php echo $lang->line('insert');?>
						</button>
					</span>
				</legend>
				<div class="example example-four">
					<div class="hider">
						<div class="slider-wrap" id="example-four-slider-wrap">
							<table class="table table-hover">
								<tbody>
									<tr>
										<th class="sort">業主</th>
										<th class="sort">類別</th>
										<th class="sort">職稱</th>
										<th>電話</th>
										<th>個案</th>
									</tr>
									<?php
										foreach($result as $key => $value)
										{
											echo '
												<tr class="">
													<td><a href="customer_detail?id='. $value["id"] .'">'. $value["name"] .'</a></td>
													<td class="changeType" id="valueNumber_1">'. $value["c_name"] .'</td>
													<td class="changeType" id="valueNumber_1">'. $value["title"] .'</td>
													<td class="changeType" id="valueNumber_1">'. $value["phone1"] .'</td>
													<td class="changeType" id="valueNumber_1">'. $value["ca_company"] .'</td>
												</tr>
											';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- /.main wrapper inner -->
			<div id="page_bar"></div>
			<div class="height50 clear"></div><!-- just for layout -->
		</div><!-- /.main-wrapper -->
	</div><!-- /.container -->
