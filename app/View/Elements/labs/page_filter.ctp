<script>
$(document).ready(function () {
	  var $rows = $('#table_rows tr');
	  $('#tab_search').keyup(function() {
	      var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	      
	      $rows.show().filter(function() {
	          var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	          return !~text.indexOf(val);
	      }).hide();
	  });
	

$('#tab_search').keypress(function(e) {
    if (e.which === 13) {
        $("#searchButton").trigger("click")
        return false;
    }
});
$("#searchButton").click(function() {
    var name_value = $("#tab_search").val();
    var url = $(this).closest("form").attr("action");
    
    if (name_value) {
        $("#cover").show();
        $('#paginate_info').hide();
        $.ajax({type: 'POST',
            url: url,
            data: {  name_value: name_value },
            success: function(data) { $("#table_rows").html(data); $("#cover").hide();},
            error: function(comment) {  $("#cover").hide();}});

    } else { $("#tab_search").focus(); }
});
$("#searchNotApply").click(function() {  $("#cover").show(); location.reload(); })
});
</script>


<div class="box-body">
<?php 
echo $this->Form->create('advanceSearch', array('url' => array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action'] . "_advance")));?>
<div class="input-group margin">
<input type="text" class="form-control" id="tab_search" placeholder="Search"> <span class="input-group-btn">
<input type="button" class="btn btn-info btn-flat" id="searchButton" value="Search "> 
<input type="button" class="btn btn-info btn-flat" id="searchNotApply" value="Reset"> 
</span>
</div>
<?php echo $this->Form->end(); ?>
</div>

<div class="responce" ></div>