<div class="content-wrapper">
   <div class="row">
           
        <!-- -->
         <div class="col-md-8">
                    <div class="card">
                    	<div class="card-header ">
                        	 My Referral
                        </div>
                        <div class="card-body">
                        	 <div class="col-12 table-responsive"  >	   
                              <table class="table table-bordered table-striped js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="hidden-xs">Name</th> 
                                        <th class="hidden-xs">Telegram id</th>
                                        <th>Total Payment(usdt)</th>
                                        <th>Total Reward XOME</th> 
                                        <th>Total Reward USDT</th> 
                                        <th>Token <br/> From Buy XOME </th> 
                                        <th>Bonus  <br/> From Buy XOME </th> 
                                        <th>(Token+Bonus)  <br/> From Buy XOME </th> 
                                        
                                       
                                        
                                         
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
					url :"<?=site_url('refferal/getlist')?>",
					type : "GET",
					data : function(d){
						//d.id_supplier = $("#id_supplier").val();
						//d.id_category = $("#id_category").val();
						//d.id_subcategory = $("#id_subcategory").val();
					}
			 },
			columnDefs: [ 
			 
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
	 
});
</script>