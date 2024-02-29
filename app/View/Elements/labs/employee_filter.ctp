<script>
$(document).ready(function () {

	$("#searchButton").click(function() {
		var name_value = $("#tab_search").val();
		var industry = $("#id_industry").val();
		var day_value = $("#dago").val();
		var url = $(this).closest("form").attr("action");
		
		if (name_value || industry || day_value) {
			$("#filterDataBackAllEmployeeForm").submit();
	
		}
		else { $("#tab_search").focus(); }
	});
	
	
	$("#searchNotApply").click(function() {
		window.location.href ='<?php echo SITEURL;?>back/labs/all_employee';
	})
	
	
	
	
});
function getDep() { 
		$("#preview").html('');
		var id = $('#id_industry').val() ;
		var datastring = "id="+id+"&type=2";
		var sel_option= $('#id_department');
		$(function(){ $.ajax({type: 'POST',async:false,dataType:'json',
		url: ''+SITEURL+'pages/job/', data: datastring, success: function(data){
		$('#id_department option').remove();
		sel_option.prepend('<option value=""> -- Select Department -- </option>');
	
		$('#id_title option').remove();
		$('#id_title').prepend('<option value=""> -- Select Job Title -- </option>');
		
		$.each(data, function(index, value) {
		var o = new Option(value, index); $(o).html(value); sel_option.append(o);  }); 
		sel_option.val('');
		}, error: function(comment){   }  });  });
	}
	
	function getTitle(){ 
		$("#preview").html('');
		var id = $('#id_department').val() ;
		var datastring = "id="+id+"&type=2";
		var sel_option= $('#id_title');
		$(function(){ $.ajax({type: 'POST',async:false,dataType:'json',
		url: ''+SITEURL+'pages/job/', data: datastring, success: function(data){
		$('#id_title option').remove();
		sel_option.prepend('<option value=""> -- Select Job Title -- </option>');
		$.each(data, function(index, value) {
		var o = new Option(value, index); $(o).html(value); sel_option.append(o);  }); 
		sel_option.val('');
		}, error: function(comment){   }  });  });
	}


</script>


<div class="box-body">
<?php 
echo $this->Form->create('filterData', array( "type"=> "get"));?>
<div class=" margin filter_form">
	<div class="input text col_three_fourth ">
		<?php echo $this->Form->input('keyword',array('label' => "Search",'div' => true,'class'=>'form-control','id'=>"tab_search", 'default'=>$filterData['keyword'])); ?>
	</div>
	<div class="input text col_one_fourth col_last">
	<?php echo $this->Form->input('created', array('options'=>array(1=>'1 day ago', 7=>'1 week ago', 30=>'1 month ago'),'id'=>"dago",'empty'=>'Select','label' => "Created", 'error' => false, 'div' => false, 'class' => 'form-control','default'=>$filterData['created']));?>
	</div>
	<div class="input text col_one_fourth">
	<?php echo $this->Form->input('industry_id',array('label'=>'Industry', 'options' =>$i,'empty'=>' -- Select Industry --','id'=>'id_industry','onchange'=>'getDep()','class'=>'form-control', 'default'=>$filterData['industry_id']));?>
	</div>
	<div class="input text col_one_fourth">
	<?php echo $this->Form->input('department_id',array('label'=>'Department','options' =>@$dep,'empty'=>' -- Select Department -- ','id'=>'id_department','onchange'=>'getTitle()','class'=>'form-control', 'default'=>$filterData['department_id']));?>
	</div>
	<div class="form-group col_one_fourth">
	<?php echo $this->Form->input('job_title_id',array('label'=>'Job Title','options' =>@$jt,'empty'=>' -- Select Job Title --','id'=>'id_title','class'=>'form-control', 'default'=>$filterData['job_title_id']));?>
	</div>
	
	<span class="input-group-btn col_one_fourth col_last">
		<input type="button" class="btn btn-info btn-flat" id="searchButton" value="Search "> 
		<input type="button" class="btn btn-info btn-flat" id="searchNotApply" value="Reset">
	</span>
</div>
<?php echo $this->Form->end(); ?>
</div>

<div class="responce" ></div>