<script>
$(document).ready(function () {

	$("#searchButton").click(function() {
		var name_value = $("#tab_search").val();
		var country_value = $("#cid").val();
		var day_value = $("#dago").val();
		var url = $(this).closest("form").attr("action");
		
		if (name_value || country_value || day_value) {
			$("#filterDataBackAllEmployerForm").submit();
	
		}
		else { $("#tab_search").focus(); }
	});
	
	
	$("#searchNotApply").click(function() {
		window.location.href ='<?php echo SITEURL;?>back/labs/all_employer';
	})
});


</script>


<div class="box-body">
<?php 
echo $this->Form->create('filterData', array( "type"=> "get"));?>
<div class="input-group margin filter_form">
	<div class="input text col_one_third">
		<?php echo $this->Form->input('keyword',array('label' => "Search",'div' => true,'class'=>'form-control','id'=>"tab_search", 'value'=>$filterData['keyword'])); ?>
	</div>
	<div class="input text col_one_third">
	<?php echo $this->Form->input('location', array('options'=>$country,'id'=>"cid",'empty'=>'Select Country','label' => "Location", 'error' => false, 'div' => false, 'class' => 'form-control','default'=>$filterData['location']));?>
	</div>
	<div class="input text col_one_fourth">
	<?php echo $this->Form->input('created', array('options'=>array(1=>'1 day ago', 7=>'1 week ago', 30=>'1 month ago'),'id'=>"dago",'empty'=>'Select','label' => "Created", 'error' => false, 'div' => false, 'class' => 'form-control','default'=>$filterData['created']));?>
	</div>
	<span class="input-group-btn ">
		<input type="button" class="btn btn-info btn-flat" id="searchButton" value="Search "> 
		<input type="button" class="btn btn-info btn-flat" id="searchNotApply" value="Reset">
	</span>
</div>
<?php echo $this->Form->end(); ?>
</div>

<div class="responce" ></div>