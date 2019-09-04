/**
 * Created by Administrator on 2016/11/23 0023.
 */
$(function () {
    $('html, body').animate({scrollTop:440}, 'slow');
    // $("#submitBut").click(function () {
    //     var reg = $(".chooseSel").val();
    //     var searchCon = $("#searchInput").val();
    //     if(reg=="请选择您要查询的方式"){
    //         alert('查询方式不能为空，请选择您的查询方式');
    //         return false;
    //     }
    //     if(searchCon==""){
    //         alert('查询内容不能为空，请重新输入您的查询内容');
    //         return false;
    //     }
    //     if(reg =='会员用户名'){
    //         window.location.href='/Order/Mem_search?Mem_Name='+searchCon+'';
    //     }
    //     $.ajax({
    //         type: "POST",
    //         url: "/Order/OrderSearch_action",
    //         dataType: "json",
    //         data: {"reg":reg,"searchCon":searchCon},
    //         success: function(json){
    //             if(json.success==0){
    //                 alert("该订单不存在！");
    //                 $("#searchInput").focus();
    //             }
    //             if(json.success==1){
    //                 $("#td-four").focus();
    //                 $('.gradeAeven').remove();
    //                 $('.fenye-line').css('visibility','hidden');
    //                 $('.gradeAodd').css('visibility','visible');
    //                 $('#td-one').html(json.order_num);
    //                 $('#td-two').html(json.mem_name);
    //                 $('#td-three').html(json.order_cretime);
    //                 $('#td-four').live('click',searchOrder(json.order_num));
    //                 $('#td-four').css('color','#F09B22');
    //             }
    //
    //         }
    //     })
    // })
})
function searchOrder($key) {
    $order_num = $key;
    $.ajax({
        type: "POST",
        url: "/Order/OrderPage_action",
        dataType: "json",
        data: {"order_num":$order_num},
        success: function(json){
                $('html, body').animate({scrollTop:0}, 'slow');
                $('#Car_Name').html(json.car_name);
                $('#Car_DetailNa').html(json.car_detailna);
                $('#Order_Num').html('订单号:'+json.order_num);
                $('#Order_FetchPlace').html('厦门 - '+json.order_fetchplace);
                $('#Order_FetcTime').html(json.order_fetchtime+' '+json.order_fetchhour);
                $('#Order_BackPlace').html('厦门 - '+json.order_backplace);
                $('#Order_BackTime').html(json.order_fetchtime+' '+json.order_backhour);
                $('#Car_Pice').html(json.order_total);
                document.getElementById("orderImg").src=json.car_url;
                if(json.order_status == 1)  $('#Order_Status').html("预定成功");
                if(json.order_status == 0)  $('#Order_Status').html("订单已取消");
                if(json.order_status == 2)  $('#Order_Status').html("租赁中");
                if(json.order_status == 3)  $('#Order_Status').html("订单已完成");
                 document.getElementById("managebut").href="/Order/OrderManage?Order_Num="+json.order_num;

        }
    })
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
        if(reg =='会员用户名'){
            window.location.href='/Order/OrderPage?pageAll=1&&Sort=会员用户名&&Mem_Name='+searchCon+'';
        }
        $.ajax({
            type: "POST",
            url: "/Order/OrderSearch_action",
            dataType: "json",
            data: {"reg":reg,"searchCon":searchCon},
            success: function(json){
                if(json.success==0){
                    alert("该订单不存在！");
                    $("#searchInput").focus();
                }
                if(json.success==1){
                    $("#td-four").focus();
                    $('.gradeAeven').remove();
                    $('.fenye-line').css('visibility','hidden');
                    $('.gradeAodd').css('visibility','visible');
                    $('#td-one').html(json.order_num);
                    $('#td-two').html(json.mem_name);
                    if(json.order_status == 0)
                        $('#td-five').html('订单已取消');
                    if(json.order_status == 1)
                        $('#td-five').html('预订成功');
                    if(json.order_status == 2)
                        $('#td-five').html('租赁中');
                    if(json.order_status == 3)
                        $('#td-five').html('订单已完成');
                    $('#td-three').html(json.order_cretime);
                    $('#td-four').bind('click',searchOrder(json.order_num));
                    $('#td-four').css('color','#F09B22');
                    $("#td-four").mousedown(function(){
                        $('html, body').animate({scrollTop:0}, 'slow');
                    });
                    $('#td-six').click(function () {
                         window.location.href=' /Order/orderManage?Order_Num='+json.order_num+'';
                    })
                    $('#td-seven').click(function () {
                        window.location.href=' /Order/orderModify?Order_Num='+json.order_num+'';
                    })
                }

            }
        })
}