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
                      	   <form action="javascript:void(0);" method="post" id="frm-mb">
                          	 <div class="form-group">
                                    <label>Status</label>
                                     <div class="input-group">
                                       <select name="status" id="status" class="form-control">
                                            <option value="-1">ALL</option>
                                            <?php
											$payments = var_rewardstatus();
											for($i=0;$i<count($payments);$i++)
											{
											?>
                                            <option value="<?=$i?>"><?=rewardstatus($i)?></option>
                                            <?php
											}
											?>
                                        </select>
                                      <span class="input-group-btn">
                                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                      </span>
                                	</div>
                                   
                              </div>
                                
                          </form>
                          <hr/>
                          <div class="col-12 table-responsive">		
                           <table class="table table-bordered table-striped js-dataTable-full">
                            <thead>
                                <tr>
                                    <th class="text-center" align="center"><input type="checkbox" id="chk-items" /></th>
                                    <th>Name</th>
                                    <th>Task Type</th>
                                    <th>Task View</th>
                                    <th>Customer Info</th>
                                    <th>Date</th>
                                    <th>Device Info</th>
                                    <th>Reward (<?=settings('coin_name')?>)</th>
                                    <th>Tx Hash</th>
                                    
                                    <!--
                                    <th class="text-center" style="width: 15%;">Status</th>
                                    <th>Prove</th>
                                    -->
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
											$rewardstatus = var_rewardstatus();
											for($i=0;$i<count($rewardstatus);$i++)
											{
											?>
                                            <option value="<?=$i?>"><?=rewardstatus($i)?></option>
                                            <?php
											}
											?>
            </select>
        </div>
        
         <div class="form-group reason xhide">
        	<label>Reason</label>
            <textarea name="reason" id="reason" class="form-control"></textarea>
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
 
<script>
var table_ajax;
var curls = "<?=site_url('task-reward/getlist')?>?baru=1";
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        table_ajax = $('.js-dataTable-full').dataTable({
			order:[],
			"processing": true, 
			"autoWidth": false,
			"serverSide": true, 
			"order": [[ 0, "DESC" ]],
			"ajax": {
					url :curls,
					type : "GET",
					data : function(d){
						d.status = $("#frm-mb #status").val();
					}
			 },
			columnDefs: [ 
			{ orderable: true, searchable:false,visible:false, targets: [ 0 ],className:'text-center',width:'50px' },
			
			 
			 
			 
			],
			pagingType: "full_numbers",
            pageLength: 20,
            lengthMenu: [[5, 10, 15, 20,100], [5, 10, 15, 20,100]]
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
			var req = post('<?=site_url('task-reward/status')?>',$("#frm-status").serialize());
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
	$("#frm-status #status").change(function()
	{
		var csta = $(this).val();
		$(".reason").addClass("xhide");
		if(csta==2)
		{
			$(".reason").removeClass("xhide");	
		}
	});
	// change
	$("#frm-mb").validate({
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
			table_ajax.api().ajax.reload(); 
			return false;
		}
	});
});
</script>