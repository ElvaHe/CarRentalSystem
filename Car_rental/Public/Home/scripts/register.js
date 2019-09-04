function checkEmail(){
  $email=$("#email").val();
  var reg=/^\w+@\w+(\.[a-zA-Z]{2,3}){1,2}$/;	
    if(reg.test($email)==false){
	  document.getElementById("emailcheck_tips").style.visibility="visible";
	  return false;
	  }
    else{
	    document.getElementById("emailcheck_tips").style.visibility="hidden";
	    return true;
	  }
}

function checkUser(){
  $user=$("#xname").val();
  var reg=/^[a-zA-Z][a-zA-Z0-9]{3,15}$/;	
    if(reg.test($user)==false){
	  document.getElementById("usercheck_tips").style.visibility="visible";
	  return false;
	  }
    else{
	    document.getElementById("usercheck_tips").style.visibility="hidden";
	    return true;
	  }
}


function checkPwd(){
   $pwd=$("#passwordval").val();
  var reg=/^[a-zA-Z0-9]{6,18}$/;	
    if(reg.test($pwd)==false){
	  document.getElementById("passwordcheck_tips").style.visibility="visible";
	  return false;
	  }
    else{
	    document.getElementById("passwordcheck_tips").style.visibility="hidden";
	    return true;
	  }
}

function checkRepwd(){
  $repwd=$("#password_again").val();
  $pwd=$("#passwordval").val();
    if($pwd != $repwd){
	    document.getElementById("repasswordcheck_tips").style.visibility="visible";
	    return false;
	  }
    else{
    	document.getElementById("repasswordcheck_tips").style.visibility="hidden";
    	return true;
    }
	  
}