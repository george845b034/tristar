	
	<div class="container">
		<div class="container center">
			<!--<img data-src="holder.js/1200x200" src="data:image/png;base64," class="img-thumbnail" alt="">-->
			<img src="images/banner.jpg" class="img-thumbnail" alt="">
		</div>
		<section class="main">
			<div id="ri-grid" class="ri-grid ri-shadow">
				<img class="ri-loading-image" src="images/loading.gif"/>
				<ul>
					<?php 
						$i = 1;
						foreach ($result as $key => $value) {
							foreach (json_decode($value["mp_image"]) as $key2 => $value2) {
								echo '<li><a href="#" class="lightview" onclick="lightBox('. $i .');"><img src="uploads/'. $value2 .'"/></a></li>';
								$i++;
							}
						}
					?>
					<!-- <li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/1.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(2);"><img src="images/medium/2.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(3);"><img src="images/medium/3.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(4);"><img src="images/medium/4.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(5);"><img src="images/medium/5.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(6);"><img src="images/medium/6.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(7);"><img src="images/medium/7.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(8);"><img src="images/medium/8.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(9);"><img src="images/medium/9.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(10);"><img src="images/medium/10.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(11);"><img src="images/medium/11.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(12);"><img src="images/medium/12.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(13);"><img src="images/medium/13.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(14);"><img src="images/medium/14.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(15);"><img src="images/medium/15.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(16);"><img src="images/medium/16.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(17);"><img src="images/medium/17.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(18);"><img src="images/medium/18.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(19);"><img src="images/medium/19.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(20);"><img src="images/medium/20.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(21);"><img src="images/medium/21.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(22);"><img src="images/medium/22.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(23);"><img src="images/medium/23.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(24);"><img src="images/medium/24.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(25);"><img src="images/medium/25.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(26);"><img src="images/medium/26.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(27);"><img src="images/medium/27.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(28);"><img src="images/medium/28.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(29);"><img src="images/medium/29.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(30);"><img src="images/medium/30.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/31.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/32.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/33.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/34.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/35.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/36.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/37.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/38.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/39.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/40.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/41.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/42.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/43.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/44.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/45.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/46.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/47.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/48.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/49.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/50.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/51.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/52.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/53.jpg"/></a></li>
					<li><a href="#" class="lightview" onclick="lightBox(1);"><img src="images/medium/54.jpg"/></a></li> -->
				</ul>
			</div>
		</section>
    </div><!-- /.container -->
	<script type="text/javascript">	
		$(function() {
		
			$( '#ri-grid' ).gridrotator( {
				w1024 : {
					rows    : 3,
					columns : 8
				},
				w768 : {
					rows    : 3,
					columns : 7
				},
				 
				w480 : {
					rows    : 3,
					columns : 5
				},
				w320 : {
					rows 	: 3,
					columns : 4
				},
				w240 : {
					rows 	: 3,
					columns : 3
				},
				rows    : 3,
				columns : 10
			} );
		
		});
	</script>