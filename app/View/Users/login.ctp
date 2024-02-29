<?php 
$pURL =  SITEURL."login";
$register =  SITEURL."register";
if(isset($r_url) && !empty($r_url)) { $pURL =  SITEURL."login?return_url=".urlencode($r_url);
$register =  SITEURL."register?return_url=".urlencode($r_url);
}
?>
<section id="content">

            <div class="content-wrap nopadding">

                <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background-color:rgba(67,172, 94, 0.7)"></div>

                <div class="section nobg full-screen nopadding nomargin">
                    <div class="container vertical-middle divcenter clearfix">
						<div class="panel panel-default divcenter noradius noborder" style="max-width: 400px;">
                            <div class="panel-body" style="padding: 40px;">
								<?php echo $this->Form->create('User',array('autocomplete'=>'off','id'=>'reg','class'=>'nobottommargin')); ?>
								<h3>Login to your Account</h3>
								<div class="col_full"><?= $this->Form->input('email',array('class'=>'form-control','label'=>'E-mail','autocomplete'=>'off')) ?></div>
								<div class="col_full"><?= $this->Form->input('password',array('class'=>'form-control','label'=>'Password','autocomplete'=>'off')) ?></div>
								<div class="col_full" id="in_err"></div>
								
								<div class="col_full nobottommargin">
									<?php echo $this->Form->button ( __ ( 'Login' ), array ('id' => 'login','type' => 'button','class' => 'button button-3d button-black nomargin','label' => false ) );?>
									<?php /*?><a class="fright" href="<?php echo SITEURL."users/forgot_password";?>">Forgot Password?</a><?php */?>
								</div>
								
								<?php echo $this->Form->end(); ?>
                                
                                


                
                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </section><!-- #content end -->

    
<script>
$(document).ready(function() {

	$(document).on('keypress', '#UserEmail, #UserPassword', function(e) {
        if ( e.keyCode == 13 ) {
        	$( "#login" ).trigger( "click" );
        }
    });
    
	
	
	window['validateEmail'] = function(email) { var re = /\S+@\S+\.\S+/; return re.test(email); };
	
	$( "#login" ).click(function() {

		var e = $.trim( $('#UserEmail').val() );
		var p = $.trim( $('#UserPassword').val() );
		if(e == ""){ $('#in_err').html('<div class="alert alert-danger"><?php echo __('Please enter email address.');?></div>'); $('#UserEmail').focus();}
		else if( !validateEmail(e) ){ $('#in_err').html('<div class="alert alert-danger"><?php echo __('Please enter a valid email address.');?></div>'); $('#UserEmail').focus();}
		else if(p == ""){ $('#in_err').html('<div class="alert alert-danger"><?php echo __('Please enter passowrd.');?></div>'); $('#UserPassword').focus();}
		else{
			$("#login").prop("disabled",true); $("#login").text('Please wait.....');			    
			$.ajax({type: 'POST',
				url: '<?php echo $pURL;?>',
				data: "e="+e+"&p="+p+"",
				success: function(data) { $("#in_err").html(data); },
				error: function(comment) { $("#in_err").html(comment); $("#login").prop("disabled",false); $("#login").text('Login'); }});
			}

		
	});
});


</script>
