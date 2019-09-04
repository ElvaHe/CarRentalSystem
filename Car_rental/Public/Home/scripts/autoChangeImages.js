var i = 0;
//自动改变图片
function autoChangeImage(i){                
    setTimeout("changeImage(i++);", 500);
    setTimeout("autoChangeImage(i = (i%5))", 1500);
}
$(function () {
    var mydate = new Date();
    var currentTime = mydate.getFullYear()+'-'+(mydate.getMonth()+1)+'-'+mydate.getDate();
    $("#fetchTime").attr("min",currentTime);
    var futureTime = mydate.getFullYear()+'-'+(mydate.getMonth()+1)+'-'+(mydate.getDate()+7);
    $("#fetchTime").attr("max",futureTime);
    $("#backTime").attr("min",currentTime);
})
//改变图片方法
function changeImage(idNum){
    document.getElementById("radio" + idNum).checked = "checked";
    switch(idNum){
        case 1:
            document.getElementById("imgIndex").style.backgroundImage = "url(http://www.car_rental.com/images/1.jpg)";
            break;
        case 2:
            document.getElementById("imgIndex").style.backgroundImage = "url(http://www.car_rental.com/images/2.jpg)";
            break;
        case 3:
            document.getElementById("imgIndex").style.backgroundImage = "url(http://www.car_rental.com/images/3.jpg)";
            break;
        case 4:
            document.getElementById("imgIndex").style.backgroundImage = "url(http://www.car_rental.com/images/4.jpg)";
            break;
    }
}
//显示隐藏地点
var status =0;
function placefetch(){
	document.getElementById("placefetchlist").style.visibility = "visible";
	status = 1;
	
}
function placeback(){
	status = 2;
	document.getElementById("placefetchlist").style.visibility = "visible";
}
function placefetchli($key){
	if(status == 1){
	document.getElementById("fetchplace").value = $key;
	document.getElementById("placefetchlist").style.visibility = "hidden";
	status == 0;
	}
	if(status == 2){
	document.getElementById("backplace").value = $key;
	document.getElementById("placefetchlist").style.visibility = "hidden";
	status == 0;
	}
}
//主页面时间点的隐藏
function timefetch(){
    document.getElementById("home-time-hidden-fetch").style.visibility = "visible";
    document.getElementById("home-time-hidden-back").style.visibility = "hidden";
}

function timeback(){
    document.getElementById("home-time-hidden-back").style.visibility = "visible";
    document.getElementById("home-time-hidden-fetch").style.visibility = "hidden";
}

function ToInputFetch($key){
    document.getElementById("fetchHour").value = $key;
    document.getElementById("home-time-hidden-fetch").style.visibility = "hidden";
}
function ToInputBack($key){
    document.getElementById("backHour").value = $key;
    document.getElementById("home-time-hidden-back").style.visibility = "hidden";
}
