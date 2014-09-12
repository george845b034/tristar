<!-- Begin page content -->
<div class="container">
	<!-- Begin main wrapper -->
	<div class="search_block">
		<?php if($is_display){?>
		<div class="left">
			<select class="span2 form-control" id="category_search_select">
				<option value="">請選擇</option>
				<?php
					foreach($category as $key => $value)
					{
						echo '<option value="'. $value .'">'. $value .'</option>';
					}
				?>
			</select>
			&nbsp;
			<button class="btn btn-info" id="selectButton">搜尋</button>
			<button class="btn btn-warning" id="resetButton">重設</button>
		</div>

		<div class="input-append right">
			<input type="text" id="search_kwd" name="keyword" class="search-query input-small"  autocomplete="off" 
			value="" onkeyup="">
			<button id="searchButton" class="btn">搜尋</button>
			<div class="auto_complete hide" onblur="$(this).addClass('hide');"></div>
		</div>
		<?php }?>
	</div>
	<!-- /.main-wrapper -->
</div><!-- /.page content -->