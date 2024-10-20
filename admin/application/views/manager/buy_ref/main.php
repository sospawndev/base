<div class="content-wrapper">
   <div class="row">
            <div class="col-md-12">
                    <div class="card">
                    	<div class="card-header no-bg b-a-0">
                        List 
                         <span class="pull-right">
                             
                         </span>  
                      </div>
                      <div class="card-body">
                      	  
                           
                          <div class="col-12 table-responsive">		
                           <table class="table table-bordered table-striped js-dataTable-full">
                            <thead>
                                <tr>
                                    
                                    
                                    <th>User Refferal</th>
                                    <th>Name Refferal</th> 
                                    <th>Order Id</th> 
                                    <th>User Id</th> 
                                    
                                    <th>Settlement Date</th>
                                    <th>Order Cost</th>
                                    <th>Percent Reward(%)</th>
                                    <th>Amount Reward</th>
                                    <th>User Information</th>
                                   
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
 
<script>
var table_ajax;
var curls = "<?=site_url('buy-ref/getlist')?>";
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        table_ajax = $('.js-dataTable-full').dataTable({
			dom: 'Bfrtip',
			buttons: [
				  
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					},
					customize: function ( xlsx ){
						var sheet = xlsx.xl.worksheets['sheet1.xml'];
		 
						// jQuery selector to add a border
						 
						 $('row c', sheet).attr( 's', '25' );
						 $('row[r=2] c', sheet).attr( 's', '27' );
						 // $('row c', sheet).attr( 's', '25' );
						 //$('row c[r^="B"]', sheet).attr( 's', '2' );
						  
					},
					filename: "printitem", 
					title: " "
				},
				{
					extend: 'colvis',
					text: "Filter Column"
				},
				'pageLength'
			],
			order:[[4, "desc" ]],
			"processing": true, 
			"autoWidth": false,
			"serverSide": true, 
			"ajax": {
					url :curls,
					type : "GET",
					data : function(d){
						 
						d.status = $("#frm-mb #status").val();
						//d.id_subcategory = $("#id_subcategory").val();
					}
			 },
			columnDefs: [ 
			 
			 
			 
			],
			pagingType: "full_numbers",
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20,-1], [5, 10, 15, 20,"ALL"]]
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
	
	$(".js-dataTable-full").on('click','.btn-delete-users',function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Delete this?",
				message: "Do you want to delete this.",
				buttons: {
					cancel: {
						label: '<i class="fa fa-times"></i> Cancel'
					},
					confirm: {
						label: '<i class="fa fa-check"></i> Confirm'
					}
				},
				callback: function (result) {
					if(result)
					{
						var req = post('<?=site_url('buy-ref/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								smart_success_box(out.message,'#tbl-uses');
							}
							else
							{
								smart_error_box(out.message,'#tbl-uses');
							}
						});		
					}
				}
			});
		}
	});
	$("#btn-delete-all").on('click',function(){
		var ids = new Array();
		$(".js-dataTable-full").find(".chk-item").each(function(key,val){
			if($(this).is(":checked"))
			ids.push($(this).val());
		});
		if(ids.length>0)
		{
			bootbox.confirm({
				title: "Delete sites?",
				message: "Do you want to delete this sites.",
				buttons: {
					cancel: {
						label: '<i class="fa fa-times"></i> Cancel'
					},
					confirm: {
						label: '<i class="fa fa-check"></i> Confirm'
					}
				},
				callback: function (result) {
					if(result)
					{
						var req = post('<?=site_url('buy-ref/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								smart_success_box(out.message,'#tbl-uses');
							}
							else
							{
								smart_error_box(out.message,'#tbl-uses');
							}
						});		
					}
				}
			});
		}else
		{
			bootbox.confirm({
				title: "Message",
				message: "Checklist Your Data!",
				buttons: {
					 
					confirm: {
						label: '<i class="fa fa-check"></i> Confirm'
					}
				},
				callback: function (result) {
					return;
				}
			});	
		}
	});
	$("#chk-items").on('click',function(){
		var chk = $(this).is(':checked');
		$(".js-dataTable-full").find(".chk-item").each(function(){
			$(this).prop('checked',chk);
		});
	});
	 
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
			var req = post('<?=site_url('buy-ref/status')?>',$("#frm-status").serialize());
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
	$(".status_pay").on("change",function()
	{
		
		var types = $(this).val();
		$(".hashed").addClass("xhide");
		if(types==1)
		{
			$(".hashed").removeClass("xhide");	
		}else
		{
			 
			
			$("#txhash_wallet").val();	
		}
	});
	/* == */
	$(".js-dataTable-full").on('click','.btn-tx',function(){
		var ids = $(this).data('ref');
		var txs = $(this).data('tx');
		if(ids!="")
		{
			$("#modaltx").find("#id").val(ids);
			$("#modaltx").find("#txhash_customer").val(txs);
			$("#modaltx").modal('show');
		}
	});
	$("#frm-tx").validate({
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
			var req = post('<?=site_url('buy-ref/updatetx')?>',$("#frm-tx").serialize());
			req.done(function(out){
				if(!out.error)
				{
					table_ajax.api().ajax.reload();
					smart_success_box(out.message,'#frm-tx .modal-body');
					$("#modaltx").modal('hide');
				}
				else
				{
					smart_message(out.message,'#frm-tx .modal-body');
				}
			});
			return false;
		}
	});
});
</script>