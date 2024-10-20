<script src="assets/skodash/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<div class="row row-cols-1 row-cols-sm-3 row-cols-md-3 row-cols-xl-3 row-cols-xxl-12">     
             <div class="col">
                <div class="card radius-10 bg-success">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-1 bg-white text-black">
                      <i class="bx bx-book"></i>
                    </div>
                    <p class="mb-0 text-white">Task Approve</p>
                    <h5 class="mt-4 mb-0 text-white"> <?=number_format($task_total['total'],0)?></h5>
                     
                  </div>
                </div>
              </div>
             
             <div class="col">
                <div class="card radius-10 bg-primary">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-1 bg-white text-black">
                      <i class="bx bx-book"></i>
                    </div>
                    <p class="mb-0 text-white">Task Pending</p>
                    <h5 class="mt-4 mb-0 text-white"><?=number_format($wait_total['total'],0)?>  </h5>
                     
                  </div>
                </div>
              </div> 
              
             <div class="col">
                <div class="card radius-10 bg-warning">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-1 bg-white text-black">
                      <i class="bx bx-book"></i>
                    </div>
                    <p class="mb-0 text-white">Task Reject</p>
                    <h5 class="mt-4 mb-0 text-white"><?=number_format($reject_total['total'],0)?> </h5>
                     
                  </div>
                </div>
              </div>   
              
               
              
 </div>
 
 <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-xl-2 row-cols-xxl-12">     
             <div class="col">
                <div class="card radius-10 bg-info">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-1 bg-dark text-white">
                      <i class="bi bi-people"></i>
                    </div>
                    <p class="mb-0 text-white">Total Customer</p>
                    <h5 class="mt-4 mb-0 text-black"><?=$customer['total']?></h5>
                     
                  </div>
                </div>
              </div>
              
               <div class="col">
                <div class="card radius-10 bg-primary">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-1 bg-dark text-white">
                      <i class="bx bx-money"></i>
                    </div>
                    <p class="mb-0 text-white">Total Balance Customer</p>
                    <h5 class="mt-4 mb-0 text-black"><?=number_format($balance_total['total'],0)?></h5>
                     
                  </div>
                </div>
              </div>
 </div>               
 <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-xl-2 row-cols-xxl-12">     
             <div class="col">
                <div class="card radius-10 bg-warning">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-1 bg-white text-black">
                      <i class="bx bx-money"></i>
                    </div>
                    <p class="mb-0 text-white">Reward Task (<?=settings('coin_name')?>)</p>
                    <h5 class="mt-4 mb-0 text-black"><?=number_format($task_reward['total'],0)?></h5>
                     
                  </div>
                </div>
              </div>
               <div class="col">
                <div class="card radius-10 bg-success">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-1 bg-white text-black">
                      <i class="bx bx-money"></i>
                    </div>
                    <p class="mb-0 text-white">Reward Vote (<?=settings('coin_name')?>)</p>
                    <h5 class="mt-4 mb-0 text-black"><?=number_format($vote_reward['total'],0)?></h5>
                     
                  </div>
                </div>
              </div>
 </div>              

<div class="row">
                 
                 
                  
                      
                  <div class="col-12 col-lg-12 col-xl-12 d-flex">
                    <div class="card radius-10 w-100">
                      <div class="card-body">
                        <p>Task <span class="tahun_v"></span>
                        <span class="pull-right">
                           <a class="btn btn-small btn-sm btn-warning pull-right" href="javascript:void(0);" id="setting_room" style="color:white;"><i class="fa fa-gear"></i></a>
                              
                         </span> 
                        </p>
                        <div id="topups"></div>
                      </div>
                    </div>
                   </div>
                   
                  
</div>
<!-- modal tx -->
<div id="modal_setting" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="javascript:void(0);" method="post" id="frm-years">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">Year Setting</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<label>Year</label>
            <input type="number" class="form-control required"   name="tahun" id="year" value="<?=isset($_GET['year'])?$_GET['year']:date('Y')?>" placeholder="Year" />
        </div>
         
      </div>
      <div class="modal-footer">
      	 
        
      	<button type="submit" class="btn btn-primary">Process</button>
        <button type="button" class="btn btn-default"  data-bs-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>   
<script>
$(function()
{
	$("#setting_room").on("click",function()
	{
		$("#modal_setting").modal("show");
	});
	$("#frm-years").validate({
		ignore:[],
		errorClass: 'help-block text-right animated fadeInDown invalid-feedback',
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
			chart_year();
			return false;
		}
	});
	chart_year(); 
});
function chart_year()
 {
			//var data = new FormData($("#frm-years")[0]);
			var req = post('<?=site_url("home/charts")?>',$("#frm-years").serialize());
			req.done(function(out){
				if(!out.error)
				{
					$("#topups").html(""); 
					//charts_v(out.data);
					var ccharts = new Array();
					/*
					for(var i=0;i<out.data.length;i++)
					{
						ccharts.push(out.data[i]);
					}
					*/
					$.each(out.data,function(key,val)
					{
						ccharts.push(val.value);
					});
					console.log(ccharts);
					charts_v(ccharts);
					
					$(".years0").text($("#frm-years #year").val());
					$(".tahun_v").text($("#frm-years #year").val());
					$("#modal_setting").modal("hide");
					 
				}
				else
				{
					//bootbox.alert(out.message);
					 
				}
			}); 
 }
var chart;
 function charts_v(data_v)
 {
	var options = {
		series: [{
			name: "",
			data:  data_v }], //[0,0,0,0,0,0,"1","10","116","162","109","93"]    }],
		chart: {
			foreColor: '#9a9797',
			type: "bar",
			//width: 130,
			height: 280,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: 0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#3461ff"
			},
			sparkline: {
				enabled: 0
			}
		},
		markers: {
			size: 0,
			colors: ["#3461ff"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "55%",
				distributed: true,
				//endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		legend: {
			show: false
		  },
		stroke: {
			show: !0,
			width: 1.5,
			curve: "smooth"
		},
	   // colors: ["#3461ff"],
		xaxis: {
			categories: <?=json_encode(bulanall())?>    },
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				 
				formatter: function(value, series) {
				  // use series argument to pull original string from chart data
				   
				  return '<b>Total </b>:Rp. ' + parseFloat(value).toLocaleString();
				}
			},
			marker: {
				show: !1
			}
		}
	  };
	
	  var chart = new ApexCharts(document.querySelector("#topups"), options);
	  chart.render();	 
 }
</script>