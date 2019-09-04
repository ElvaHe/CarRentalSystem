<?php
namespace Common\Model;
class CalculatedDays {
  public function orderDays($key){
      $fetchYear = substr($_POST['fetchTime'],0,4);
      $fetchMonth = substr($_POST['fetchTime'],5,2);
      $fetchDay = substr($_POST['fetchTime'],8,2);
      $fetchHour =substr($_POST['fetchHour'],0,2);

      $backYear = substr($_POST['backTime'],0,4);
      $backMonth = substr($_POST['backTime'],5,2);
      $backDay = substr($_POST['backTime'],8,2);
      $backHour =substr($_POST['backHour'],0,2);

//      echo"<p></p>";
//      echo $fetchYear."-".$fetchMonth."-".$fetchDay."小时：".$fetchHour;
//      echo"<p></p>";
//      echo $backYear."-".$backMonth."-".$backDay."小时：".$backHour;
//      echo"<p></p>";
      // mktime(hour,minute,second,month,day,year,is_dst);
      $time1 = mktime($fetchHour,0,0,$fetchMonth,$fetchDay,$fetchYear);
      $time2 = mktime($backHour,0,0,$backMonth,$backDay,$backYear);
      $diff = (($time2-$time1)/(3600));
      $day = (int)($diff/24);
      /*
       * 小于一天按照一天的来算。
       * 如果最后一天超过的时间大于6小时，也按照一天的时间来算
       * */
      if($day<1)
          return 1;
      if($diff % 24 > 6)
          return $day+1;
      else
          return $day;
  }
}