
$(function(){
	/*-----下面三个都是当页面滚动到一定的层次不会变------------*/
    var _box_y = $("#zc-form-box").offset().top; 
	$(window).scroll(function(){ 
      if($(window).scrollTop() > _box_y){ 
           $("#zc-form-box").attr("style","position: fixed;top:0px; z-index:99;"); 
          }else{ 
              $("#zc-form-box").attr("style",""); 
               } 
    }) 
	/*-----------------*/
	var _box_y2 = $("#zc-listmain-leftchoose").offset().top -100; 
	$(window).scroll(function(){ 
      if($(window).scrollTop() > _box_y2){ 
           $("#zc-listmain-leftchoose").attr("style","position: fixed;top:128px; margin:0;z-index:99;"); 
          }else{ 
              $("#zc-listmain-leftchoose").attr("style",""); 
               } 
    }) 
	/*-----------------*/
	var _box_y3 = $("#right_tab").offset().top ; 
	$(window).scroll(function(){ 
      if($(window).scrollTop() > _box_y3){ 
           $("#right_tab").attr("style","position: fixed;top:112px; z-index:99;"); 
          }else{ 
              $("#right_tab").attr("style",""); 
               } 
    })
    /*车品牌JS的操作*/

})

var brand = 'free-brand';
var price = 'free-price';
var type  = 'free-type';
/*data值表示传过来的内容（都已字符串的形式接收，除了价格），id表示传过来的值是哪种类型（1是类型，2是品牌，3是价格）*/
function carSearch($data,$id) {
       if($id == 1){
           $('.left-cartype-defult span').css('color','#93939e');
           $('#'+$data  ).css('color','#fabe00');
           type =$data;
       }
       if($id == 2){
           $('.car-brand-i a').css('color','#93939e');
           $('#'+$data).css('color','#fabe00');
           brand = $data;
       }
       if($id ==3){
           $(".pri-range-ty span").css('background-color','#e9ebee');
           $('#'+$data).css('background-color','#fabe00');
           price = $data;
       }
        $.ajax({
            type: "POST",
            url: "/Carlist/sort_action",
            dataType: "json",
            data: {"type":type,"brand":brand,"price":price},
            success: function(json) {
                $("#conTable").html("");
                $('#oriTable').css('display','none');
                $('#conTable').css('display','table');
                var i =0;
                for(i=0;json.length;i++){
                    $('#conTable').append('<tr><td class="pic">' +
                        '<a href="/Carlist/CarPage.html?Car_Id='+json[i].car_id+'">' +
                        '<img src="'+json[i].car_url+'" ></a></td>' +
                        '<td class="info">' +
                        '<p class="info-name">'+json[i].car_name+'</p>' +
                        '<p class="info-oth">'+json[i].car_detailna+'</p>' +
                        '<div class="alltips">' +
                        '<i class="bh-rm"> 热门车</i>' +
                        '<i class="bh-xin">新型车</i></div></td>' +
                        '<td class="ord">' +
                        '<div class="order-box">' +
                        '<div class="order-box-left">' +
                        '<div class="car-price">' +
                        '<span class="order-price-head">' +
                        '<em class="order-rmb">¥</em>' +
                        '<em class="order-num">'+json[i].car_price+'</em>' +
                        '<em class="order-unit">/套餐价</em>' +
                        '</span>' +
                        '<div class="order-price-bottom">' +
                        '<span>' +
                        '<em class="order-total">原价:</em>' +
                        '<em class="order-smrmb">¥</em>' +
                        '<em class="order-smnum">'+json[i].car_oripri+'</em>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<a href="/Index/ording?car_id='+json[i].car_id+'" class="od-but">立即预定</a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>');

                }
                // if(json.success==1){
                //     $('html, body').animate({scrollTop:0}, 'slow');
                //     $('#UserName').val(json.username);
                //     $('#PassWord').val(json.password);
                //     $('#Mem_Name').val(json.mem_name);
                //     $('#Mem_Card').val(json.mem_card);
                //     $('#Mem_Email').val(json.mem_email);
                //     $('#Mem_Tel').val(json.mem_telnum);
                //
                // }
            }
        })
}