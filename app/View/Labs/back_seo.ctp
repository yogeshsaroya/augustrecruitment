<style>
.nop{padding: 0px !important;}
</style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header"> <h1>Web settings</h1> </section>
        <!-- Main content -->
        <section class="content">
          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header'>
                <div class='box-body pad'>
                  <?php echo $this->Session->flash('msg');?>
                    <!-- form start -->
					<?php echo $this->Form->create('WebSetting',array('type' => 'file')); 
					echo $this->Form->hidden('id');
					?>
					<div class="form-group"><?php echo $this->Form->input('name',array('type'=>'text', 'class'=>'form-control')); ?></div>                             
					<div class="form-group"><?php echo $this->Form->input('description',array('type'=>'text', 'class'=>'form-control')); ?></div>
					<div class="form-group"><?php echo $this->Form->input('keyword',array('type'=>'text','placeholder'=>'Keyword (divide by comma)','class'=>'form-control')); ?>	</td></tr>
					<div class="form-group"><?php echo $this->Form->input('meta',array('class'=>'form-control')); ?></div>
					<div class="form-group"><?php echo $this->Form->input('script',array('class'=>'form-control')); ?></div>
					<div class="form-group"><?php echo $this->Form->input('tracker',array('class'=>'form-control')); ?> </div>
					<div class="form-group"><?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control')); ?></div>
					<div class="form-group"><?php echo $this->Form->input('mobile',array('type'=>'text','class'=>'form-control')); ?></div>
					<!--<div class="form-group"><?php echo $this->Form->input('facebook_link',array('class'=>'form-control')); ?> </div>
					<div class="form-group"><?php echo $this->Form->input('youtube_link',array('class'=>'form-control')); ?> </div>
					<div class="form-group"><?php echo $this->Form->input('instagram_link',array('class'=>'form-control')); ?> </div>
					<div class="form-group"><?php echo $this->Form->input('google_link',array('class'=>'form-control')); ?> </div>-->
					<div class="form-group"><?php echo $this->Form->input('address',array('type'=>'text','class'=>'form-control')); ?> </div>
					
					<div class="form-group "> <input type="submit" class="btn btn-block btn-success btn-flat" value="Update"></div>
					<?php echo $this->Form->end();?>
				</div>
			  </div>
			</div>
		  </div>
			</div>
</div>
	
	</section>
	<!-- /.content -->
</div>

<div class="clear"></div>
