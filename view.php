
<?php

    function get_html($array){
              echo <<<eod
              <!DOCTYPE html>
              <html lang="en">
              <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Document</title>
              <script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>
              <script src="js/view.js"></script>
              </head>
              <body>
              <table width="100%" align="center" id="class"><!--第一行-->
              <tr height="50px">
              <th bgcolor="LightSalmon" colspan="2" width="9%">时间</th>
              <th bgcolor="LightSalmon" width="13%">星期一</th>
              <th bgcolor="LightSalmon" width="13%">星期二</th>
              <th bgcolor="LightSalmon" width="13%">星期三</th>
              <th bgcolor="LightSalmon" width="13%">星期四</th>
              <th bgcolor="LightSalmon" width="13%">星期五</th>
              <th bgcolor="LightSalmon" width="13%">星期六</th>
              <th bgcolor="LightSalmon" width="13%">星期日</th>
              </tr>
              eod;
              
              echo <<<eot
              <tr height="50px">
              <th rowspan="5" bgcolor="LightGoldenRodYellow">上午</th>
              <th rowspan="1" bgcolor="Khaki">1</th>
              eot;
              echo fill($array,'1');
              echo "</tr>";
              
              for($i=2;$i<=5;++$i){
                     echo <<<eot
                     <tr height="50px">
                     <th rowspan="1" bgcolor="Khaki">$i</th>
                     eot;
                     echo fill($array,$i);
                     echo "</tr>";
              }

              echo <<<eot
              <tr height="50px">
              <th rowspan="5" bgcolor="LightGoldenRodYellow">下午</th>
              <th rowspan="1" bgcolor="Khaki">6</th>
              eot;
              echo fill($array,'6');
              echo "</tr>";

              for($i=7;$i<=10;++$i){
                     echo <<<eot
                     <tr height="50px">
                     <th rowspan="1" bgcolor="Khaki">$i</th>
                     eot;
                     echo fill($array,$i);
                     echo "</tr>";
              }

              echo <<<eot
              <tr height="50px">
              <th rowspan="2" bgcolor="LightGoldenRodYellow">晚上</th>
              <th rowspan="1" bgcolor="Khaki">11</th>
              eot;
              echo fill($array,'11');
              echo <<<eot
              <tr height="50px">
              <th rowspan="1" bgcolor="Khaki">12</th>
              eot;
              echo fill($array,'12');
              
              echo "</tr></table></body></html>";


              
       }

       function fill($array,$c){
              $classtime=$array['classtime'];
              for($i=1;$i<=7;++$i){
                     $color=rand_color();
                     $msg="";
                     for($ii=0;$ii<count($classtime);++$ii){
                            $start_time=$classtime[$ii]['start_time'];
                            $end_time=$classtime[$ii]['end_time'];
                            $rowspan=$classtime[$ii]['end_class']-$classtime[$ii]['start_class']+1;
                            $course=$classtime[$ii]['course'];
                            $place=$classtime[$ii]['place'];

                            if(($classtime[$ii]['week']==$i)&&
                                   (
                                   ($classtime[$ii]['start_class']<$c && $classtime[$ii]['end_class']>$c)||
                                   ($classtime[$ii]['start_class']==$c)||
                                   ($classtime[$ii]['end_class']==$c)
                                   )
                            ){
                                          //填充该节课 
                                                 $msg=<<<eot
                                                 <td rowspan="1" align="center" bgcolor="$color">
                                                 $course</br>
                                                 @$place</br>
                                                 $start_time-$end_time</br>
                                                 </td>
                                                 eot;
                                          
                                          break;
                                   }
                            }
                            
                     $num=$i+($c-1)*7;
                            if($msg===""){
                                   //填充空白行
                                   
                                   $msg=<<<eot
                                   <td rowspan="1" bgcolor="Lavender"></td>
                                   eot;

                            }
                            echo $msg;
                     
                     
              }
       }
       function rand_color(){
              $bgcolor=['GreenYellow','Plum','Plum','SpringGreen','LightBlue','LightPink','Coral','Gold','LightSteelBlue','Thistle','SandyBrown','LightGreen','Feldspar'];
              return $bgcolor[rand(0, 12)];
       }
?>


