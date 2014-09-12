
<script type="text/javascript" src="js/photo.js"></script>
<div class="container">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3 input-group">
				<span class="input-group-btn">
					<label class="col-lg-2 control-label">選擇品項:　　</label>
				</span>
				<select name="category" class="form-control">
					<?php
						foreach ($category as $key => $value) {
							$selected = ($key == $this->input->get('mp_type'))?'selected="selected"':'';
							echo '<option value="'. $key .'" '. $selected .'>'. $value .'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<br/>
		<?php
			$j = 0;
			foreach ($result as $key => $value)
			{
				if($j % 4 == 0)
				{
					echo '<div class="row">';
				}
				echo '
					<div class="col-md-3">
						<div class="shade2 board-preview">
							<div class="img-wrap">
								<a href="uploads/'. json_decode($value['mp_image'])[0] .'" class="lightview" data-lightview-group="thumbnail" data-lightview-group-options="controls: \'thumbnails\'">
									<img src="uploads/'. json_decode($value['mp_image'])[0] .'" alt="">
								</a>
							</div>
							<div class="info">
								<div class="title h6 center">
									<a href="/stylight_editor/"><strong>'. $value['mp_name'] .'</strong></a>
								</div> 
							</div>
						</div>
					</div>
				';
				if($j % 4 == 3)
				{
					echo '</div>';
				}
				$j++;
			}
		?>
		<!-- <div class="row">
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/5.jpg" class="lightview" data-lightview-group="thumbnail" data-lightview-group-options="controls: 'thumbnails'">
							<img src="images/medium/5.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/5.jpg" class="lightview" data-lightview-group="thumbnail" >
							<img src="images/medium/5.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/3.jpg" class="lightview" data-lightview-group="thumbnail" >
							<img src="images/medium/3.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/1.jpg" class="lightview" data-lightview-group="thumbnail" >
							<img src="images/medium/1.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/2.jpg" class="lightview" data-lightview-group="thumbnail" >
							<img src="images/medium/2.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/6.jpg" class="lightview" data-lightview-group="thumbnail" >
							<img src="images/medium/6.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/5.jpg" class="lightview" data-lightview-group="thumbnail" >
							<img src="images/medium/5.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="shade2 board-preview">
					<div class="img-wrap">
						<a href="images/medium/9.jpg" class="lightview" data-lightview-group="thumbnail" >
							<img src="images/medium/9.jpg" alt="">
						</a>
					</div>
					<div class="info">
						<div class="title h6 center">
							<a href="/stylight_editor/">von <strong>stylight_editor</strong></a>
						</div> 
					</div>
				</div>
			</div>
		</div> -->
	</div>
	<div id="page_bar"></div>
</div>
<div class="height50 clear"></div>