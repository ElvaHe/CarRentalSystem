$(function(){
	$(":text").css({'border':'0','color':'black','text-indent':'1px'});
	$(":text").attr('disabled','disabled');
	$('#returnbut').click(function () {
		window.location="/Car/CarPage";
	})
	$('#modifybut').click(function(){
		$(":text").css({'border':'1','color':'black','text-indent':'1px'});
		$(":text").css('backgroundColor','#FAFFBD');
		$(":text").css('border-color','#bebedf');
		$(":text").css('border-style','dashed');
		$(":text").removeAttr('disabled');
		$('#modifybut').css('visibility','hidden');
		$('#submitbut').css('visibility','visible');
		$('html, body').animate({scrollTop:50}, 'slow');
		
	})
	$('#submitbut').click(function () {
		$('#CarModify_action').submit();
	})
//	$('#submitbut').click(function(){
//	         $('.subNav').css('background','blue');
//	         
//})

})
function preview(file){  
         var prevDiv = document.getElementById('preview');  
         if (file.files && file.files[0]){  
         var reader = new FileReader();  
         reader.onload = function(evt){  
         prevDiv.innerHTML = '<img src="' + evt.target.result + '" width="200xp" height="130px"/>';  
        }  
         reader.readAsDataURL(file.files[0]);  
        }
    }  
