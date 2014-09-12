	
	<!-- Begin page content -->
	<div class="container">
		<!-- Begin main wrapper -->
		<div class="main_wrapper">
			<div class="">
				<legend><?php echo $lang->line('category_title');?>
					<h5 style="display:inline-block;margin-left:20px;"><?php echo $lang->line('total_count');?>：<?php echo count($result);?></h5>
					<span class="right">
						<button class="btn btn-info right" id="addButton" type="button">
							<i class="glyphicon glyphicon-plus"></i> <?php echo $lang->line('insert');?>
						</button>
					</span>
					<!--<span class="right">
						<a href="javascript:void(0);" title="<?php echo $lang->line('grid_model');?>"><span class="glyphicon glyphicon-th-large "></span></a>
						<a href="javascript:void(0);" title="<?php echo $lang->line('list_model');?>"><span class="glyphicon glyphicon-th-list "></span></a>
						&nbsp;
					</span>-->
				</legend>
				
				<table class="table table-hover list_table">
					<tbody>
						<tr>
							<th class="sort"><?php echo $lang->line('serial_number');?></th>
							<th class="sort"><?php echo $lang->line('category_name');?></th>
							<th><?php echo $lang->line('edit');?></th>
						</tr>
						<tr class="addRow success" style="display:none;">
							<td></td>
							<td class="addType" ><input id="addInput" type="text" value="" placeholder="Add contract name"/></td>
							<td>
								<span>
									<a class="add" id="addIcon" href="javascript:void(0);" title="<?php echo $lang->line('insert');?>"><i class="glyphicon glyphicon-floppy-save"></i></a>
								</span><span></span>
							</td>
						</tr>
						<?php
							foreach($result as $key => $value)
							{
								echo '
									<tr class="">
										<td>'. $value["c_id"] .'</td>
										<td class="changeType" id="valueNumber_'. $value["c_id"] .'">'. $value["c_name"] .'</td>
										<td>
											<span>
												<a class="save" id="saveIcon_'. $value["c_id"] .'" style="display:none;" href="javascript:void(0);" title="'. $lang->line('insert') .'"><i class="glyphicon glyphicon-floppy-save"></i></a>
												<a class="delete" id="delIcon_'. $value["c_id"] .'" href="javascript:void(0);" title="'. $lang->line('delete') .'"><i class="glyphicon glyphicon-trash"></i></a>
											</span><span></span>
										</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div><!-- /.main wrapper inner -->
			<div id="page_bar"></div>
			<div class="height50 clear"></div><!-- just for layout -->
		</div><!-- /.main-wrapper -->
	</div><!-- /.container -->
