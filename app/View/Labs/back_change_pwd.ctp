      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Change root password</h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="pwd">Password</label>
                      <input type="password" class="form-control" id="pwd" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="reenter">Re-enter</label>
                      <input type="password" class="form-control" id="reenter" placeholder="Re-enter">
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                  <div id="err" style="min-height:60px"></div>
                  </div>

                  <div class="box-footer">
                    <input type="button" class="btn btn-block btn-primary btn-flat" onclick="save();" id="pro" value="Save">
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<script>
function s(){$("#pro").prop("disabled",false); $("#pro").val('Save');}
function save(){
	var p = $('#pwd').val();
	var p1 = $('#reenter').val();

	$('#err').html('')
	$("#pro").prop("disabled",true); $("#pro").val('Please wait...');
	$.ajax({ type: 'POST', url: ""+SITEURL+"back/labs/change_pwd",
		  data: { p: $.trim(p), p1: $.trim(p1) },
		  success: function( data ) { $( "#err" ).html(data); },error: function(comment) { s();} });
    }
</script>
