<p>From the following list, please select the job(s) that best describe or that are nearest to the positions you would like to fill.</p>

<?php 
if(isset($num) && !empty($num)){
	for($i=1; $i <=$num; $i++){ ?>
<h5>Employees - <?php echo $i;?></h5>

<div class="form-group col_one_fourth"><?php echo $this->Form->input('industry_id',array('name'=>'data[JobTitle]['.$i.'][industry_id]', 'label'=>'Industry', 'options' =>$ind,'empty'=>'','id'=>'id_industry_'.$i,'onchange'=>'getDep('.$i.')','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="form-group col_one_fourth"><?php echo $this->Form->input('department_id',array('name'=>'data[JobTitle]['.$i.'][department_id]','label'=>'Department','options' =>@$dep,'empty'=>'','id'=>'id_department_'.$i,'onchange'=>'getTitle('.$i.')','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="form-group col_one_fourth"><?php echo $this->Form->input('job_title_id',array('name'=>'data[JobTitle]['.$i.'][job_title_id]','label'=>'Job Title','options' =>@$jt,'empty'=>'','id'=>'id_title_'.$i,'onchange'=>'getOther('.$i.')','class'=>'sm-form-control','required'=>true));?><div class="help-block with-errors"></div></div>
<div class="form-group col_one_fourth col_last" style="display:none" id="ot_d_<?php echo $i;?>"><?php echo $this->Form->input('other_job_title',array('name'=>'data[JobTitle]['.$i.'][other_job_title]','label'=>'Other Job Title','id'=>'id_title_other_'.$i,'class'=>'sm-form-control'));?><div class="help-block with-errors"></div></div>

<div class="clear"></div>		
	<?php } }?>
