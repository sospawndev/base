<div class="row">
	<div class="col-md-5">
    	<div class="card">
        	<div class="card-header">
            	Form Vote Category
            </div>
            <form action="" method="post" id="frm-object">
            <div class="card-body">
            	 
            	<div class="form-group">
                	<label>Name</label>
                    <input type="text" class="form-control required" name="name" id="no_rekening"> 
                </div>
                  <div class="form-group">
                    	<label>Images</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="img-container" placeholder="Image" id="img-container">
                          <span class="input-group-btn">
                          	<input type="file" class="hide" style="display:none" id="image" name="image"  />
                            <button class="btn btn-secondary" type="button" id="btn-upload"><i class="fa fa-upload"></i></button>
                          </span>
                        </div>
                        
                     </div>
                
                <hr>
                <div class="form-group">
                	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    <input type="hidden" name="id" id="id" />
                    
                    <button type="button" class="btn btn-default" id="btn-reset"><i class="fa fa-refresh"></i> Reset</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
    	<div class="card">
        	<div class="card-header">
               List
            </div>
            <div class="card-body" id="tbl-uses">
                <div class="col-12 table-responsive">		
                    <table class="table table-bordered table-striped js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" id="chk-all" /></th>
                                <th class="hidden-xs">Images</th>
                                <th class="hidden-xs">Name</th>
                                <th class="hidden-xs" style="width: 10%;">Display</th> 
                                
                                <th class="text-center" style="width: 10%;">Actions</th>
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
					url :"<?=site_url('votes/vote_category/getlist')?>",
					type : "GET",
					data : function(d){
						//d.id_supplier = $("#id_supplier").val();
						//d.id_category = $("#id_category").val();
						//d.id_subcategory = $("#id_subcategory").val();
					}
			 },
			columnDefs: [ 
			{ orderable: false, searchable:false,visible:false, targets: [ 0 ],className:'text-center',width:'50px' },
			
			{ orderable: false, searchable:false, targets: [ 0,3 ],className:'text-center' },
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
			'img-container':{
				extension:"jpg|png"
			}
		},
		messages:{
			'img-container':{
				extension : "Extenstion file invalid (eq : jpg, png)"
			}
		},
		submitHandler:function(){
			var formdata = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url('votes/vote_category/save')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					table_ajax.api().ajax.reload();
					smart_success_box(out.message,'#frm-object .block-content');
					$("#btn-reset").trigger('click');
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
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
			var req = post('<?=site_url('votes/vote_category/match')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
			req.done(function(out){
				if(!out.error)
				{
					$("#id").val(out.data.id);
					$("#name").val(out.data.no_rekening);
					$("#img-container").val(out.data.images);
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
				title: "Delete city?",
				message: "Do you want to delete this city.",
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
						var req = post('<?=site_url('votes/vote_category/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
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
	$("#btn-reset").on('click',function(){
		$("#frm-object")[0].reset();
		reloadToken();
		$("#container-logo").text('');
		$("#id").val('');
		$("#id_province").val('').trigger('change');
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
				title: "Delete city?",
				message: "Do you want to delete this city.",
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
						var req = post('<?=site_url('votes/vote_category/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
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
	$("#chk-all").on('click',function(){
		var chk = $(this).is(':checked');
		$(".js-dataTable-full").find(".chk-item").prop('checked',chk);
	});
	$("#id_bank").select2({
		allowClear: true,
	    placeholder: "Select an bank"
	});
	$("#id_bank").val('').trigger('change');
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
						var req = post('<?=site_url('vote-category/displays')?>',{id:ids,"displays":checks,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
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
				 
		$("#id").val('');
				 
	});
	$("#btn-upload").on('click',function(){
		$("#image").trigger('click');
	});
	$("#image").on('change',function(){
		$("#img-container").val($(this).val());
	});
});
</script>