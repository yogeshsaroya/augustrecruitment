<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Edit Category
	  <span class="add_link right"><a href="<?php echo SITEURL."back/labs/all_category";?>">View all Category</a></span></h1>
        </section>


        <!-- Main content -->
        <section class="content">
	  <div class='row'>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header'>
                <div class='box-body pad'>
                  <?php echo $this->Session->flash('msg');?>
		  
				<?php echo $this->Form->create('Category'); ?>
                  
                    <div class="form-group">
                    <?php echo $this->Form->input('name',array('class'=>'form-control')); ?>
                    </div>
                    <div class="form-group">
                      <?php echo $this->Form->input('status', array('options'=>array(1=>'Active', 0=>'Inactive'), 'error' => false, 'div' => false, 'class' => 'form-control'));?>
                    </div>
      
                  <div class="box-footer">
                  <div class="form-group ">
                      <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                  
              </div>
              <?php echo $this->Form->end();?>      
                  
                </div>
              </div><!-- /.box -->

              
            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
