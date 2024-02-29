<?php if(isset($WebSetting['WebSetting']['alert']) && !empty($WebSetting['WebSetting']['alert'])){
	$al = $this->Session->read('TopBar');
	if(empty($al)){ ?>
<div class="top-line">
        <nav class="top-navigation">
        <div class="top_text ce_Text"><?php echo $WebSetting['WebSetting']['alert'];?> </div>
        <div class="top_text re_Text"><i class="fa fa-times-circle" aria-hidden="true" id="cls"></i></div> 
        </nav> </div>
<?php }
else
{
	?>
<style>
<?php if(isset($IsMobile)){?> 
	.main{ margin-top:0px !important; }
	
<?php }else{?>
	.main{margin-top:278px; } 
	<?php }?>
	</style>
	<?php
}
}?>

<?php if(isset($IsMobile)){?>
<style>
.main{ margin-top:0px !important; position: absolute; }
.new_m {position: inherit !important;}
#contact_support_button{display: none}
</style> 
	
<?php }?>
<header class="header ">
    <div class="container"> 
        <!-- LOGO -->
        <div class="header-brand"><a href="<?php echo SITEURL;?>"> 
        <?php if(isset($WebSetting['WebSetting']['logo'])){?>
        <img src="<?php echo SITEURL."img/webimages/logo/".$WebSetting['WebSetting']['logo'];?>" class="responsive-img" alt="">
        <?php }else{?>
        <img src="<?php echo SITEURL."img/webimages/logo/default_logo.png";?>" width="206" height="40" class="responsive-img" alt="">
        <?php }?>
        </a></div>
        <!-- /end LOGO --> 
        <div class="top-menu">
        <nav class="top-navigation">
            
				<div class="left search-nav"> 
					<div class="">
						<?php echo $this->Form->create('Search', array('url' => '/search','type' => 'get')); ?>
							<div class="input-field">
								<button type="submit" class=""><i class="mdi-action-search search-toggle"></i></button>
								<?php echo $this->Form->input('q', array('id'=>'search','label' => false, 'error' => false, 'div' => false, 'placeholder'=>'Search', 'class' => 'form-control','required'=>true));?>
							</div>
						<?php echo $this->Form->end();?>	
					</div>
				</div>
			<ul class="collapsenav right" data-collapsible="expandable">
                <li> <span class="navbar-toggle hide-on-large-only left collapsible-header"><i class="mdi-navigation-menu"></i> </span>
                    <ul class="top-nav collapsible-body">
						<li><a href="<?php echo SITEURL;?>blog">News</a></li>
						<?php if(isset($_SESSION['Auth']['User']['id']) && !empty($_SESSION['Auth']['User']['id'])){?>
						<li><a href="<?php echo SITEURL;?>wish_list">Wish List &nbsp;<i class="mdi-action-shopping-basket"></i></a></li>
						<li><a href="<?php echo SITEURL;?>accounts">My account</a></li>
						<li><a href="<?php echo SITEURL;?>users/log_out">Logout</a></li>
						<?php }else{?>
						<li><a href="<?php echo SITEURL;?>login">Login </a></li>
						<li><a href="<?php echo SITEURL;?>register">Register</a></li>
						<?php } ?>
                        
                    </ul>
                </li>
            </ul>
        </nav>
</div>
        <!-- MAIN MENU -->
        <nav class="rev-navigation center-align" data-menu-responsive="1200">
            <div class="open-menu" style="display: none;"> <i class="mdi-navigation-menu"></i> </div>
            <ul class="navlist">
				<li class="menu-item-has-children  item-plus"><a href="<?php echo SITEURL;?>">Home</a>
				<?php $menus = $this->Lab->getMenus(0,3);
				//print_r($menus);
				foreach($menus as $val){
					
					if(isset($val['SubCategory']) && !empty($val['SubCategory']))
					{
						echo '<li class="menu-item-has-children  item-plus"> <a href="'.SITEURL.'category/'.$val['Category']['slug'].'">'.$val['Category']['name'].'</a>';
						echo '<ul class="sub-menu">';
						foreach($val['SubCategory'] as $sval){
							echo '<li> <a href="'.SITEURL.'category/'.$val['Category']['slug'].'/'.$sval["slug"].'">'.$sval['name'].'</a></li>';
						}
						echo '</ul>';
					}
					else{
						echo '<li class=""> <a href="'.SITEURL.'category/'.$val['Category']['slug'].'">'.$val['Category']['name'].'</a>';
					}
					echo '</il>';
				}
				$extraMenus = $this->Lab->getMenus(4,50);
				if(isset($extraMenus) && !empty($extraMenus))
				{
					echo '<li class="menu-item-has-children  item-plus"> <a href="javascript:void(0)">More Categories</a>';
						echo '<ul class="sub-menu">';
							foreach($extraMenus as $eval){
								echo '<li> <a href="'.SITEURL.'category/'.$eval['Category']['slug'].'">'.$eval['Category']['name'].'</a></li>';
							}
						echo '</ul>';
					echo '</li>';
				}
				?>
                
            </ul>

            <div class="right soc-networks">
                <ul class="list-inline">
                <?php if(isset($WebSetting['WebSetting']['facebook_link'])){?><li><a href="<?php echo $WebSetting['WebSetting']['facebook_link'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php }?>
                <?php if(isset($WebSetting['WebSetting']['youtube_link'])){?><li><a href="<?php echo $WebSetting['WebSetting']['youtube_link'];?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php }?>
                <?php if(isset($WebSetting['WebSetting']['instagram_link'])){?><li><a href="<?php echo $WebSetting['WebSetting']['instagram_link'];?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php }?>
                <?php if(isset($WebSetting['WebSetting']['google_link'])){?><li><a href="<?php echo $WebSetting['WebSetting']['google_link'];?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php }?>
                </ul>
            </div>
        </nav>
        <!-- /end MAIN MENU --> 
        
    </div>
</header>
