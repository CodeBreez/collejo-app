var Collejo=Collejo||{settings:{alertInClass:"bounceInDown",alertOutClass:"fadeOutUp"},templates:{},form:{},link:{},modal:{}};Collejo.ajaxComplete=function(e,a,t){var o,l,n,i=0;try{i=$.parseJSON(a.responseText)}catch(d){}if(l=0==i?a.status:i,403!=l&&401!=l||Collejo.alert("danger","You are not authorized to perform this action",1e3),0!=l&&null!=l){var o=void 0!=l.code?l.code:0;if(0==o&&(void 0!=i.data&&void 0!=i.data.redir&&(null!=i.message&&(Collejo.alert(i.success?"success":"warning",i.message+". redirecting&hellip;",1e3),n=0),setTimeout(function(){window.location=i.data.redir},n)),void 0!=i.message&&null!=i.message&&i.message.length>0&&void 0==i.data.redir&&Collejo.alert(i.success?"success":"warning",i.message,3e3),void 0!=i.data&&void 0!=i.data.errors)){var s="<strong>Validation failed</strong> Please correct them and try again <br/>";$.each(i.data.errors,function(e,a){$.each(a,function(e,a){s=s+a+"<br/>"})}),Collejo.alert("warning",s,5e3)}}$(window).resize()},$(function(){Collejo.templates.spinnerTemplate=function(){return $('<span class="spinner-wrap"><span class="spinner"></span></span>')},Collejo.templates.alertTemplate=function(e,a,t){return $('<div class="alert alert-'+e+" "+(t!==!1?"alert-dismissible":"")+'" role="alert">'+(t!==!1?'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>':"")+a+"</div>")},Collejo.templates.alertWrap=function(){return $('<div id="alert-wrap"></div>')},Collejo.templates.alertContainer=function(){return $('<div class="alert-container"></div>')},Collejo.templates.ajaxLoader=function(){return null},Collejo.alert=function(e,a,t){var o=Collejo.templates.alertWrap(),l=Collejo.templates.alertContainer();o.css({position:"fixed",top:0,width:"100%",height:0}),l.css({width:"400px",margin:"0 auto"}),o.append(l);var n=Collejo.templates.alertTemplate(e,a,t);0==$("#alert-wrap").length&&$("body").append(o);var l=$("#alert-wrap").find(".alert-container");t===!1&&l.empty(),n.appendTo(l).addClass("animated "+Collejo.settings.alertInClass),t>0&&window.setTimeout(function(){n.removeClass(Collejo.settings.alertInClass).addClass(Collejo.settings.alertOutClass).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){n.remove()})},t)},Collejo.form.lock=function(e){$(e).find('button[type="submit"]').attr("disabled",!0).append(Collejo.templates.spinnerTemplate())},Collejo.form.unlock=function(e){$(e).find('button[type="submit"]').attr("disabled",!1).find(".spinner-wrap").remove()},Collejo.getView=function(e,a){$.ajax({dataType:"json",url:e,cache:!1,success:a})},Collejo.link.ajax=function(e){e.attr("disabled",!0).append(Collejo.templates.spinnerTemplate()),Collejo.getView(e.attr("href"),function(a){a.success&&(e.data("target")?$("#"+e.data("target")).empty().append(a.data.html):e.replaceWith(a.data.html))})},Collejo.modal.open=function(e){var a=null!=e.data("modal-id")?e.data("modal-id"):"ajax-modal"+moment(),t=null!=e.data("modal-size")?" modal-"+e.data("modal-size")+" ":"",o=null!=e.data("modal-backdrop")?e.data("modal-backdrop"):!0,l=null!=e.data("modal-keyboard")?e.data("modal-keyboard"):!0,n=$('<div id="'+a+'" class="modal fade loading" role="dialog" aria-labelledby="'+a+'" aria-hidden="true"><div class="modal-dialog'+t+'"></div></div>'),i=this.templates.ajaxLoader;null!=i&&i.appendTo(n),$("body").append(n),n.on("show.bs.modal",function(){$.ajax({url:e.attr("href"),type:"get",success:function(e){void 0==e.success&&(n.find(".modal-dialog").html(e),n.removeClass("loading"),null!=i&&i.remove())}})}).on("hidden.bs.modal",function(){$(this).remove()}).modal({backdrop:o,keyboard:l})},Collejo.modal.close=function(e){$("body").find(e).closest(".modal").modal("hide").remove()},$(document).ajaxComplete(Collejo.ajaxComplete),$(document).on("click",'[data-toggle="ajax-link"]',function(e){e.preventDefault(),Collejo.link.ajax($(this))}),$(document).on("click",'[data-toggle="ajax-modal"]',function(e){e.preventDefault(),Collejo.modal.open($(this))}),$(document).on("click",'[data-toggle="ajax-modal"]',function(e){e.preventDefault(),Collejo.modal.open($(this))})}),$.ajaxSetup({headers:{"X-CSRF-Token":$('meta[name="token"]').attr("content")}});