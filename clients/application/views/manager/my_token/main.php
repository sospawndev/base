<div class="content-wrapper">
   <div class="row">
           
        <!-- -->
         <div class="col-md-8">
                    <div class="card">
                    	<div class="card-header ">
                        	 My Token
                        </div>
                        <div class="card-body">
                        	 <div class="col-12 table-responsive"  >	   
                              <table class="table table-bordered table-striped js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="hidden-xs">Status</th> 
                                        <th class="hidden-xs">Type</th> 
                                        <th class="hidden-xs">Price</th>
                                        <th class="hidden-xs">Coin/Token Payment</th>
                                        <th class="hidden-xs">Token Received</th>
                                        <th class="hidden-xs">Admin Payment Address</th>
                                        <th class="hidden-xs">HASH/txid/Bukti Bank Payment</th>
                                        <th class="hidden-xs">My Wallet</th>
                                        
                                       
                                        
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                           </div> 	
                        </div>
                     </div>
         </div>  
         <div class="col-md-4">
			  <?php
                    include __DIR__."/../chunk/wallet.php";
                ?>
          </div>             
        <!-- -->     
    </div>
</div>                        
 <div id="modaltx" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="" method="post" id="frm-tx">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form TX Customer</h4>
      </div>
      <div class="modal-body">
       
        <div class="form-group  ">
        	<label>Txn Hash<br/>From Customer</label>
            <input type="text" class="form-control  "   name="txhash_customer" id="txhash_customer" placeholder="HASH Payment" />
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
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        table_ajax = $('.js-dataTable-full').dataTable({
			order:[],
			"processing": true, 
			"autoWidth": false,
			"serverSide": true, 
			"ajax": {
					url :"<?=site_url('my-token/getlist')?>",
					type : "GET",
					data : function(d){
						//d.id_supplier = $("#id_supplier").val();
						//d.id_category = $("#id_category").val();
						//d.id_subcategory = $("#id_subcategory").val();
					}
			 },
			columnDefs: [ 
			{ orderable: false, searchable:false, width:'150px', targets:[3]},
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
			var req = post('<?=site_url('my-token/updatetx')?>',$("#frm-tx").serialize());
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