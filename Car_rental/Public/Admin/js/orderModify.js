/**
 * Created by Administrator on 2016/11/23 0023.
 */
$(function () {
    $('#remodify').click(function () {
        $("#formmodify").submit();
    })
    $('#fetchTime,#fetchHour,#backTime,#backHour').blur(function () {
        $fetchTime = $('#fetchTime').val();
        $fetchHour = $('#fetchHour option:selected').text();
        $fetchY =$fetchTime.substring(0,4);
        $fetchM =$fetchTime.substring(5,7);
        $fetchD =$fetchTime.substring(8,10);
        $fetchH =$fetchHour.substring(0,2);


        $backTime = $('#backTime').val();
        $backHour = $('#backHour option:selected').text();
        $backY =$backTime.substring(0,4);
        $backM =$backTime.substring(5,7);
        $backD =$backTime.substring(8,10);
        $backH =$backHour.substring(0,2);


        var date1 = new Date($fetchY, $fetchM, $fetchD, $fetchH, 0);  //开始时间
        var date2 = new Date($backY, $backM, $backD, $backH, 0);     //结束时间
        var date3 = date2.getTime() - date1.getTime();   //时间差的毫秒数
        $diff = date3/(3600000);
        $order_days = Math.floor($diff/24);
        if($order_days<0)
            alert("请重新选择正确的时间");
        if($order_days<1)
            $order_days = 1;
        if($diff % 24 >= 6)
             $order_days= $order_days+1;
        /*前面都是在计算时间，即计算出了一个$order_days 变量*/
        $car_price = $('#car_price').html();
        $order_door = $car_price*$order_days;
        $order_baoxian =40*$order_days;
        $order_total =$order_door+$order_baoxian+35;
        
        $('#order_days').val($order_days);
        $('#order_door').html($order_door);
        $('#order_baoxian').html($order_baoxian);
        $('#order_total').val($order_total);

    })
})