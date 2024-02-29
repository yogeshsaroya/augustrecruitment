<!-- DATA TABLES -->
<?php $pURL =  SITEURL."back/labs/sort_category";?>
<script type="text/javascript" src="<?php echo SITEURL."lab_root/";?>js/jquery-ui.js" ></script>
<link href="<?php echo SITEURL."lab_root/";?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SITEURL."lab_root/";?>css/jquery-ui.css" rel="stylesheet" type="text/css" />
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
		<h1>Add Category</h1>
			<?php echo $this->Form->create('Category'); ?>
  
                  <?php echo $this->Form->hidden('parent_Id', array('value'=>$parent_Id));?>
                    <div class="form-group" style="width:50%">
                    <?php echo $this->Form->input('name',array('class'=>'form-control')); ?>
                    </div>
                    
                  <div class="form-group ">
                      <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                  
              <?php echo $this->Form->end();?>      
		
		<h1>Manage Order
		<?php if(isset($parent))
		{
			echo '('.$parent.')';
		}
		?>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					
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
                        <th>Action</th>
                    </tr>
</thead>
<tbody id="table_rows">

 <?php
                    if (!empty($data)) {
                        foreach ($data as $key=>$list) { ?>
                            <tr class="odd gradeX" id="test_<?php echo $key;?>" data_id="<?php echo $list['Category']['id']; ?>">
                                <td class="center gnTxt"> <?php echo $list['Category']['name']; ?></td>
                                <td class="center">
									<?php echo $this->Html->link('View', array('controller' => 'labs', $list['Category']['id'])); ?> / 
									<?php echo $this->Html->link('Edit', array('controller' => 'labs', 'action' => 'add_category', $list['Category']['id'])); ?> / 
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
	$(function() {
	$("#table_rows").sortable({
        cursor: 'move',
        opacity: 0.6,
        update: function() {
        var order = [];   
        var itemOrder = $("#table_rows").sortable("toArray");
		//alert(itemOrder)
		for (var i = 0; i < itemOrder.length; i++) {
			var id = $("#table_rows tr").eq( i ).attr('data_id');
			order.push(id);
        }
		$(function() {
			$.ajax({type: 'POST',
              url: "<?php echo $pURL;?>",
              data: {'list' :order},
			  async:false,
			  dataType : 'json',
              success: function(data) {
                  $("#res").html(data);
              },
              error: function(comment) {
              }});
         
			});     
        
        
    }
	
	});
	
	});
</script>