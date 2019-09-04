 //选择图片
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
 $(function () {
     $('#submitbut').click(function () {
         $('#CarAdd_action').submit();
     })
 })