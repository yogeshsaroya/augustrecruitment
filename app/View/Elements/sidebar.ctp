<div class="col_one_fourth nobottommargin">
	<?php
	$controller = $this->request->params['controller'];
	$function = $this->request->params['action'];
	?>
	<ul class="sidenav ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
		<li class="<?php if($controller =='accounts' && $function=='index'){ echo 'ui-tabs-active';}?>"<><a href="<?php echo SITEURL."accounts";?>" class="ui-tabs-anchor" ><i class="icon-settings"></i>My Account<i class="icon-chevron-right"></i></a></li>
		
<?php if(isset($e_data) && !empty($e_data)){?>
<li class="" ><a href="<?php echo SITEURL."pages/employee_enrollment/".$e_data['Employee']['id'];?>" class="ui-tabs-anchor" ><i class="icon-support"></i>My Application<i class="icon-chevron-right"></i></a></li>
<?php }else{?>		
<li class="<?php if($controller =='accounts' && $function=='my_form'){ echo 'ui-tabs-active  ';}?>" ><a href="<?php echo SITEURL."accounts/my_form/";?>" class="ui-tabs-anchor" ><i class="icon-support"></i>My Application<i class="icon-chevron-right"></i></a></li>
<?php }?>
		<li class="" ><a href="<?php echo SITEURL."users/log_out";?>" class="ui-tabs-anchor" ><i class="icon-support"></i>Log Out<i class="icon-chevron-right"></i></a></li>
	</ul>
</div>