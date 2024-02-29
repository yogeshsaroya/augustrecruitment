<style>
  .file {
    visibility: hidden;
    position: absolute;
  }

  .checkbox input[type="checkbox"],
  .checkbox-inline input[type="checkbox"] {
    margin-left: 0;
  }

  .checkbox label {
    padding-left: 10px;
  }
</style>

<script type="text/javascript">
  var onloadCallback = function() {
    grecaptcha.render('g-recaptcha', {
      'sitekey': '<?php echo DataSitekey; ?>'
    });
  };
</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?&libraries=places&key=<?php echo G_API_KEY; ?>"></script>


<?php
echo $this->Html->script(array('jquery.form', 'bootstrap-datepicker'));
echo $this->Html->css(array('bootstrap-datepicker'));
?>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

<section id="page-title">
  <div class="container clearfix">
    <h1>Employee Enrollment Form</h1>
  </div>
</section>
<section id="content">
  <div class="content-wrap">

    <div class="container clearfix" id="dfrm">
      <p>Please fill our the following form which will then be processed by our Recruitment Team who will get in touch with you with any recruitment opportunities when they become available. You can sign-in at a later stage, if and when needed, to update your information to make sure it is current and accurate.</p>
      <?php echo $this->Form->create('Employee', array('type' => 'file', 'class' => 'nobottommargin', 'id' => 'ee_frm', 'role' => 'form', 'data-toggle' => 'validator'));
      if (isset($d) && !empty($d)) {
        $this->request->data = $d;
        echo $this->Form->hidden('id');
      }
      ?>

      <div class="col-md-6">
        <fieldset>
          <legend>Personal Information</legend>
          <div class="form-group col_half"><?php echo $this->Form->input('User.first_name', array('autocomplete' => 'off', 'class' => 'sm-form-control', 'required' => true)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('User.last_name', array('autocomplete' => 'off', 'class' => 'sm-form-control', 'required' => true)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>

          <div class="form-group col_half"><?php echo $this->Form->input('User.middle_name', array('autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('User.email', array('autocomplete' => 'off', 'class' => 'sm-form-control', 'required' => true)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>

          <div class="form-group col_full"><?php echo $this->Form->input('nationality_id', array('options' => $this->Lab->getCountry(), 'empty' => '', 'class' => 'sm-form-control', 'required' => true)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>

          <div class="form-group col_half"><?php echo $this->Form->input('country_code', array('options' => $code, 'empty' => '', 'class' => 'sm-form-control', 'required' => true)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('telephone_number', array('autocomplete' => 'off', 'class' => 'sm-form-control', 'maxlength' => '12', 'required' => true)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>

          <div class="form-group col_full">
            <label for="EmployeeDateOfBirthMonth">Date Of Birth</label>
            <?php
            echo $this->Form->input(
              'date_of_birth',
              array(
                'label' => false,
                'type' => 'date',
                'class' => 'sm-form-control datepicker1',
                'dateFormat' => 'MDY',
                'empty' => array(
                  'month' => 'Month',
                  'day'   => 'Day',
                  'year'  => 'Year'
                ),
                'separator' => '',
                'minYear' => date('Y') - 90,
                'maxYear' => date('Y') - 15,
                'options' => array('1', '2'),
                'required' => true
              )
            );

            //echo $this->Form->input('date_of_birth',array('class'=>'sm-form-control datepicker1','required'=>true,'label'=>false));

            ?><div class="help-block with-errors"></div>
            <div class="clear"></div>
          </div>

          <div class="form-group col_full"><?php echo $this->Form->input('education', array('options' => $this->Lab->getEducation(), 'empty' => '', 'class' => 'sm-form-control', 'required' => true)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>
        </fieldset>

        <br>
        <fieldset>
          <legend>Your Last Job</legend>
          <div class="form-group col_half"><?php echo $this->Form->input('location', array('id' => 'search_header', 'label' => 'Location (country, city)', 'autocomplete' => 'off', 'class' => 'sm-form-control', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('employer', array('autocomplete' => 'off', 'class' => 'sm-form-control', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>

          <div class="form-group col_half"><?php echo $this->Form->input('from', array('label' => 'Dates Of Employment (From)', 'type' => 'text', 'class' => 'sm-form-control datepicker', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('to', array('label' => 'Dates Of Employment (To)', 'type' => 'text', 'class' => 'sm-form-control datepicker', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>

          <p>Please select the job from the following list that best describes or that is nearest to your current position:</p>

          <div class="form-group col_half"><?php echo $this->Form->input('industry_id', array('label' => 'Industry', 'options' => $i, 'empty' => '', 'id' => 'id_industry', 'onchange' => 'getField()', 'class' => 'sm-form-control', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('field_id', array('label' => 'Field', 'options' => @$field, 'empty' => '', 'id' => 'id_field', 'onchange' => 'getDep()', 'class' => 'sm-form-control', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="clear"></div>

          <div class="form-group col_half"><?php echo $this->Form->input('department_id', array('label' => 'Department', 'options' => @$dep, 'empty' => '', 'id' => 'id_department', 'onchange' => 'getTitle()', 'class' => 'sm-form-control', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('job_title_id', array('label' => 'Job Title', 'options' => @$jt, 'empty' => '', 'id' => 'id_title', 'class' => 'sm-form-control', 'required' => false)); ?><div class="help-block with-errors"></div>
          </div>

          <div class="form-group col_half col_last"><?php echo $this->Form->input('job_title_other', array('class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>

          <div class="clear"></div>
        </fieldset>

      </div>

      <div class="col-md-6">

        <div class="clear"></div>
        <fieldset>
          <legend>Upload CV</legend>
          <div class="form-group">
            <?php echo $this->Form->file('cv', array('class' => 'file', 'required' => false, 'accept' => 'image/x-png,image/gif,image/jpeg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document')); ?>

            <div class="input-group col-xs-12">
              <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
              <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
              <span class="input-group-btn">
                <button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
              </span>
            </div>
          </div>
        </fieldset>
        <br>
        <fieldset>
          <legend> Reference 1</legend>
          <div class="form-group col_half"><?php echo $this->Form->input('reference_name', array('label' => 'Name', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('reference_position', array('label' => 'Position', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
          <div class="col_full form-group"><?php echo $this->Form->input('contact_information', array('type' => 'text', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
        </fieldset>

        <br>
        <fieldset>
          <legend> Reference 2</legend>
          <div class="form-group col_half"><?php echo $this->Form->input('reference_name_2', array('label' => 'Name', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('reference_position_2', array('label' => 'Position', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
          <div class="col_full form-group"><?php echo $this->Form->input('contact_information_2', array('type' => 'text', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
        </fieldset>
        <br>
        <fieldset>
          <legend> Reference 3</legend>
          <div class="form-group col_half"><?php echo $this->Form->input('reference_name_3', array('label' => 'Name', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
          <div class="form-group col_half col_last"><?php echo $this->Form->input('reference_position_3', array('label' => 'Position', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
          <div class="col_full form-group"><?php echo $this->Form->input('contact_information_3', array('type' => 'text', 'autocomplete' => 'off', 'class' => 'sm-form-control')); ?><div class="help-block with-errors"></div>
          </div>
        </fieldset>
        <br>



        <fieldset class="col-md-12">

          <div class="form-group">
            <?php
            $termsAndConditions =  $this->Html->link('Terms And Conditions', '/terms-and-conditions', ['target' => '_blank']);
            $labelConditions = $this->Form->label('agreeToConditions', 'I agree to the  ' . $termsAndConditions . ' of this site', ['class' => 'small_text']);
            echo $this->Form->input('agreeToConditions', ['hiddenField' => false, 'required' => true, 'type' => 'checkbox', 'label' => $labelConditions, 'separator' => '</div><div class="controls">', 'format' => ['before', 'input', 'label', 'between', 'after', 'error'],]);
            ?><div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <?php
            $privacy_policy =  $this->Html->link('Privacy Policy', '/privacy-policy', ['target' => '_blank']);
            $labelConditions1 = $this->Form->label('privacyPolicy', 'I agree to the  ' . $privacy_policy . ' of this site', ['class' => 'small_text']);
            echo $this->Form->input('privacyPolicy', ['hiddenField' => false, 'required' => true, 'type' => 'checkbox', 'label' => $labelConditions1, 'separator' => '</div><div class="controls">', 'format' => ['before', 'input', 'label', 'between', 'after', 'error'],]);
            ?><div class="help-block with-errors"></div>
          </div>

          <div id="g-recaptcha"></div><span class="red"></span>
        </fieldset>

      </div>
      <?php echo $this->Form->end(); ?>
    </div>
    <div class="container">
      <div class="clear"></div><br>
      <div class="col-md-12">
        <div id="preview"></div>
      </div>
      <div class="clear"></div><br>
      <div class="col-md-121"><input type="button" id="sendrequest" value="Save" class="button button-3d button-large button-rounded button-brown pull-right"></div>
    </div>


    <div class="col-md-12">
      <div id="preview1"></div>
    </div>
  </div>
</section>

<script>
  $(document).on('click', '.browse', function() {
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });
  $(document).on('change', '.file', function() {
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  });

  function get_address_header() {
    var southWest = new google.maps.LatLng(28.3914, -81.936035);
    var northEast = new google.maps.LatLng(28.3914, -81.936035);
    var hyderabadBounds = new google.maps.LatLngBounds(southWest, northEast);
    var options = {
      types: ['geocode'],
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



  function getField() {
    $("#preview").html('');
    var id = $('#id_industry').val();
    var datastring = "id=" + id + "&type=2";
    var sel_option = $('#id_field');
    $(function() {
      $.ajax({
        type: 'POST',
        async: false,
        dataType: 'json',
        url: '' + SITEURL + 'pages/job/',
        data: datastring,
        success: function(data) {
          $('#id_field option').remove();
          sel_option.prepend('<option value=""></option>');

          $('#id_department option').remove();
          $('#id_department').prepend('<option value=""></option>');

          $('#id_title option').remove();
          $('#id_title').prepend('<option value=""></option>');

          $.each(data, function(index, value) {
            var o = new Option(value, index.trim());
            $(o).html(value);
            sel_option.append(o);
          });
          sel_option.val('');
        },
        error: function(comment) {}
      });
    });
  }

  function getDep() {
    $("#preview").html('');
    var id = $('#id_field').val();
    var datastring = "id=" + id + "&type=2";
    var sel_option = $('#id_department');
    $(function() {
      $.ajax({
        type: 'POST',
        async: false,
        dataType: 'json',
        url: '' + SITEURL + 'pages/job/',
        data: datastring,
        success: function(data) {
          $('#id_department option').remove();
          sel_option.prepend('<option value=""></option>');

          $('#id_title option').remove();
          $('#id_title').prepend('<option value=""></option>');

          $.each(data, function(index, value) {
            var o = new Option(value, index.trim());
            $(o).html(value);
            sel_option.append(o);
          });
          sel_option.val('');
        },
        error: function(comment) {}
      });
    });
  }

  function getTitle() {
    $("#preview").html('');
    var id = $('#id_department').val();
    var datastring = "id=" + id + "&type=2";
    var sel_option = $('#id_title');
    $(function() {
      $.ajax({
        type: 'POST',
        async: false,
        dataType: 'json',
        url: '' + SITEURL + 'pages/job/',
        data: datastring,
        success: function(data) {
          $('#id_title option').remove();
          sel_option.prepend('<option value=""></option>');
          $.each(data, function(index, value) {
            var o = new Option(value, index.trim());
            $(o).html(value);
            sel_option.append(o);
          });
          sel_option.val('');
        },
        error: function(comment) {}
      });
    });
  }

  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy-m-d',

    });

    $('#ee_frm').validator().on('submit', function(e) {
      var hasErrors = $('#ee_frm').validator('validate').has('.has-error');
      console.log(hasErrors);

      if (e.isDefaultPrevented() === true) {

        $('html, body').animate({
          scrollTop: $(".has-error:first :input").offset().top - 100
        }, 500);
        $(".has-error:first :input").focus();
      } else {}
    });


    $('#sendrequest').click(function() {

      $("#preview").html('');
      $("#ee_frm").ajaxForm({
        target: '#preview',
        beforeSubmit: function() {
          $("#sendrequest").prop("disabled", true);
          $("#sendrequest").val('Please wait...');
          $("#preview").html('');
        },
        success: function(response) {
          $("#preview").html(response);
          $("#sendrequest").prop("disabled", false);
          $("#sendrequest").val('Save');
        },
        error: function(response) {
          $("#preview").html(response);
          $("#sendrequest").prop("disabled", false);
          $("#sendrequest").val('Save');
        },
      }).submit();
    });

  });
</script>