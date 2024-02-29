<div id="banner_1" class="section parallax1 dark notopmargin noborder" 
style="padding: 60px 0px; background-color: #43ac5e" >
<div class="container center clearfix">
<div data-animate="fadeInUp" class="fadeInUp animated">
<h2>My Account</h2>
<p>Seamless user control & accessibility.</p>
</div>
</div></div>
<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<?php echo $this->element('sidebar');?>
			<div class="col_two_third col_last nobottommargin">
				<!--CONTENT WRAP-->
				<div class="main-inner"> 
					<!-- CONTENT START -->
					<div class="content">
						<div class="icons-section title-icons-section">
							<div class="card-panel indigo" style="">
								<div class="card-text white-text">
									<h3>Update your account information</h3>
								</div>
								<div class="nomargin-carttext white">
									<div class="box">
										<?php 
										$this->request->data['User'] = $data['User'];
										echo $this->Form->create('User',array('autocomplete'=>'off','id'=>'reg','class'=>'comment-form','autocomplete'=>'off'));
										echo $this->Form->hidden('id');
										?>
										<div class="col_full"><?= $this->Form->input('email',array('class'=>'form-control','label'=>'E-mail','autocomplete'=>'off')) ?></div>
										<div class="col_half"><?= $this->Form->input('first_name',array('class'=>'form-control','label'=>'First Name','autocomplete'=>'off')) ?></div>
										<div class="col_half col_last"><?= $this->Form->input('middle_name',array('class'=>'form-control','label'=>'Middle Name','autocomplete'=>'off')) ?></div>
										<div class="col_half"><?= $this->Form->input('last_name',array('class'=>'form-control','label'=>'Last Name','autocomplete'=>'off')) ?></div>
										<div class="col_half col_last"><?= $this->Form->input('phone',array('class'=>'form-control','label'=>'Phone','autocomplete'=>'off')) ?></div>
										
										
										<div class="col_half"><?= $this->Form->input('password1',array('type'=>'password','class'=>'form-control','label'=>'Password','autocomplete'=>'off','value'=>'','autocomplete'=>'off')) ?></div>
										<div class="col_half col_last"><?= $this->Form->input('password2',array('type'=>'password','class'=>'form-control','label'=>'Confirm Password','autocomplete'=>'off','value'=>'','autocomplete'=>'off')) ?></div>
										
										
										<div class="clear"></div>
										<div id="in_err" class="col m12"></div>
										<div class="col_full nobottommargin"> 
										<?php echo $this->Form->button ( __ ( 'Save' ), array ('id' => 'login','type' => 'button','class' => ' btn waves-effect waves-light green','label' => false ) );?>
										</div>
										<?php echo $this->Form->end(); ?>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/CONTENT END--> 
					
				</div>
				<!-- /CONTENT WRAP--> 
			</div>
			<!--/.col-l-8 --> 
		</div>
		
	
	</div>
	<!-- /.container --> 
</section>
<script>
$(document).ready(function() {
	
	window['validateMobileNumber'] = function(uid) {  var regexp = /^(\+\s*)?(?=([.,\s()-]*\d){8})([\d(][\d.,\s()-]*)([[:alpha:]#][^\d]*\d.*)?$/; if (uid.search(regexp) == -1) { return false; } else { return true;}; }
	window['validateEmail'] = function(email) { var re = /\S+@\S+\.\S+/; return re.test(email); };
	window['validateUsername'] = function(uid) {  var regexp = /^[a-zA-Z0-9_]+$/; if (uid.search(regexp) == -1) { return false; } else { return true;}; }
	window['isValid'] = function(pw) { if (! pw) { return false; } var rgx = [ /.{6,}/]; for (var i = 0; i < rgx.length; i++) { if (! rgx[i].test(pw)) { return false; } } return true;}
	window['nameValid'] = function(pw) { if (! pw) { return false; } var rgx = [ /.{3,}/]; for (var i = 0; i < rgx.length; i++) { if (! rgx[i].test(pw)) { return false; } } return true;}
	
	$( "#login" ).click(function() {

		var UserFirstName = $.trim( $('#UserFirstName').val() );
		var UserLastName = $.trim( $('#UserLastName').val() );
		var UserEmail = $.trim( $('#UserEmail').val() );
		var UserPassword = $.trim( $('#UserPassword').val() );
		var UserPhone = $.trim( $('#UserPhone').val() );

		if(UserFirstName == ""){ $('#in_err').html('<div class="alert alert-danger fadeIn animated">Please enter first name.</div>'); $('#UserFirstName').focus();}
		else if(!nameValid(UserFirstName)){ $('#in_err').html('<div class="alert alert-danger fadeIn animated">First name must have more than 3 characters.</div>'); $('#UserFirstName').focus();}
		
		else if(UserLastName == ""){ $('#in_err').html('<div class="alert alert-danger fadeIn animated">Please enter last name.</div>'); $('#UserLastName').focus();}
		else if(!nameValid(UserLastName)){ $('#in_err').html('<div class="alert alert-danger fadeIn animated">Last name must have more than 3 characters.</div>'); $('#UserLastName').focus();}
		
		
		else if(UserPhone == ""){ $('#in_err').html('<div class="alert alert-danger fadeIn animated">Please enter Phone name.</div>'); $('#UserPhone').focus();}
		else if(!validateMobileNumber(UserPhone)){ $('#in_err').html('<div class="alert alert-danger fadeIn animated">Enter a valid phone number.</div>'); $('#UserPhone').focus();}
		
		else{
			$("#reg").ajaxForm({ 
		    	   target: '#in_err',
		    	   beforeSubmit:function(){ $("#login").prop("disabled",true); $("#login").text('Please wait.....'); }, 
		    	   success: function(response)  {  },
		    	   error : function(response)  { $("#login").prop("disabled",false); $("#login").text('Save'); },
		    	   }).submit(); 
				
			}
	       

		

		

		
	});
});


</script>
