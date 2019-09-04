/**
 * Created by Administrator on 2016/11/22 0022.
 */
$(function () {
    $('html, body').animate({scrollTop:440}, 'slow');
    if (getParam("Mem_Id")!=null){
        $("#searchInput").val(getParam("Mem_Id"));
        $(".chooseSel").find("option:selected").text("MemberID");
        $("#submitBut").click();
    }
})

window.onload =getParam("Mem_Id");
function searchIfo($key) {
    $('html, body').animate({scrollTop:0}, 'slow');
    $mem_id = $key;
    $.ajax({
                type: "POST",
                url: "/User/Homepage_action",
                dataType: "json",
                data: {"mem_id":$mem_id},
                success: function(json){
                    if(json.success==1){
                        $('html, body').animate({scrollTop:0}, 'slow');
                       $('#UserName').val(json.username);
                        $('#PassWord').val(json.password);
                        $('#Mem_Name').val(json.mem_name);
                        $('#Mem_Card').val(json.mem_card);
                        $('#Mem_Email').val(json.mem_email);
                        $('#Mem_Tel').val(json.mem_telnum);

                    }
                }
                })
}
function turnToOrder($key){
    window.location.href='/Order/Mem_search?Mem_Name='+$key+'';
}
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
                    $("#td-four").focus();
                   $('.gradeAeven').remove();
                    $('.fenye-line').css('visibility','hidden');
                    $('.gradeAodd').css('visibility','visible');
                    $('#td-one').html(json.username);
                    $('#td-two').html(json.mem_nickname);
                    $('#td-three').html(json.mem_name);
                    $('#td-four').bind('click',searchIfo(json.mem_id));
                    $('#td-four').css('color','#F09B22');
                    $("#td-four").mousedown(function(){
                        $('html, body').animate({scrollTop:0}, 'slow');
                    });
                    $('#td-five').click(function () {
                        window.location.href='/Order/Mem_search?Mem_Name='+json.mem_name+'';
                    })
                }
            }
            })
}

/*jS获取URL后面GET的值*/
function getParam(paramName) {
    paramValue = "";
    isFound = false;
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) {
        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&");
        i = 0;
        while (i < arrSource.length && !isFound) {
            if (arrSource[i].indexOf("=") > 0) {
                if (arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase()) {
                    paramValue = arrSource[i].split("=")[1];
                    isFound = true;
                }
            }
            i++;
        }
        if (isFound == true) {
            return paramValue;
        }
        // if(paramValue!=" "){
        //     alert(paramValue);
        // }
        // if( isFound ==true){
        //     alert(111);
        //     alert($(".chooseSel").val());
        //    // $(".chooseSel").find("option[text='MemberId']").attr("selected",true);
        //      // $(".chooseSel").val('MemberId');
        //      // $("#searchInput").html('paramValue');
        // }
    }
}