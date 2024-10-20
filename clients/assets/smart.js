// JavaScript Document
/*var smart_loader = '<div class="modal" id="smart-loader" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">';
smart_loader +='<div class="modal-dialog modal-sm">';
smart_loader += '<div class="modal-content">';
smart_loader += '<div class="block block-themed block-transparent remove-margin-b">';
smart_loader += '<div class="block-header bg-primary-dark">';
smart_loader += '<h3 class="block-title"><i class="fa fa-2x fa-cog fa-spin text-warning"></i> <span>Processing . . .</span> </h3>';
smart_loader += '</div></div></div></div></div>';*/
var smart_loader = '<div class="modal" id="smart-loader" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">';
smart_loader +='<div class="modal-dialog modal-sm">';
smart_loader += '<div class="modal-content">';
smart_loader += ' <div class="card">';
smart_loader += '<div class="card-body">';
smart_loader += '<h4 class="card-title"><i class="fa fa-2x fa-cog fa-spin text-warning"></i> <span>Processing . . .</span> </h4>';
smart_loader += '</div></div></div></div></div>';

/*var smart_loader ='<div class="smart-loader" id="smart-loader" style="height:100%;width:100%;position:fixed;z-index:99999999;background-color:rgba(0, 0, 0, 0.5);">';
smart_loader +='                <div class="loader-animation" style="z-index:999999">>';
smart_loader +='					<svg class="loader">';
smart_loader +='	                    <circle cx="50" cy="50" r="46" class="c-2"></circle>';
smart_loader +='						<circle cx="50" cy="50" r="46" class="c-1"></circle>';
smart_loader +='                    </svg>';
smart_loader +='<span class="loader-logo"><img class="img-responsive" src="assets/img/lewatpasar-logo-icon.png" alt="Lewat Pasar"></span>';
smart_loader +='               </div>';
smart_loader +='        </div>';*/

/*var smart_loader = '<div class="modal fade" id="smart-loader">';
smart_loader+='         <div class="modal-dialog" role="document">';
smart_loader+='            <div class="modal-content">';
smart_loader+='               <div class="load-wrap">';
smart_loader+='                     <div class="loader-animation">';
smart_loader+='                  <svg class="loader">';
smart_loader+='                      <circle cx="50" cy="50" r="46" class="c-2"></circle>';
smart_loader+='                      <circle cx="50" cy="50" r="46" class="c-1"></circle>';
smart_loader+='                  </svg>';
smart_loader+='                  <span class="loader-logo"><img class="img-responsive" src="assets/img/lewatpasar-logo-icon.png" alt="Lewat Pasar"></span>';
smart_loader+='               </div>';
smart_loader+='               </div>';
smart_loader+='            </div>';
smart_loader+='         </div>';
smart_loader+='      </div>';
*/
var awalimage = "assets/img/avatar13.jpg";
String.prototype.rtrim = function (s) {
    if (s == undefined)
        s = '\\s';
    return this.replace(new RegExp("[" + s + "]*$"), '');
};
String.prototype.ltrim = function (s) {
    if (s == undefined)
        s = '\\s';
    return this.replace(new RegExp("^[" + s + "]*"), '');
};

