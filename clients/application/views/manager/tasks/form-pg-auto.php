<style type="text/css">
.pay-option-label.xaddress
{
	background-color:#ccc;
}
#qrcode img
{
	text-align:center;
	padding-left: 35%;	
}
.tflex {
  display: flex;
  padding: 5px;
}
.bank-group
{
	cursor:pointer;	
}
@media only screen and (max-width: 600px) {
    #qrcode img
	{
		text-align:center;
		padding-left: 5%;	
	}
}
</style>
			<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Task</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?=site_url("home")?>"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="<?=site_url("tasks/add")?>">Create</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment</li>
                                <li class="breadcrumb-item active" aria-current="page">Auto Process</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							 
						</div>
					</div>
				</div>
                
                <!-- -->
               <form action="javascript:void(0);" method="post" id="frm-object"> 
                <div class="row">
					
                    <div class="col-xl-12 mx-auto">
						
                        <h6 class="mb-0 text-uppercase">Payment Gateway</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									  
                                   <!-- -->
                                   <table class="table align-middle ">
                                   	<tbody>
                                    	  
                                                
                                          <tr>
                                            <td class="text-center">
                                            	<p id="timesx" style="float:right;">Expired in : <span id="timerx" class="alert alert-warning"></span></p>
                                            	<h5>Please Pay To This Address For Process</h5>
                                                <hr/>
                                                Payment Address
                                                <div id="qrcode" style=""></div>
                                                <hr/>
                                                <p>
                                                	Bank : <?=$data['name']?>
                                                 	<br/>
                                                	Virtual Account : xxxxx
                                                     
                                                </p>
                                             </td>
                                           </tr>
                                            
                                    </tbody>
                                   </table>
                                   <!-- -->   
                                      
								</div>
							</div>
						</div>
                       </div> 
                         <!-- -->
                         
                          
               </div>
              
                     
             </div>  
             </form>            
                
                <!-- -->
<script>
var data_task_payment = [];
$(document).ready(function(){
	countdown( "timerx", 60, 0 );
	new QRCode(document.getElementById("qrcode"), "xxxxx");	
	$("#frm-object").validate({
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
			var data = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url("tasks/save_manual")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					bootbox.alert({
                                message: 'Thank You! For Your Payment',
                                callback: function () {
                                			smart_success_box(out.message,'#frm-object .card-body');
											document.location.href="<?=site_url('tasks')?>";
                               		 }
                                });
					
				}
				else
				{
					smart_error_box(out.message,'#frm-object .card-body');
				}
			});
			return false;
		}
	});
	$("#btn-upload").click(function(){
		$("#avatar").trigger('click');
	});
	$("#avatar").change(function(){
		$("#avatar_s").val($(this).val());
	});
	$("#delete-avatar").click(function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Delete icon?",
				message: "Do you want to delete this icon.",
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
						var req = post('<?=site_url('currency/delete-icon')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								smart_success_box(out.message,'#frm-object .card-body');
								$("#avatar_container").remove();
							}
							else
							{
								smart_error_box(out.message,'#frm-object .card-body');
							}
						});		
					}
				}
			});
		}
		return false;
	});  
	$("#id_task_type").select2();
	$("#id_task_payment").select2();
	//getcoins();
	$("#id_task_type").change(function()
	{
		var ids = $(this).val();
		gettask_payment(ids);
	});
	$("#id_task_payment").change(function()
	{
		var ids = $(this).val();
		$.each(data_task_payment,function(key,val){
			 if(val.id==ids)
			 {
				$("#prices").val(val.rprices);	 
			 }
		 }); 
		 $(".step3").removeClass("xhide");
	});
	
});


function gettask_payment(ids)
{
	var req = post('<?=site_url('tasks/gettask_payment')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
	req.done(function(out){
		if(!out.error)
		{
			data_task_payment = out.data;
			var uys = '';
			$("#id_task_payment").html("");
			$("#id_task_payment").html('<option value=""  > -- choose --</option>'); 
			$.each(out.data,function(key,val){
				 
				$("#id_task_payment").append("<option value='"+val.id+"'>"+val.jumlah+"</option>");
		    });
			
			$("#id_task_payment").trigger('change.select2');
			$("#id_task_payment").val(uys).trigger('change');
			$(".step3").addClass("xhide");
			$(".step2").removeClass("xhide");
		}
		else
		{
			smart_error_box(out.message,'#frm-object .card-body');
		}
	});		
}
function countdown( elementName, minutes, seconds )
{
    var element, endTime, hours, mins, msLeft, time;

    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
        msLeft = endTime - (+new Date);
        if ( msLeft < 1000 ) {
            element.innerHTML = "countdown's over!";
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }

    element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}


</script>                
<style type="text/css">
.select2-container
{
	width:100% !important;	
}
</style>