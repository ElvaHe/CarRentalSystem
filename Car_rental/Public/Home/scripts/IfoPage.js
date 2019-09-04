 $whichModel = location.hash;
$(function () {
	$('#IfoChaMes input').attr("disabled","disabled");
	if($whichModel == "#orderAll"){
		$('.zc-Ifo-RightBox2').css('visibility','hidden');
		$('.zc-Ifo-RightBox').css('visibility','visible');
	}
	if($whichModel == "#orderSuc"){
		$('.zc-Ifo-RightBox').css('visibility','hidden');
		$('.zc-Ifo-RightBox2').css('visibility','hidden');
		$('#IfoOrdSuc').css('visibility','visible');
	}
	if($whichModel == "#orderRun"){
		$('.zc-Ifo-RightBox').css('visibility','hidden');
		$('.zc-Ifo-RightBox2').css('visibility','hidden');
		$('#IfoOrdRun').css('visibility','visible');
	}
	if($whichModel == "#orderAlr"){
		$('.zc-Ifo-RightBox').css('visibility','hidden');
		$('.zc-Ifo-RightBox2').css('visibility','hidden');
		$('#IfoOrdAlr').css('visibility','visible');
	}
	if($whichModel == "#orderCan"){
		$('.zc-Ifo-RightBox').css('visibility','hidden');
		$('.zc-Ifo-RightBox2').css('visibility','hidden');
		$('#IfoOrdCan').css('visibility','visible');
	}
	if($whichModel == "#orderMes"){
		$('.zc-Ifo-RightBox').css('visibility','hidden');
		$('.zc-Ifo-RightBox2').css('visibility','hidden');
		$('#IfoChaMes').css('visibility','visible');
	}
	/*点击修改按钮的事件*/
	$('#modify').click(function () {
		$('#modify').css('visibility','hidden');
		$('#submitbut').css('visibility','visible');
		$('#IfoChaMes input').removeAttr("disabled");
	})
	$('#submitbut').click(function () {
		$('#myMes').submit();
	})
})
function choose(obj,$key){
	  $('.Ifo-dl-a').css('color','#93939e');
	  $('.zc-Ifo-RightBox').css('visibility','hidden');
	  $('.zc-Ifo-RightBox2').css('visibility','hidden');
	  $('#'+$key).css('visibility','visible');
      obj.style.color="#fabe00";
}