$(document).on('ready',function(){
	smart_token_hash = $("#nd-meta-token").attr('content');
	smart_token_name = $("#nd-meta-token").attr('name');
	$('#smart-loader').on('hidden.bs.modal', function () {
		$(document).find("#smart-loader").remove();
	})
	reloadToken();
});
function loadSmartAnimation()
{
	$("#smart-page-loader").removeClass('hide');
	//$("#smart-loader").modal('show');
}
function unloadSmartAnimation()
{
	$("#smart-page-loader").addClass('hide');
	//$(document).find("#smart-loader").remove();
}
function reloadToken(token_sec)
{
	if(token_sec === undefined) {
       token_sec = smart_token_hash;
    }

	smart_token_hash = token_sec;
	$(document).find('.smart-token').each(function(){
		$(this).val(smart_token_hash);
		$(this).attr('content',smart_token_hash);
	});
}
function postFile(smart_url,smart_data)
{
	$(document).find('#smart-loader').on('hidden.bs.modal',function(){
		$(document).find('#smart-loader').remove();
	});
	return $.ajax({
		url: smart_url,
		type: 'POST',
		data: smart_data,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function(){
			$(smart_loader).appendTo('body');
	 		$("#smart-loader").modal('show');
			//loadSmartAnimation();
		},
		success: function(out)
		{
			/*if(typeof out.auth !=='undefined' && !out.auth)
			{
				document.location.reload();
			}*/
			reloadToken(out.security);
		},
		error: function()
		{
			generatetoken();
		},
		complete:function(){
			 $("#smart-loader").modal('hide');
			 //unloadSmartAnimation();
		}
	});
}
function get(smart_url,smart_data,smart_type)
{
	$(document).find('#smart-loader').on('hidden.bs.modal',function(){
		$(document).find('#smart-loader').remove();
	});
	smart_type = typeof smart_type !== 'undefined' ? smart_type : 'json';
	smart_data = typeof smart_data !== 'undefined' ? smart_data : {};
	return $.ajax({
	  type: "GET",
	  url: smart_url,
	  data: smart_data,
	  dataType: smart_type,
	  beforeSend: function(request){
		 request.setRequestHeader("Authority", smart_token_hash);
		 $(smart_loader).appendTo('body');
		 $("#smart-loader").modal('show');
		 //loadSmartAnimation();
	  },
	  error: function()
	  {
			generatetoken();
	  },
	  complete:function(){
		  $("#smart-loader").modal('hide');
		 //unloadSmartAnimation();
		 reloadToken();
	  }
	});
}
function post(smart_url,smart_data,smart_type)
{
	$(document).find('#smart-loader').on('hidden.bs.modal',function(){
		$(document).find('#smart-loader').remove();
	});
	smart_type = typeof smart_type !== 'undefined' ? smart_type : 'json';
	return $.ajax({
	  type: "POST",
	  url: smart_url,
	  data: smart_data,
	  dataType: smart_type,
	  beforeSend: function(){
		 $(smart_loader).appendTo('body');
		 $("#smart-loader").modal('show');
		//loadSmartAnimation();
	  },
	  success: function(out)
	  {
		 reloadToken(out.security);
	  },
	  error: function()
	  {
			generatetoken();
	  },
	  complete:function(){
		  $("#smart-loader").modal('hide');
		 //unloadSmartAnimation();
	  }
	});
}
function getfortoken(smart_url,smart_data,smart_type)
{
	$(document).find('#smart-loader').on('hidden.bs.modal',function(){
		$(document).find('#smart-loader').remove();
	});
	smart_type = typeof smart_type !== 'undefined' ? smart_type : 'json';
	smart_data = typeof smart_data !== 'undefined' ? smart_data : {};
	return $.ajax({
	  type: "GET",
	  url: smart_url,
	  data: smart_data,
	  dataType: smart_type,
	  beforeSend: function(request){
		 request.setRequestHeader("Authority", smart_token_hash);
		 $(smart_loader).appendTo('body');
		 $("#smart-loader").modal('show');
	  },
	  success: function(out)
	  {
			/*if(typeof out.auth !=='undefined' && !out.auth)
			{
				document.location.reload();
			}*/
			
		    reloadToken(out.security);
	  },
	  complete:function(out){
		  $("#smart-loader").modal('hide');
		  
	  }
	});
}
function generatetoken()
{
	return getfortoken("manager/login/token",{id:0},"json");
}
function deletemany(url,data,callback)
{
	$(document).find('#smart-delete').on('hidden.bs.modal',function(){
		$(document).find('#smart-delete').remove();
	});
	$(document).find('#smart-delete-rem').on('hidden.bs.modal',function(){
		$(document).find('#smart-delete-rem').remove();
	});
	if(data.length==0)
	{
		var str = '<div class="modal fade modal-danger" id="smart-delete-rem" tabindex="-1" role="dialog">';
			 str = str + '<div class="modal-dialog">';
			 str = str + '<div class="modal-content">';
			 str = str + '<div class="modal-body">';
			 str = str + '<p align="center"><strong>Please Select Record To Delete...</strong></p> ';
			 str = str + '</div><div class="modal-footer">';
			 str = str + '<button data-dismiss="modal" class="btn btn-sm btn-primary" type="button">Ok</button>';
			 str = str + '</div></div></div></div>';
			 $(str).appendTo('body');
			 $("#smart-delete-rem").modal('show');
		return false;
	}
	 var str = '<div class="modal fade modal-warning" id="smart-delete" tabindex="-1" role="dialog">';
	 str = str + '<div class="modal-dialog">';
	 str = str + '<div class="modal-content">';
	 str = str + '<div class="modal-body">';
	 str = str + '<p align="center"><strong>Are You Sure To Delete This Record?</strong></p> ';
	 str = str + '</div><div class="modal-footer">';
	 str = str + '<button data-dismiss="modal" class="btn btn-sm btn-default" type="button">Cancel</button>';
	 str = str + '<button id="smart-delete-ok-button" onclick="deleteprocess(\''+url+'\',\''+data+'\','+callback+');"  class="btn btn-sm btn-primary" type="button">Ok</button>';
	 str = str + '</div></div></div></div>';
	 $(str).appendTo('body');
	 $("#smart-delete").modal('show');
}
function deleteprocess(url,data,callback)
{
	
	$(document).find('#smart-delete-danger').on('hidden.bs.modal',function(){
		$(document).find('#smart-delete-danger').remove();
	});
	$("#smart-delete").modal('hide');
	eval("var datatosubmit = {keys:["+data+"],"+smart_token_name+":smart_token_hash}");
	var req = post(url,datatosubmit);
	req.done(function(out){
		var req_token = smart_reloadtoken();
		req_token.done(function(){
			if(out.error)
			{
				 var str = '<div class="modal fade modal-danger" id="smart-delete-danger" tabindex="-1" role="dialog">';
				 str = str + '<div class="modal-dialog">';
				 str = str + '<div class="modal-content">';
				 str = str + '<div class="modal-body">';
				 str = str + '<p align="center"><strong>'+out.message+'</strong></p> ';
				 str = str + '</div><div class="modal-footer">';
				 str = str + '<button data-dismiss="modal" class="btn btn-outline" type="button">Ok</button>';
				 str = str + '</div></div></div></div>';
				 $(str).appendTo('body');
				 $("#smart-delete-danger").modal('show');
			}
			else
			{
				callback();
			}
		});
	});
}


