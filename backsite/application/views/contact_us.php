	
	<div class="container">
		<?php $this->load->view('menu');?>
		<div class="col-lg-10">
			<table class="table table-striped">
				<thead>
				<tr>
					<th>名字</th>
					<th>EMAIL</th>
					<th>標題</th>
					<th>內文</th>
					<th>IP</th>
					<th>編輯</th>
				</tr>
				</thead>
				<tbody>
					<?php
						foreach ($result as $key => $value) {
							
							echo '
								<tr>
									<td>'. $value['cu_name'] .'</td>
									<td>'. $value['cu_mail'] .'</td>
									<td>'. $value['cu_title'] .'</td>
									<td>'. $value['cu_message'] .'</td>
									<td>'. $value['cu_ip'] .'</td>
									<td>
										<span class="glyphicon glyphicon-trash cursor remove_dom" name="'. $value["cu_id"] .'" data-delete="2" data-idKey="cu_id"></span>
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