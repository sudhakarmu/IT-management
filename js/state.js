function ajaxCall(){this.send=function(data,url,method,success,type){type=type||'json';var successRes=function(data){success(data);}
var errorRes=function(e){}
jQuery.ajax({url:url,type:method,data:data,success:successRes,error:errorRes,dataType:type,timeout:60000});}}
function locationInfo(){var rootUrl="//geodata.solutions/api/api.php";var username='demo';var ordering='name';var addParams='';if(jQuery("#gds_appid").length>0){addParams+='&appid='+jQuery("#gds_appid").val();}
if(jQuery("#gds_hash").length>0){addParams+='&hash='+jQuery("#gds_hash").val();}
var call=new ajaxCall();this.confCity=function(id){var url=rootUrl+'?type=confCity&countryId='+jQuery('#countryId').val()+'&stateId='+jQuery('#stateId option:selected').attr('stateid')+'&cityId='+id;var method="post";var data={};call.send(data,url,method,function(data){if(data){}
else{}});};this.getCities=function(id){jQuery(".cities option:gt(0)").remove();var stateClasses=jQuery('#cityId').attr('class');var cC=stateClasses.split(" ");cC.shift();var addClasses='';if(cC.length>0)
{acC=cC.join();addClasses='&addClasses='+encodeURIComponent(acC);}
var url=rootUrl+'?type=getCities&countryId='+jQuery('#countryId').val()+'&stateId='+id+addParams+addClasses;var method="post";var data={};jQuery('.cities').find("option:eq(0)").html("Please wait..");call.send(data,url,method,function(data){jQuery('.cities').find("option:eq(0)").html("Select City");if(data.tp==1){if(data.hits>1000)
{}
else
{}
var listlen=Object.keys(data['result']).length;if(listlen>0)
{jQuery.each(data['result'],function(key,val){var option=jQuery('<option />');option.attr('value',val).text(val);jQuery('.cities').append(option);});}
else
{var usestate=jQuery('#stateId option:selected').val();var option=jQuery('<option />');option.attr('value',usestate).text(usestate);option.attr('selected','selected');jQuery('.cities').append(option);}
jQuery(".cities").prop("disabled",false);}
else{}});};this.getStates=function(id){jQuery(".states option:gt(0)").remove();jQuery(".cities option:gt(0)").remove();var stateClasses=jQuery('#stateId').attr('class');var cC=stateClasses.split(" ");cC.shift();var addClasses='';if(cC.length>0)
{acC=cC.join();addClasses='&addClasses='+encodeURIComponent(acC);}
var url=rootUrl+'?type=getStates&countryId='+id+addParams+addClasses;var method="post";var data={};jQuery('.states').find("option:eq(0)").html("Please wait..");call.send(data,url,method,function(data){jQuery('.states').find("option:eq(0)").html("Select State");if(data.tp==1){if(data.hits>1000)
{}
else
{}
jQuery.each(data['result'],function(key,val){var option=jQuery('<option />');option.attr('value',val).text(val);option.attr('stateid',key);jQuery('.states').append(option);});jQuery(".states").prop("disabled",false);}
else{}});};}
jQuery(function(){var loc=new locationInfo();var coid=jQuery("#countryId").val();loc.getStates(coid);jQuery(".states").on("change",function(ev){var stateId=jQuery("option:selected",this).attr('stateid');if(stateId!=''){loc.getCities(stateId);}
else{jQuery(".cities option:gt(0)").remove();}});jQuery(".cities").on("change",function(ev){var cityId=jQuery("option:selected",this).val();if(cityId!=''){loc.confCity(cityId);}});});