//smart success box
function smart_success_box(message,container)
{
	$(container).find(".smart-success-box").remove();
	var str =  '<div class="alert alert-success alert-dismissable smart-success-box"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="fa fa-check"></i> '+message+'</p></div>';
	$(str).prependTo(container);
}
//smart success box
function smart_error_box(message,container)
{
	$(container).find(".smart-error-box").remove();
	var str =  '<div class="alert alert-danger alert-dismissable smart-error-box"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="fa fa-warning"></i> '+message+'</p></div>';
	$(str).prependTo(container);
}

function copyToClipboard(elem,prefix) {
	  // create hidden text element, if it doesn't already exist
	prefix = typeof prefix !== 'undefined' ? prefix : '';
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
function clear_ckeditor()
{
	for( instance in CKEDITOR.instances ){
			CKEDITOR.instances[instance].setData('');
	}	
}
function update_ckeditor()
{
	for( instance in CKEDITOR.instances ){
			CKEDITOR.instances[instance].updateElement()
	}	
}
function clear_ckeditor()
{
	for( instance in CKEDITOR.instances ){
			CKEDITOR.instances[instance].setData('');
	}	
}
function update_ckeditor()
{
	for( instance in CKEDITOR.instances ){
			CKEDITOR.instances[instance].updateElement()
	}	
}
function openFile(file) {
    var extension = file.substr( (file.lastIndexOf('.') +1) );
    switch(extension) {
        case 'jpg':
        case 'png':
        case 'gif':                    // the alert ended with pdf instead of gif.
        case 'zip':
        case 'rar':
        case 'pdf':
			return extension;
        break;
        default:
            return '';
    }
};

function UpdateQueryString(key, value, url) {
	if (!url) url = window.location.href;
	var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
		hash;
	
	if (re.test(url)) {
		if (typeof value !== 'undefined' && value !== null)
			return url.replace(re, '$1' + key + "=" + value + '$2$3');
		else {
			hash = url.split('#');
			url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
			if (typeof hash[1] !== 'undefined' && hash[1] !== null) 
				url += '#' + hash[1];
			return url;
		}
	}
	else {
		if (typeof value !== 'undefined' && value !== null) {
			var separator = url.indexOf('?') !== -1 ? '&' : '?';
			hash = url.split('#');
			url = hash[0] + separator + key + '=' + value;
			if (typeof hash[1] !== 'undefined' && hash[1] !== null) 
				url += '#' + hash[1];
			return url;
		}
		else
			return url;
	}
}
function clear_ckeditor()
{
	for( instance in CKEDITOR.instances ){
			CKEDITOR.instances[instance].setData('');
	}	
}
function update_ckeditor()
{
	for( instance in CKEDITOR.instances ){
			CKEDITOR.instances[instance].updateElement()
	}	
}
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#renderImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function smart_message(pesan)
{
  $(document).find('#smart-loader').on('hidden.bs.modal',function(){
		$(document).find('#smart-loader').remove();
  });
  $("#smart-message").remove();
  var str = '<div class="modal fade modal-danger" id="smart-message" tabindex="-1" role="dialog">';
  str = str + '<div class="modal-dialog">';
  str = str + '<div class="modal-content">';
  str = str + '<div class="modal-body">';
  str = str + '<p align="center"><strong>'+pesan+'</strong></p> ';
  str = str + '</div><div class="modal-footer">';
  str = str + '<button data-dismiss="modal" class="btn btn-outline" type="button">Ok</button>';
  str = str + '</div></div></div></div>';
  $(str).appendTo('body');
  $("#smart-message").modal('show');		
}