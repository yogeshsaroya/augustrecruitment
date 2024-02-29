<div class="content-wrapper" style="min-height: 1066px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?php echo $MenuHead;?></h1>

        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            
            <div class="box-body">
              
<div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>
              <h3 class="box-title"><?php echo $MenuHead;?> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <dl class="dl-horizontal">
                
                <?php if( !empty($data['Employer']['first_name']) ){?><dt>Name : </dt> <dd><?php echo $data['Employer']['designation'].' '.$data['Employer']['first_name'].' '.$data['Employer']['last_name'];?></dd><?php }?>
                <?php if( !empty($data['Employer']['company_name']) ){?><dt>Company Name : </dt> <dd><?php echo $data['Employer']['company_name'];?></dd><?php }?>
				<dt>Company Phone : </dt> <dd><?php echo $data['Employer']['company_phone'];?></dd>
                <dt>Location : </dt> <dd><?php echo $data['Employer']['city'];?></dd>
                <dt>email : </dt> <dd><?php echo $data['Employer']['email'];?></dd>
                <dt>Webiste : </dt> <dd><?php echo $data['Employer']['website'];?></dd>
                <dt>Job Title : </dt> <dd><?php echo $data['Employer']['job_title'];?></dd>
                <dt>How large is your corporation : </dt> <dd><?php echo $data['Employer']['large_corporation'];?></dd>
                <dt>How many employees do you recruit a year : </dt> <dd><?php echo $data['Employer']['how_many_employees'];?></dd>
				<dt>How many employees you are looking to make today? : </dt> <dd><?php echo $data['Employer']['hire_employees'];?></dd><br>
                <?php if(isset($data['JobTitle']) && !empty($data['JobTitle'])){
                	foreach ($data['JobTitle'] as $list){
                		echo "<dt>Industry : </dt> <dd>".$list['industry']."</dd>";
                		echo "<dt>Department : </dt> <dd>".$list['department']."</dd>";
                		echo "<dt>Job title : </dt> <dd>".$list['job_title']."</dd>";
                		echo "<dt>Other Job title : </dt> <dd>".$list['other_job_title']."</dd><br>";
                	}
                }?>
                
                <dt>Created : </dt> <dd><?php echo date('M d,y',strtotime($data['Employer']['created']));?></dd>
                </dl>
                
			                
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>
				<h3 class="box-title">User detail </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Name : </dt> <dd><?php echo $data['User']['first_name']." ".$data['User']['last_name'];?></dd>
                <dt>Email : </dt> <dd><?php echo $data['User']['email'];?></dd>
                <dt>Phone : </dt> <dd><?php echo $data['User']['phone'];?></dd>
                <dt>Created : </dt> <dd><?php echo date('M d,y',strtotime($data['User']['created']));?></dd>
			</dl>
            </div>
            <!-- /.box-body -->
          </div>
		</div>
</div>
			</div>
		  </div>
		</section>
</div>