$(function(){
	$('html, body').animate({scrollTop:100}, 'slow');
	$('#sendemailBut').click(function () {
		$('#Emailsend_form').submit();
	})
})


/*通过按钮查找用户*/
function  searchBut() {
	var reg = $(".chooseSel").val();
	var searchCon = $("#searchInput").val();
	if(reg=="请选择您要查询的方式"){
		alert('查询方式不能为空，请选择您的查询方式');
		return false;
	}
	if(searchCon==""){
		alert('查询内容不能为空，请重新输入您的查询内容');
		return false;
	}

	$.ajax({
		type: "POST",
		url: "/User/Search_action",
		dataType: "json",
		data: {"reg":reg,"searchCon":searchCon},
		success: function(json){
			if(json.success==0){
				alert("该用户不存在！");
				$("#searchInput").focus();
			}
			if(json.success==1){
				$('.Email-tr').remove();
				$('.Email-none').css('display','block');
				$('#email-none-one').html(json.mem_name);
				$('#email-none-two').html(json.mem_email);
				$('#email-none-three').html(json.mem_nickname);
				// $('#td-four').bind('click',searchIfo(json.mem_id));
				// $('#td-four').css('color','#F09B22');
				// $("#td-four").mousedown(function(){
				// 	$('html, body').animate({scrollTop:0}, 'slow');
				// });
				// $('#td-five').click(function () {
				// 	window.location.href='/Order/Mem_search?Mem_Name='+json.mem_name+'';
				// })
			}
		}
	})
}