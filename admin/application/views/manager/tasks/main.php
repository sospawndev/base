<div class="content-wrapper">
   <div class="row">
            <div class="col-md-12">
                    <div class="card">
                    	<div class="card-header no-bg b-a-0">
                        List <?=$title?>
                         <span class="pull-right">
                              
                           
                         </span>  
                      </div>
                      <div class="card-body">
                      	 
                          <div class="col-12 table-responsive">		
                           <table class="table table-bordered table-striped js-dataTable-full">
                            <thead>
                                <tr>
                                    <th class="text-center" align="center">Payment<br/>Type</th>
                                    <th>PID</th>
                                    <th>Client Info</th>
                                    <th>Name</th>
                                    <th>Task Type</th>
                                    <th>Date</th>
                                    <th>Item Purchase</th>
                                    <th>Links</th>
                                    <th>Payment</th>
                                    <th>Count Item <br/> Left</th>
                                    <th>Status</th> 
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                          </div>  
                      </div>
                    
                    
                    </div>
            </div>
   </div>
</div>                    
<!-- modal reset pass -->
<div id="modalstatus" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="" method="post" id="frm-status">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Status</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<label>Status</label>
            <select name="status" id="status" class="form-control status_pay">
            	 <?php
											$payments = varpayment();
											for($i=0;$i<count($payments);$i++)
											{
											?>
                                            <option value="<?=$i?>"><?=payments($i)?></option>
                                            <?php
											}
											?>
            </select>
        </div>
         
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="id" value="" id="id" />
        <!--
        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
        -->
      	<button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>    

<!-- modal date pass -->
<div id="modaldate" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="" method="post" id="frm-date">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Date</h4>
      </div>
      <div class="modal-body">
         <!-- -->
         <div class="form-group">
                                        <label>From Date</label>
                                        <input type="text" class="form-control required" name="start_date" id="start_date" placeholder="From Date" value="<?=isset($data['start_date'])?$data['start_date']:''?>" />
                                    </div>
                                     <div class="form-group">
                                        <label>To Date</label>
                                        <input type="text" class="form-control required" name="end_date" id="end_date" placeholder="To Date" value="<?=isset($data['end_date'])?$data['end_date']:''?>" />
                                    </div>
         
         <!-- -->
         
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="id" value="" id="id" />
        <!--
        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
        -->
      	<button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>     
<script>
var table_ajax;
var curls = "<?=site_url('tasks/getlist')?>?baru=1";
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        table_ajax = $('.js-dataTable-full').dataTable({
			order:[],
			"processing": true, 
			"autoWidth": false,
			"serverSide": true, 
			"order": [[ 8, "desc" ]],
			"ajax": {
					url :curls,
					type : "GET",
					data : function(d){
						 
						//d.id_category = $("#id_category").val();
						//d.id_subcategory = $("#id_subcategory").val();
					}
			 },
			columnDefs: [ 
			{ orderable: false, searchable:false,visible:false, targets: [ 0 ],className:'text-center',width:'50px' },
			
			 
			 
			 
			],
			pagingType: "full_numbers",
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]]
        });
    };

     

    return {
        init: function() {
            // Init Datatables
            
            initDataTableFull();
        }
    };
}();

// Initialize when page loads
$(document).ready(function(){
	BaseTableDatatables.init();
	$('body').tooltip({selector: '[data-toggle="tooltip"]'});
	$(".js-dataTable-full").on('click','.btn-status',function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			$("#modalstatus").find("#id").val(ids);
			$("#modalstatus").modal('show');
		}
	});
	$("#frm-status").validate({
		ignore:[],
		onkeyup:false,
		errorClass: 'help-block text-right animated fadeInDown',
		errorElement: 'div',
		errorPlacement: function(error, e) {
			jQuery(e).parents('.form-group').append(error);
		},
		highlight: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		success: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		submitHandler:function(){
			var req = post('<?=site_url('tasks/status')?>',$("#frm-status").serialize());
			req.done(function(out){
				if(!out.error)
				{
					table_ajax.api().ajax.reload();
					smart_success_box(out.message,'#frm-reset .modal-body');
					$("#modalstatus").modal('hide');
				}
				else
				{
					smart_message(out.message,'#frm-reset .modal-body');
				}
			});
			return false;
		}
	});
	// ==========
	$(".js-dataTable-full").on('click','.btn-dates',function(){
		var ids = $(this).data('ref');
		var fromdate = $(this).data('from');
		var todate = $(this).data('to');
		if(ids!="" && fromdate!="")
		{
			$("#modaldate").find("#end_date").val(todate);
			$("#modaldate").find("#start_date").val(fromdate);
			$("#modaldate").find("#id").val(ids);
			$("#modaldate").modal('show');
		}
	});
	$("#frm-date").validate({
		ignore:[],
		onkeyup:false,
		errorClass: 'help-block text-right animated fadeInDown',
		errorElement: 'div',
		errorPlacement: function(error, e) {
			jQuery(e).parents('.form-group').append(error);
		},
		highlight: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		success: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		submitHandler:function(){
			var req = post('<?=site_url('tasks/dates')?>',$("#frm-date").serialize());
			req.done(function(out){
				if(!out.error)
				{
					table_ajax.api().ajax.reload();
					smart_success_box(out.message,'#frm-reset .modal-body');
					$("#modaldate").modal('hide');
				}
				else
				{
					smart_message(out.message,'#frm-reset .modal-body');
				}
			});
			return false;
		}
	});
		$('#start_date').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });
	$('#end_date').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });	
});
</script>