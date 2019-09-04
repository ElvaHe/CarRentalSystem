/**
 * Created by Administrator on 2016/11/24 0024.
 */
$(function () {
    $('html, body').animate({scrollTop:120}, 'slow');
})
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
    if(reg =='车辆品牌'){
        window.location.href='/Car/brand_search?Car_Brand='+searchCon+'';
    }
    if(reg =='车辆类型'){
        window.location.href='/Car/type_search?Car_Type='+searchCon+'';
    }
    $.ajax({
        type: "POST",
        url: "/Car/CarSearch_action",
        dataType: "json",
        data: {"reg":reg,"searchCon":searchCon},
        success: function(json){
            if(json.success==0){
                alert("不存在该编号车辆！");
                $("#searchInput").focus();
            }
            if(json.success==1){
                $("#td-four").focus();
                $('.gradeAeven').remove();
                $('.fenye-line').css('visibility','hidden');
                $('.gradeAodd').css('visibility','visible');
                $('#td-one').html(json.car_id);
                $('#td-two').html(json.car_type);
                $('#td-five').html(json.car_brand);
                $('#td-three').html(json.car_name);
                $('#td-eight').html(json.car_price);
                // $('#td-four').bind('click',searchOrder(json.order_num));
                // $('#td-four').css('color','#F09B22');
                // $("#td-four").mousedown(function(){
                //     $('html, body').animate({scrollTop:0}, 'slow');
                // });
                $('#td-six').click(function () {
                     window.location.href='/Car/CarManage?Car_Id='+json.car_id+'';
                })
                $('#td-seven').click(function () {

                    window.location.href=' /Car/CarModify?Car_Id='+json.car_id+'';
                })
            }

        }
    })
}