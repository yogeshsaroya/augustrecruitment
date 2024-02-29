<!-- DATA TABLES -->
<link href="<?php echo SITEURL."lab_root/";?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<style>


@media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px) {

#lab_table td:nth-of-type(1):before{content:"Type"}
#lab_table td:nth-of-type(2):before{content:"Sender"}
#lab_table td:nth-of-type(3):before{content:"Email"}
#lab_table td:nth-of-type(4):before{content:"Subject"}
#lab_table td:nth-of-type(5):before{content:"Created"}
#lab_table td:nth-of-type(6):before{content:"Status"}
#lab_table td:nth-of-type(7):before{content:"Action"}
}
</style>

<div class="content-wrapper" style="min-height: 916px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>View category list
		<span class="add_link right"><a href="<?php echo SITEURL."back/labs/add_category";?>">Add New Category</a></span></h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<div class="box-body">
							<?php  echo $this->element('labs/page_filter');?>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box">
						
						<div class="box-body">
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
                        <th><?php echo $this->Paginator->sort('Category.name', 'Category', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('Category.slug', 'Slug', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('Category.status', 'Status', array('escape' => false)); ?></th>
                        <th><?php echo $this->Paginator->sort('Category.created', 'Created', array('escape' => false)); ?></th>
                        <th>Action</th>
                    </tr>
</thead>
<tbody id="table_rows">

 <?php
                    if (!empty($data)) {
                        foreach ($data as $list) { ?>
                            <tr class="odd gradeX">
                                <td class="center gnTxt"> <?php echo $list['Category']['name']; ?></td>
                                <td class="center gnTxt"> <?php echo $list['Category']['slug']; ?> </td>
				<td class="center"> <?php if($list['Category']['status'] == 1){ echo $this->Html->link('Active','/back/labs/all_category/'.$list['Category']['id'].'/1',array('class' => 'green')); }
                                else{  echo $this->Html->link('Deactive','/back/labs/all_category/'.$list['Category']['id'].'/0',array('class' => 'red')); } ?> </td>
                                <td class="center"> <?php echo date('M d,Y',strtotime($list['Category']['created'])); ?> </td>
                                <td class="center">
				  <?php echo $this->Html->link('Edit', array('controller' => 'labs', 'action' => 'add_category', $list['Category']['id'])); ?>
				  <?php echo $this->Html->link('Delete', array('controller' => 'labs', 'action' => 'delete_category', $list['Category']['id']),array( 'confirm' => 'Are you sure you want to delete this Category, This will delete all related child categories also ?')); ?>	  
				</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
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
<script>
$(document).ready(function () {
	  var $rows = $('#table_rows tr');
	  $('#tab_search').keyup(function() {
	      var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	      
	      $rows.show().filter(function() {
	          var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	          return !~text.indexOf(val);
	      }).hide();
	  });
	});
</script>