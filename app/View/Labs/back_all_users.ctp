<!-- DATA TABLES -->
<link href="<?php echo SITEURL."lab_root/";?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<style>
@media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px) {
#lab_table td:nth-of-type(1):before{content:"ID"}
#lab_table td:nth-of-type(2):before{content:"Email"}
#lab_table td:nth-of-type(3):before{content:"First"}
#lab_table td:nth-of-type(4):before{content:"Last"}
#lab_table td:nth-of-type(5):before{content:"Role"}
#lab_table td:nth-of-type(6):before{content:"Status"}
#lab_table td:nth-of-type(7):before{content:"Created"}

}

</style>

<div class="content-wrapper" style="min-height: 916px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>All Users</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					
					<!-- /.box-header -->
					<div class="box">
						
						<div class="box-body">
						<?php echo $this->Session->flash('msg');?>
							<div id="example2_wrapper"
								class="dataTables_wrapper form-inline dt-bootstrap">
								<div class="row">
									<div class="col-sm-6"></div>
									<div class="col-sm-6"></div>
								</div>
								<div class="row">
									<div class="col-sm-12" id="lab_table">
										<table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
											<thead>
											
					<tr role="row">
                        <th><?php echo $this->Paginator->sort('User.id', 'ID', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('User.email', 'Email', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('User.first_name', 'First', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('User.last_name', 'Last', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('User.role', 'Role', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('User.status', 'Status', array('escape' => false)); ?></th>
						<th><?php echo $this->Paginator->sort('User.created', 'Created', array('escape' => false)); ?></th>
                        <th>Delete</th>
                    </tr>
</thead>
<tbody id="table_rows">

<?php
if (!empty($data)) {
    foreach ($data as $list) { 
    	?>
        <tr class="odd gradeX">
           <td class="center gnTxt"> <?php echo $list['User']['id']; ?></td>
           <td class="center gnTxt"> <?php echo $list['User']['email'];?> </td>
           <td class="center gnTxt"> <?php echo $list['User']['first_name']; ?> </td>
           <td class="center gnTxt"> <?php echo $list['User']['last_name']; ?> </td>
           <td class="center gnTxt"> <?php 
           if($list['User']['role'] == 1){ echo "Admin";}
    elseif($list['User']['role'] == 2){ echo "Employer";}
           elseif($list['User']['role'] == 3){ echo "Employee"; }
           ?> </td>
           
           <td class="center"><?php 
           if($list['User']['status'] == 1){ echo $this->html->link('Active','/back/labs/all_users?st='.$list['User']['id'],array('class' => 'green','confirm' => 'Do you want to deactive this User?')); }
           	else{ echo $this->html->link('Deactive','/back/labs/all_users?st='.$list['User']['id'],array('class' => 'text-red','confirm' => 'Do you want to active this User?')); }
           ?></td>
            
           <td class="center gnTxt"> <?php echo date('M d,y',strtotime($list['User']['created'])); ?> </td>
           <td class="center gnTxt"> <?php echo $this->html->link('Delete','/back/labs/all_users?del='.$list['User']['id'],array('class' => 'text-red','confirm' => 'Do you want to delete this user?')); ?> </td>
           
           </tr>
           
           
           
	<?php } } ?>
</tbody>
											
</table>
									</div>
								</div>
								<div class="row" id="paginate_info">
									<div class="col-sm-5">
										<div class="dataTables_info" id="example2_info" role="status"
											aria-live="polite"><?php echo $this->Paginator->counter(
    'Page {:page} of {:pages}, showing {:current} records out of
     {:count} total, starting on record {:start}, ending on {:end}'
);?></div>
									</div>
									<div class="col-sm-7">
										<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
										
<ul class="pagination"> 
	<?php 
	echo $this->Paginator->prev('Previous', array('tag'=>'li'), null, array('class' => 'paginate_button previous disabled')); 
	echo $this->Paginator->numbers(array('modulus' => 1,'first' => 2,'last' => 2,'separator' =>'','tag'=>'li','ellipsis'=>false,'class'=>'paginate_button')); 
	echo $this->Paginator->next('Next', array('tag'=>'li'), null, array('class' => 'paginate_button previous disabled')); ?> 
	</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
	
	</section>
	<!-- /.content -->
</div>
