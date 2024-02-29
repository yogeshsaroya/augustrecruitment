<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Web settings<span class="add_link right"><a href="<?php echo SITEURL."back/labs/email_templates";?>">Add New Setting</a></span></h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header'>
                <div class='box-body pad'>
                  <?php echo $this->Session->flash('msg');?>
                    <!-- form start -->
                    <?php echo $this->Form->create('Setting', array('type' => 'file'));if (!empty($data)) {
                      foreach($data as $data)
                      {
                        $data = $data['Setting'];
                          ?>
                          <div class="form-group">
                            <?php
                              if($data['slug']=='logo')
                              { 
                                  ?>
                                  <label for="SettingAdmin-email">Logo</label>
                                  <?php
                                  //print form_hidden('added_logo',$data['value']);
                                  echo $this->Form->file($data['slug'],array('default'=>$data['value'],'class'=> $data["slug"]." form-control"));
                                  echo $this->Form->hidden('added_logo',array('default'=>$data['value']));
                                  if(!empty($data['value']))
                                  {
                                  ?>
                                   <img src="<?php echo SITEURL ;?>/img/webimages/logo//<?php echo $data['value'];?>" height="35px;">
                                  <?php }
                              }
                              else
                              {
                                echo $this->Form->input($data['slug'],array('default'=>$data['value'],'class'=>'form-control'));
                                  
                              }?>
                          </div>
                      <?php } 
                    }
                    ?>
                    <div class="form-group "> <input type="submit" class="btn btn-block btn-success btn-flat" value="Update"></div>
                    <?php echo $this->Form->end();?>
	
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