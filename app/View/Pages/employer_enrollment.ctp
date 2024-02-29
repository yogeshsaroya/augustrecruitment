<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('g-recaptcha', {
          'sitekey' : '<?php echo DataSitekey;?>'
        });
      };
    </script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script src="//maps.googleapis.com/maps/api/js?&libraries=places&key=<?php echo G_API_KEY;?>"></script>
<?php echo $this->Html->script(array('jquery.form'));?>
<script src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<section id="page-title">
<div class="container clearfix"><h1>Employer Enrollment Form</h1></div></section>
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix" id="dfrm">
<?php echo $this->Form->create('Employer',array('class'=>'nobottommargin','id'=>'ee_frm','role'=>'form','data-toggle'=>'validator'));
if(isset($d) && !empty($d)){
	$this->request->data= $d;
	echo $this->Form->hidden('id');
}?>				
<div class="row clearfix">
<p>Please fill out the following form which will be sent to our Recruitment Team who will subsequently get in touch with you to help guide you through the remaining steps of our recruitment process.</p>
<fieldset class="col-md-6 nf_col" >
<legend>Personal Information</legend>

<div class="form-group col_half"><?php echo $this->Form->input('designation',array('options' =>$this->Lab->getDesignation(),'empty'=>'Select Salutation','label'=>'Salutation','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="form-group col_half col_last"><?php echo $this->Form->input('User.first_name',array('autocomplete' => 'off','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="clear"></div>

<div class="form-group col_half"><?php echo $this->Form->input('User.last_name',array('autocomplete' => 'off','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="form-group col_half col_last"><?php echo $this->Form->input('User.email',array('autocomplete' => 'off','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="clear"></div>

<div class="form-group col_half"><?php echo $this->Form->input('country_code',array('options' =>$code,'empty'=>'Select country code', 'class'=>'sm-form-control','required'=>false));?><div class="help-block with-errors"></div></div>
<div class="form-group col_half col_last"><?php echo $this->Form->input('telephone_number',array('autocomplete' => 'off','class'=>'sm-form-control','required'=>false));?><div class="help-block with-errors"></div></div>
<div class="clear"></div>

</fieldset>

<fieldset class="col-md-6  col_last" >
<legend>Company Information</legend>

<div class="form-group col_full"><?php echo $this->Form->input('job_title',array('autocomplete' => 'off','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="clear"></div>

<div class="form-group col_half"><?php echo $this->Form->input('company_name',array('autocomplete' => 'off','class'=>'sm-form-control','required'=>true,'data-error'=>'Please enter company title.' ));?><div class="help-block with-errors"></div></div>
<div class="form-group col_half col_last"><?php echo $this->Form->input('city',array('label'=>'Location', 'id'=>'search_header','autocomplete' => 'off','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="clear"></div>

<div class="form-group col_half"><?php echo $this->Form->input('website',array('class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="form-group col_half col_last"><?php echo $this->Form->input('company_phone',array('label'=>'Company Phone Number','autocomplete' => 'off','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="clear"></div>

</fieldset>
<div class="clear"></div>
<br><br>
<fieldset class="col-md-12" >
<legend>Employment Information</legend>

<div class="form-group col_half"><?php echo $this->Form->input('large_corporation',array('label'=>'How many individuals does your organization employ?','options' =>$this->Lab->getEmp1(),'empty'=>'', 'class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="form-group col_half col_last"><?php echo $this->Form->input('how_many_employees',array('label'=>'How many employees do you recruit a year?','options' =>$this->Lab->getEmp2(),'empty'=>'','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>

<div class="clear"></div>

<h4>How many candidates are you currently looking to hire?</h4>


<div class="form-group col_half col_last"><?php echo $this->Form->input('hire_employees',array('label'=>false,'id'=>'h_emp', 'options' =>$this->Lab->getHowManyEmp(),'empty'=>'','class'=>'sm-form-control','required'=>false));?><div class="help-block with-errors"></div></div>
<div class="clear"></div>

<div id="emp_num">
<?php if( isset( $d['JobTitle']) && !empty($d['JobTitle']) ){
$no = 1;
foreach ($d['JobTitle'] as $Rjlist){
	$d ='none';
	$rid = $Rjlist['id'];
	$dep = $this->Lab->get_ind($Rjlist['industry_id']);
	$jt = $this->Lab->get_ind($Rjlist['department_id']);
	$job_n = $this->Lab->getCatName($Rjlist['job_title_id']);
	if(isset($job_n['Category']['name']) && !empty($job_n['Category']['name'])){
		if( strtolower($job_n['Category']['name']) == 'other' ){ $d ='block'; }
	}

echo $this->Form->hidden('id',array('name'=>'data[JobTitle]['.$rid.'][id]','value'=>$Rjlist['id'])); ?>
<h5>Employees - <?php echo $no;?></h5>
<div class="form-group col_one_fourth"><?php echo $this->Form->input('industry_id',array('name'=>'data[JobTitle]['.$rid.'][industry_id]', 'label'=>'Industry', 'options' =>$i,'empty'=>'','id'=>'id_industry_'.$rid,'onchange'=>'getDep('.$rid.')','class'=>'sm-form-control','required'=>true,'default'=>$Rjlist['industry_id']));?><div class="help-block with-errors"></div></div>
<div class="form-group col_one_fourth"><?php echo $this->Form->input('department_id',array('name'=>'data[JobTitle]['.$rid.'][department_id]','label'=>'Department','options' =>@$dep,'empty'=>'','id'=>'id_department_'.$rid,'onchange'=>'getTitle('.$rid.')','class'=>'sm-form-control','required'=>true,'default'=>$Rjlist['department_id']));?><div class="help-block with-errors"></div></div>
<div class="form-group col_one_fourth"><?php echo $this->Form->input('job_title_id',array('name'=>'data[JobTitle]['.$rid.'][job_title_id]','label'=>'Job Title','options' =>@$jt,'empty'=>'','id'=>'id_title_'.$rid,'onchange'=>'getOther('.$rid.')','class'=>'sm-form-control','required'=>true,'default'=>$Rjlist['job_title_id']));?><div class="help-block with-errors"></div></div>
<div class="form-group col_one_fourth col_last" style="display:<?php echo $d;?>" id="ot_d_<?php echo $rid;?>"><?php echo $this->Form->input('other_job_title',array('name'=>'data[JobTitle]['.$rid.'][other_job_title]','label'=>'Other Job Title','id'=>'id_title_other_'.$rid,'class'=>'sm-form-control','value'=>$Rjlist['other_job_title']));?><div class="help-block with-errors"></div></div>

<div class="clear"></div>	 
	
<?php $no++; } }?>


</div>

</fieldset>
						
<div class="clear bottommargin"></div>
<div class="col-md-12"><div id="preview"></div></div>
<div class="col-md-6"><div id="g-recaptcha"></div><span class="red"></span></div>
<div class="col-md-6">
<input type="button" id="sendrequest" value="Save" class="button button-3d button-large button-rounded button-brown pull-right">
</div>

</div>
<?php echo $this->Form->end();?>					
</div>
<div class="col-md-12"><div id="preview1"></div></div>

			</div>

		</section><!-- #content end -->
		
<script type="text/javascript">
function get_address_header() {
    var southWest = new google.maps.LatLng(28.3914, -81.936035);
    var northEast = new google.maps.LatLng(28.3914, -81.936035);
    var hyderabadBounds = new google.maps.LatLngBounds(southWest, northEast);
    var options = { types: ['geocode'],
        //                componentRestrictions: {country: "us"}
    };
    var input1 = document.getElementById('search_header');
    var autocomplete = new google.maps.places.Autocomplete(input1, options);
    google.maps.event.addDomListener(autocomplete, 'place_changed', function() {
        //var form = document.getElementById("placesearch_header");
        var place = autocomplete.getPlace();
        //document.getElementById('search_header').value = place.formatted_address;

    });
}
google.maps.event.addDomListener(window, 'load', get_address_header);


function getOther(id_num) {
	$("#preview").html('');

	if( id_num != ''){
		var id = $('#id_title_'+id_num).val() ;
		var str = $("#id_title_"+id_num+" option[value='"+id +"']").text();
		var t = str.toLowerCase();
		if( t == 'other'){ $('#ot_d_'+id_num).show(); }
		else{ $('#ot_d_'+id_num).hide(); $('#id_title_other_'+id_num).val(''); }
	}else{ $('#ot_d_'+id_num).hide(); $('#id_title_other_'+id_num).val(''); }
}

function getDep(id_num) { 
	$("#preview").html('');

	if( id_num != ''){
		var id = $('#id_industry_'+id_num).val() ;
		var datastring = "id="+id+"&type=2";
	    var sel_option= $('#id_department_'+id_num);
	    
	    $(function(){ $.ajax({type: 'POST',async:false,dataType:'json',
	        url: ''+SITEURL+'pages/job/', data: datastring, success: function(data){
	        $('#id_department_'+id_num+' option').remove();
	        sel_option.prepend('<option value="">Select Department</option>');

	        $('#id_title_'+id_num+' option').remove();
	        $('#id_title_'+id_num+'').prepend('<option value="">Select Job Title</option>');
	        
	        $.each(data, function(index, value) {
	        var o = new Option(value, index.trim()); $(o).html(value); sel_option.append(o);  }); 
	        sel_option.val('');
	        }, error: function(comment){   }  });  });
	}
}

function getTitle(id_num){ 
	$("#preview").html('');
	if( id_num != ''){
		var id = $('#id_department_'+id_num).val() ;
	    var datastring = "id="+id+"&type=2";
	    var sel_option= $('#id_title_'+id_num);
	    $(function(){ $.ajax({type: 'POST',async:false,dataType:'json',
	    url: ''+SITEURL+'pages/job/', data: datastring, success: function(data){
	    $('#id_title_'+id_num+' option').remove();
	    sel_option.prepend('<option value="">Select Job Title</option>');
	    $.each(data, function(index, value) {
	    var o = new Option(value, index.trim()); $(o).html(value); sel_option.append(o);  }); 
	    sel_option.val('');
	    }, error: function(comment){   }  });  });
	}
}

$(document).ready(function(){

$( "#h_emp" ).change(function() {

if( this.value != ''){
	$("#preview1").html('');
	  $("#preloader").show(); 
	  $.ajax({type: 'POST',
	  	url: ''+SITEURL+'pages/title/',
	  	data: 'total='+this.value+'',
	  	success: function(data) { $("#emp_num").html(data);  $("#preloader").hide();  },
	  	error: function(comment) { $("#emp_num").html(comment);  $("#preloader").hide();  }});
}
		
		  
});
	
	$('#ee_frm').validator().on('submit', function (e) {
	    if (e.isDefaultPrevented()) {
	        $('html, body').animate({ scrollTop: $(".has-error:first :input").offset().top - 100 }, 500);
	        $(".has-error:first :input").focus();
	    } else { }
	});


	$('#sendrequest').click( function() {
		$("#preview").html('');
			$("#ee_frm").ajaxForm({ 
		    	   target: '#preview',
		    	   beforeSubmit:function(){  $("#sendrequest").prop("disabled",true); $("#sendrequest").val('Please wait...'); $("#preview").html(''); }, 
		    	   success: function(response) { $("#preview").html(response);} }).submit();
	   });

});
</script>		
