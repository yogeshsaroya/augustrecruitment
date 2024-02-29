<header id="header" class="full-header <?php if($this->request->params['controller'] =='pages' && $this->request->params['action'] =='index'){ echo "transparent-header dark";}?>" data-sticky-class="not-dark">
			<div id="header-wrap">
				<div class="container clearfix">
					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
					<div id="logo">
						<a href="<?php echo SITEURL;?>" class="standard-logo"><img src="<?php echo SITEURL;?>img/logo-1.png" alt="Logo"></a>
						<a href="<?php echo SITEURL;?>" class="retina-logo" ><img src="<?php echo SITEURL;?>img/logo-1.png" alt="Logo"></a>
					</div><!-- #logo end -->
					<nav id="primary-menu">
						<ul>
							<li class="current"><a href="<?php echo SITEURL;?>"><div>Home</div></a>
							<?php if(isset($_SESSION['Auth']['User']['id']) && !empty($_SESSION['Auth']['User']['id'])){?>
							 <li><a href="<?php echo SITEURL."accounts";?>"><div>Hi <?php echo $_SESSION['Auth']['User']['first_name'];?></div></a></li> 
							<?php }else{?> <li><a href="<?php echo SITEURL."users/login";?>"><div>Login</div></a></li> <?php }?>
							
						</ul>
					</nav><!-- #primary-menu end -->
				</div>
			</div>
		</header><!-- #header end -->
