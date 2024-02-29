<style>
@media only screen and (max-width: 800px) {
#no-more-tables table,#no-more-tables thead,#no-more-tables tbody,#no-more-tables th,#no-more-tables td,#no-more-tables tr{display:block}
#no-more-tables thead tr{position:absolute;top:-9999px;left:-9999px}
#no-more-tables tr{border:1px solid #ccc}
#no-more-tables td{border:none;border-bottom:1px solid #eee;position:relative;padding-left:50%;white-space:normal;text-align:left}
#no-more-tables td:before{position:absolute;top:6px;left:6px;width:45%;padding-right:10px;white-space:nowrap;text-align:left;font-weight:700;content:attr(data-title)}
}
@media (min-width: 320px) and (max-width: 991px) { 
.btn { width: 120px; margin: 4px 0 0 0; }
}
</style>

<div id="banner_1" class="section parallax1 dark notopmargin noborder" 
style="padding: 60px 0px; background: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url('<?php echo SITEURL."images/website_managment.png";?>');  no-repeat fixed center center/ cover; background-position: 50% " >
<div class="container center clearfix">
<div data-animate="fadeInUp" class="fadeInUp animated">
<h2>Employee Application</h2>

</div>
</div></div>

<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<?php echo $this->element('sidebar');?>
			<div class="col_three_fourth col_last nobottommargin">
				<!--CONTENT WRAP-->
				<div class="main-inner"> 
					<!-- CONTENT START -->
					<div class="content">
						<div class="icons-section title-icons-section">
							<div class="card-panel indigo" style="">
								<div class="card-text white-text">
									<h3>My Application</h3>
									
								</div>
								<div class="nomargin-carttext white" id="no-more-tables">

									<table class="col-md-12 table-bordered table-striped table-condensed cf">
									  
<?php 

if(isset($data) && !empty($data)) { ?>
<thead class="cf">
	<tr>
	<th>#</th>
	<th>Name</th>
	<th>Employer</th>
	<th>Job Title</th>
	<th>Created</th>
	<th>Edit</th>
	</tr>
</thead>
<tbody>
<?php $no =1;
foreach($data as $list){
$pArr = null;
?>
<tr>
	<td class="tbl_id" data-title="#"><?php echo $no;?></td>
	<td data-title="Doamin"><?php echo $list['Employee']['first_name'];?></td>
	<td data-title="Doamin"><?php echo $list['Employee']['employer'];?></td>
	<td data-title="Created"><?php echo $list['Employee']['job_title'];?></td>
	<td data-title="Created"><?php echo date('m/d/Y',strtotime($list['Employee']['created']));?></td>
	
<td class="last_action" data-title="Action">
<a class="btn btn-green" href="<?php echo SITEURL."pages/employee_enrollment/".$list['Employee']['id'];?>" role="button">Edit</a>
</td>
</tr>
<?php $no++; } ?>
</tbody>
<?php } else { ?> 
<div class="promo promo-border bottommargin">
<h3>You haven't Enrolled yet</h3>
<a href="<?php echo SITEURL."pages/employee_enrollment";?>" class="button button-xlarge button-rounded">Start Now</a>
</div>
<?php } ?>
										
</tbody>
</table>
<div class="line"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>