<?php $user_data = $this->Session->read('userData');
	$imgPath = 'no-profile-image.jpg';
	if(isset($user_data['UserImage']) && !empty($user_data['UserImage'])){
		//$imgPath = $this->Lab->getUserPrimeryImage($user_data['UserImage']); 
	}
?>
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo SITEURL;?>" target="_blank" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>W</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>G-Force</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu" style="display: none">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                
                <?php $url123 = show_image('img/','logo1.png',160,160,100,'ff','user',null);?>
                  <img src="<?php echo $url123;?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $_SESSION['Auth']['User']['first_name']." ".$_SESSION['Auth']['User']['last_name'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $url123;?>" class="img-circle" alt="User Image" />
                    <p><?php echo $_SESSION['Auth']['User']['first_name']." ".$_SESSION['Auth']['User']['last_name'];?> - Administrator
                      <small>Member since <?php echo date('M, Y',strtotime($_SESSION['Auth']['User']['created']));?></small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left" style="display: none">
                      <a href="<?php echo SITEURL."lab/labs/user_profile/".$_SESSION['Auth']['User']['id'];?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                    <?php echo $this->Html->link('Sign out','/users/log_out',array('class'=>'btn btn-default btn-flat'));?>
                      
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                
              </li>
            </ul>
          </div>
        </nav>
      </header>
      