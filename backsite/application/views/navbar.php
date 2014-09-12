	<div class="container">
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo base_url();?>" title="三星蘭園">三星蘭園</a>
				</div>
				<div class="navbar-collapse collapse">
					<?php if($this->session->userdata('is_login')){?>
					<ul class="nav navbar-nav pull-right">
						<li class="right"><a href="logout"><?php echo $this->session->userdata('username');?> <i class="glyphicon glyphicon-user icon-white"></i>&nbsp;&nbsp;登出</a></li>
					</ul>
					<?php }?>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>