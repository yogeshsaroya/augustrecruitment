<?php $user_data = $this->Session->read('userData');
$imgPath = 'no-profile-image.jpg';
	if(isset($user_data['UserImage']) && !empty($user_data['UserImage'])){
		//$imgPath = $this->Lab->getUserPrimeryImage($user_data['UserImage']);
	}
?>
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel --> 
          <div class="user-panel">
            <div class="pull-left image">
            <?php $url = show_image('img/','logo1.png',200,200,100,'ff','user',null);?>
            <?php /*?>
              <img src="<?php echo $url;?>" class="img-circle" alt="User Image" />
              <?php */?>
            </div>
            <div class="pull-left info">
            
              <p><?php //echo $user_data['User']['first_name']." ".$user_data['User']['last_name'];?></p>
            </div>
          </div>
          <!-- search form -->
          <?php /*?>
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <?php */?>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo SITEURL."back/labs";?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
              
            </li>
<?php
if(isset($_SESSION['Auth']['User']['role']) && $_SESSION['Auth']['User']['role'] == 1 ){?>

<li class="treeview" id="menu_user">
<a href="#"> <i class="fa fa-calculator"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i> </a>
<ul class="treeview-menu">
<li><a href="<?php echo SITEURL."back/labs/all_users";?>"><i class="fa fa-circle-o"></i>Users</a></li>
</ul>
</li>
<li class="treeview" id="menu_fourm">
              <a href="#">
                <i class="fa fa-fw fa-user-plus"></i> <span>Form</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="<?php echo SITEURL."back/labs/all_employee";?>"><i class="fa fa-circle-o"></i>Employee</a></li>
				<li><a href="<?php echo SITEURL."back/labs/all_employer";?>"><i class="fa fa-circle-o"></i>Employer</a></li>
              </ul>
</li>
<li class="treeview" id="menu_make">
<a href="#"> <i class="fa fa-calculator"></i> <span>Category</span> <i class="fa fa-angle-left pull-right"></i> </a>
<ul class="treeview-menu">
<!--<li><a href="<?php echo SITEURL."back/labs/all_category";?>"><i class="fa fa-circle-o"></i>Category</a></li>
<li><a href="<?php echo SITEURL."back/labs/add_category";?>"><i class="fa fa-circle-o"></i>Add Category</a></li>-->
<li><a href="<?php echo SITEURL."back/labs/all_category_order";?>"><i class="fa fa-circle-o"></i>Manage Order</a></li>
</ul>
</li>

<li class="treeview" id="menu_templates">
	<a href="#">
	  <i class="fa fa-table"></i> <span>Email Templates</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="<?php echo SITEURL."back/labs/add_email_template";?>"><i class="fa fa-circle-o"></i>Add New Email Template</a></li>
	  <li><a href="<?php echo SITEURL."back/labs/email_templates";?>"><i class="fa fa-circle-o"></i> All Email Template</a></li>
	  
	  
	</ul>
</li>
            

<li class="treeview" id="menu_settings">
  <a href="#"><i class="fa fa-cog"></i> <span>Settings</span><i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
	
	<li><a href="<?php echo SITEURL."back/labs/seo";?>" > <i class="fa fa-circle-o"></i>Web Setting</a></li>
	
	<li><a href="<?php echo SITEURL."back/labs/change_pwd";?>"><i class="fa fa-circle-o"></i>Change password</a></li>
   </ul>
</li>
	    
       
<?php }?>            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
<script>
    $(document).ready(function() {

    	
    	
        
        <?php if(isset($MenuHead) && !empty($MenuHead)){ echo "$('#".$MenuHead."').addClass('active');";}?>
        $('a[href="' + document.URL + '"]').parent().addClass('active');
        $('a[href="' + document.URL + '"]').parent().parent().parent().addClass('active');
    });
</script>