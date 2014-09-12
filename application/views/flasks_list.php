
<div class="container">
	<div class="height20 clear"></div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="sort">編號</th>
				<th class="sort">品種名</th>
				<th class="sort">價格</th>
				<th class="sort">圖片</th>
				<th class="sort">備住</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$j = 1;
				foreach ($result as $key => $value) {
					$imageArray = json_decode($value['pl_image']);
					$i = 0;
					$imageDom = '';
					foreach ($imageArray as $key2 => $value2) {
						$isHidden = ($i > 0)?'hide':'';
						$imageDom .= '
							<a href="./uploads/'. $value2 .'" class="lightview '. $isHidden .'" 
								data-lightview-group="thumbnail'. $key .'" data-lightview-group-options="skin: \'mac\',controls: \'thumbnails\'">
								<img src="./uploads/thumb/'. $value2 .'" alt="">
							</a>
						';
						$i++;
					}

					if($value['pl_name1_img'] == '')
					{
						$name1 = $value['pl_name1'];
					}else{
						$name1 = '<a href="./uploads/'. $value['pl_name1_img'] .'" class="lightview" 
								data-lightview-group-options="skin: \'mac\'">
								'. $value['pl_name1'] .'</a>';
					}

					if($value['pl_name2_img'] == '')
					{
						$name2 = $value['pl_name2'];
					}else{
						$name2 = '<a href="./uploads/'. $value['pl_name2_img'] .'" class="lightview" 
								data-lightview-group-options="skin: \'mac\'">
								'. $value['pl_name2'] .'</a>';
					}
					echo '
						<tr class="">
							<td>'. $j .'</td>
							<td id="valueNumber_1">'. $name1 .' X '. $name2 .'</td>
							<td id="valueNumber_1">'. $value['pl_price'] .'</td>
							<td id="valueNumber_1">
								'. $imageDom .'
							</td>
							<td id="valueNumber_1">'. $value['pl_comment'] .'</td>
						</tr>
					';
					$j++;
				}
			?>
		</tbody>
	</table>
	<div id="page_bar"></div>
</div>
<div class="height50 clear"></div>