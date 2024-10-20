<div class="content-wrapper">
   <div class="row">
            <div class="col-lg-5">
                    <div class="card">
                    	<div class="card-header  ">
                        	<?=$title?> Form
                        </div>
                        <div class="card-body">
                        	 <form action="" method="post" id="frm-object">
                                  <div class="col-12 ">	
                                  	<!-- -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control required" name="name" id="name"> 
                                    </div>
                                    
                                     
                                      
                                    
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                        <input type="hidden" name="id" id="id" />
                                       
                                        <button type="button" class="btn btn-default" id="btn-reset"><i class="fa fa-refresh"></i> Reset</button>
                                    </div>	
                                    <!-- -->
                                  </div>
                             </form> 
                         </div> 
                    </div>
             </div>
        <!-- -->
         <div class="col-md-7">
                    <div class="card">
                    	<div class="card-header ">
                        	List
                        </div>
                        <div class="card-body">
                        	 <div class="col-12 table-responsive">	 
                              <table class="table table-bordered table-striped js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="hidden-xs" style="width: 50%;">Name</th>
                                        
                                        <th class="hidden-xs" style="width: 10%;">Display</th> 
                                        <th class="text-center" style="width: 20%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>	
                            </div>
                        </div>
                     </div>
         </div>               
        <!-- -->     
    </div>
</div>                 
<script>
var table_ajax;
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        table_ajax = $('.js-dataTable-full').dataTable({
			order:[],
			"processing": true, 
			"autoWidth": false,
			"serverSide": true, 
			"ajax": {
					url :"<?=site_url('education_level/getlist')?>",
					type : "GET",
					data : function(d){
						//d.id_supplier = $("#id_supplier").val();
						//d.id_category = $("#id_category").val();
						//d.id_subcategory = $("#id_subcategory").val();
					}
			 },
			columnDefs: [ 
			{ orderable: false, width:'80px', targets:[2]}, 
			{ orderable: false, visible:false, width:'80px', targets:[0]},
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
	 
	$("#frm-object").validate({
		ignore:[],
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
		rules:{
			sites_logo_s:{
				extension:"jpg|png"
			}
		},
		submitHandler:function(){
			var obj = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url('education_level/save')?>',obj);
			req.done(function(out){
				if(!out.error)
				{
					table_ajax.api().ajax.reload();
					smart_success_box(out.message,'#frm-object');
					document.location.href=window.location;
					//$("#btn-reset").trigger('click');
					
				}
				else
				{
					smart_error_box(out.message,'#frm-object');
				}
			});
			return false;
		}
	});
	$('body').tooltip({selector: '[data-toggle="tooltip"]'});
	$(".js-dataTable-full").on('click','.btn-edit-sites',function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			var req = post('<?=site_url('education_level/match')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
			req.done(function(out){
				if(!out.error)
				{
					$("#id").val(out.data.id);
					$("#name").val(out.data.name);
					$("#type").val(out.data.type).trigger('change');  
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
		}
	});
	$(".js-dataTable-full").on('click','.btn-delete-sites',function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Delete data?",
				message: "Do you want to delete this data.",
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
						var req = post('<?=site_url('education_level/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								smart_success_box(out.message,'#tbl-uses');
								document.location.href=window.location;
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
	$("#btn-reset").on('click',function(){
		$("#frm-object")[0].reset();
		reloadToken();
		$("#container-logo").text('');
		$("#close_order").val(1).trigger('change');
		$("#id").val('');
	});
	$("#btn-delete-all").on('click',function(){
		var ids = new Array();
		$(".js-dataTable-full").find(".chk-item").each(function(key,val){
			if($(this).is(':checked'))
			ids.push($(this).val());
		});
		if(ids.length>0)
		{
			bootbox.confirm({
				title: "Delete data?",
				message: "Do you want to delete this data.",
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
						var req = post('<?=site_url('education_level/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
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
	$("#frm-object").on('click','#btn-delete-logo',function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Delete data logo?",
				message: "Do you want to delete this Image.",
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
						var req = post('<?=site_url('education_level/delete-logo')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								$("#container-logo").text('');
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
		return false;
	});
	$("#close_order").select2();
	$(".js-dataTable-full").on('click','.btn-checked',function(){
		var ids = $(this).data('ref');
		var checks = $(this).data('check');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Display ?",
				message: "Do you want to .",
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
						var req = post('<?=site_url('education_level/displays')?>',{id:ids,"displays":checks,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								smart_success_box(out.message,'#tbl-uses');
								document.location.href=window.location;
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
	 
	$("#type").select2(); 
});
</script>

       
 
