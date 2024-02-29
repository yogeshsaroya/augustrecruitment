<style>
  .dl-horizontal dt {
    width: 200px;
  }

  .dl-horizontal dd {
    margin-left: 220px;
  }
</style>

<div class="content-wrapper" style="min-height: 1066px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo $MenuHead; ?></h1>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-body">

        <div class="row">
          <div class="col-md-6">
            <div class="box box-solid">
              <div class="box-header with-border">
                <i class="fa fa-text-width"></i>
                <h3 class="box-title"><?php echo $MenuHead; ?> </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <dl class="dl-horizontal">

                  <?php if (!empty($data['Employee']['first_name'])) { ?><dt>Name : </dt>
                    <dd><?php echo $data['Employee']['first_name'] . ' ' . $data['Employee']['middle_name'] . ' ' . $data['Employee']['last_name']; ?></dd><?php } ?>
                  <dt>email : </dt>
                  <dd><?php echo $data['Employee']['email']; ?></dd>
                  <?php if (!empty($data['Employee']['nationality'])) { ?><dt>Nationality : </dt>
                    <dd><?php echo $data['Employee']['nationality']; ?></dd><?php } ?>
                  <dt>Telephone Number : </dt>
                  <dd><?php echo $data['Employee']['telephone_number']; ?></dd>
                  <dt>D.O.B. : </dt>
                  <dd><?php echo $data['Employee']['date_of_birth']; ?></dd>
                  <dt>email : </dt>
                  <dd><?php echo $data['Employee']['email']; ?></dd>
                  <dt>Education : </dt>
                  <dd><?php echo $data['Employee']['education']; ?></dd>
                  <dt>job_title : </dt>
                  <dd><?php echo $data['Employee']['job_title']; ?></dd>
                  <dt>Location : </dt>
                  <dd><?php echo $data['Employee']['location']; ?></dd>
                  <dt>Employer : </dt>
                  <dd><?php echo $data['Employee']['employer']; ?></dd>
                  <dt>Date of Employment(From) : </dt>
                  <dd><?php echo $data['Employee']['from']; ?></dd>
                  <dt>Date of Employment (TO) : </dt>
                  <dd><?php echo $data['Employee']['to']; ?></dd>
                  <dt>Field : </dt>
                  <dd><?php echo $data['Employee']['field']; ?></dd>
                  <dt>Industry : </dt>
                  <dd><?php echo $data['Employee']['industry']; ?></dd>
                  <dt>Department : </dt>
                  <dd><?php echo $data['Employee']['department']; ?></dd>
                  <dt>Job Title : </dt>
                  <dd><?php echo $data['Employee']['job_title']; ?></dd>

                  <dt>Job Title - Other: </dt>
                  <dd><?php echo $data['Employee']['job_title_other']; ?></dd>

                  <dt>Reference_name 1 : </dt>
                  <dd><?php echo $data['Employee']['reference_name']; ?></dd>
                  <dt>Reference Position 1 : </dt>
                  <dd><?php echo $data['Employee']['reference_position']; ?></dd>
                  <dt>Contact Information 1 : </dt>
                  <dd><?php echo $data['Employee']['contact_information']; ?></dd>

                  <dt>Reference_name 2 : </dt>
                  <dd><?php echo $data['Employee']['reference_name_2']; ?></dd>
                  <dt>Reference Position 2 : </dt>
                  <dd><?php echo $data['Employee']['reference_position_2']; ?></dd>
                  <dt>Contact Information 2 : </dt>
                  <dd><?php echo $data['Employee']['contact_information_2']; ?></dd>

                  <dt>Reference_name 3 : </dt>
                  <dd><?php echo $data['Employee']['reference_name_3']; ?></dd>
                  <dt>Reference Position 3 : </dt>
                  <dd><?php echo $data['Employee']['reference_position_3']; ?></dd>
                  <dt>Contact Information 3 : </dt>
                  <dd><?php echo $data['Employee']['contact_information_3']; ?></dd>


                  <dt>Resume : </dt>
                  <dd><?php if (!empty($data['Employee']['my_cv'])) {
                        echo "<a href='" . SITEURL . "cdn/cv/" . $data['Employee']['my_cv'] . "' target='_blank'>" . $data['Employee']['my_cv'] . "</a>";
                      } ?> </dd>


                  <dt>Status : </dt>
                  <dd><?php echo ($data['Employee']['status']) ? 'Active' : 'Inactive'; ?></dd>
                  <dt>Date of Creation : </dt>
                  <dd><?php echo $data['Employee']['created']; ?></dd>
                </dl>


              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- ./col -->
          <div class="col-md-6">
            <div class="box box-solid">
              <div class="box-header with-border">
                <i class="fa fa-text-width"></i>
                <h3 class="box-title">User detail </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <dl class="dl-horizontal">
                  <dt>Name : </dt>
                  <dd><?php echo $data['User']['first_name'] . " " . $data['User']['last_name']; ?></dd>
                  <dt>Email : </dt>
                  <dd><?php echo $data['User']['email']; ?></dd>
                  <dt>Phone : </dt>
                  <dd><?php echo $data['User']['phone']; ?></dd>
                  <dt>Created : </dt>
                  <dd><?php echo date('M d,y', strtotime($data['User']['created'])); ?></dd>
                </dl>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>