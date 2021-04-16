
<?php
include_once 'function.php';//引用

    function get_html($array){
              $openid=$array['openid'];
              $zc=$array['week_num'];
              
              $banji=openid_to_class($openid);
              echo <<<eot
              <!doctype html>
              <html lang="zh">
              <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <title>工商课表</title>

              <link rel="stylesheet" href="assets/css/style-starter.css">
              <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">
              <script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>
              <link rel="stylesheet" href="assets/css/message.min.css">

              <script src="assets/js/message.min.js"></script>

              </head>

              <body class="cbp-spmenu-push">
              <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                     <h3>当前班级:$banji</h3>

              <ul>
              <li><a class="active" href="index.php?openid=$openid">本周课表</a></li>
              <li><a href="https://blog.ayano.top">我的博客</a></li>
              <li><a href="https://blog.ayano.top/archives/483/">接口文档</a></li>
              <li><a href="javascript:void(0)" onclick="msg_about_class()">关于课表</a></li>
              <li><a href="javascript:void(0)" onclick="msg_contact()">联系我</a></li>
              </ul>
              </nav>
              <div class="main buttonset">
              <!--导航栏-->
              <div class="tophny-header">
              <div class="container">
              <div class="hny-topgds">
              <div class="menu-notify">
              <button id="showLeftPush"><span class="fa fa-bars" aria-hidden="true"></span></button>

              </div>
              <div class="logo text-center">
              <h1><a class="navbar-brand" href="index.php?openid=$openid">
              工商课表
              </a></h1>

              </div>
              <div class="icon-left search-right text-right">

              <a href="#search" class="hnysearch-icon" title="search"><span class="fa fa-search"
              aria-hidden="true"></span></a>
              <!-- search popup -->
              <div id="search" class="pop-overlay">
              <div class="popup">
              <h3 class="hny-title two">查询其他周次</h3>
              <form action="index.php" method="get" class="search-box">
              <input type="search" placeholder="输入要跳转的周次(1-20)" name="zc"
              required="required" autofocus="" pattern="^(1?[0-9]|20)$">
              <input type="hidden" name="openid" value="$openid">
              <button type="submit" class="btn">跳转</button>
              </form>

              </div>
              <a class="close" href="#close">×</a>
              </div>

              </div>
              </div>
              </div>

              </div>
              <section class="w3l-testimonials"><!--主体内容-->


              <table width="100%" align="center" id="class"><!--第一行-->
              <tr height="20px">
              <th bgcolor="#d3eef4" colspan="1" width="9%">$zc 周</th>
              <th bgcolor="#f0f3f4" width="13%">周一</th>
              <th bgcolor="#f0f3f4" width="13%">周二</th>
              <th bgcolor="#f0f3f4" width="13%">周三</th>
              <th bgcolor="#f0f3f4" width="13%">周四</th>
              <th bgcolor="#f0f3f4" width="13%">周五</th>
              <th bgcolor="#f0f3f4" width="13%">周六</th>
              <th bgcolor="#f0f3f4" width="13%">周日</th>
              </tr>

              <tr height="20px">
              eot;
              $month=get_date_array($zc,1)['month'];

              echo <<<eot
              <th bgcolor="#d3eef4" colspan="1" width="9%">$month 月</th>
              eot;

              for($i=1;$i<=7;++$i){
                     $new_month=get_date_array($zc,$i)['month'];
                     $day=get_date_array($zc,$i)['day'];
                     if($month==$new_month){
                            echo <<<eot
                            <th bgcolor="#f0f3f4" width="13%">$day</th>
                            eot;
                     }else{
                            echo <<<eot
                            <th bgcolor="#f0f3f4" width="13%">$new_month.$day</th>
                            eot;
                     }

              }
              
              echo "</tr>";

              
              for($i=1;$i<=5;++$i){
                     echo <<<eot
                     <tr height="50px">
                     <th rowspan="1" bgcolor="#d3eef4">$i</th>
                     eot;
                     echo fill($array,$i);
                     echo "</tr>";
              }

              echo <<<eot
              <tr height="5px">
              <th colspan="1" bgcolor="#d3eef4"></th>
              eot;
              
              for($i=1;$i<=7;++$i){
                     echo <<<eot
                     <td rowspan="1" bgcolor="#d3eef4"></td>
                     eot;
              }
              
              echo "</tr>";

              for($i=6;$i<=10;++$i){
                     echo <<<eot
                     <tr height="50px">
                     <th rowspan="1" bgcolor="#d3eef4">$i</th>
                     eot;
                     echo fill($array,$i);
                     echo "</tr>";
              }

              echo <<<eot
              <tr height="5px">
              <th colspan="1" bgcolor="#d3eef4"></th>
              eot;
              
              for($i=1;$i<=7;++$i){
                     echo <<<eot
                     <td rowspan="1" bgcolor="#d3eef4"></td>
                     eot;
              }
              
              echo '</tr>';


              for($i=11;$i<=12;++$i){
                     echo <<<eot
                     <tr height="50px">
                     <th rowspan="1" bgcolor="#d3eef4">$i</th>
                     eot;
                     echo fill($array,$i);
                     echo "</tr>";
              }


              
              echo <<<eod
              </table>
              </section>
              <section class="w3l-footer">
              <footer class="footer-28">
              <div class="midd-footer-28 align-center py-lg-4 py-3 mt-5">
              <div class="container">
              <p class="copy-footer-28 text-center">©2021 Mashiro_05 | <a href="https://blog.ayano.top" target="_blank" rel="noopener noreferrer">个人博客</a> | <a href="https://github.com/ayano05/cqtbi_class" target="_blank" rel="noopener noreferrer">github</a></p>
              </div>
              </div>
              
              </footer>
              </section>
              

              <script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>
              <script src="assets/js/view.js"></script>

              <script>
              //展开左滑菜单
              var menuLeft = document.getElementById('cbp-spmenu-s1'),
              showLeftPush = document.getElementById('showLeftPush'),
              body = document.body;

              showLeftPush.onclick = function () {
              classie.toggle(this, 'active');
              classie.toggle(body, 'cbp-spmenu-push-toright');
              classie.toggle(menuLeft, 'cbp-spmenu-open');
              disableOther('showLeftPush');
              };

              function disableOther(button) {
              if (button !== 'showLeftPush') {
              classie.toggle(showLeftPush, 'disabled');
              }
              }
              </script>
              </body>
              </html>
              eod;


              
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
                            
                     
                            if($msg===""){
                                   //填充空白行

                                   
                                   $msg=<<<eot
                                   <td rowspan="1" bgcolor="#f0f3f4"></td>
                                   eot;
                                   

                            //       $msg=<<<eot
                            //       <td rowspan="1" bgcolor=""></td>
                            //       eot;

                            }
                            echo $msg;
                     
                     
              }
       }
       function rand_color(){
              //$bgcolor=['GreenYellow','Plum','Plum','SpringGreen','LightBlue','LightPink','Coral','Gold','LightSteelBlue','Thistle','SandyBrown','LightGreen','Feldspar'];
              //$bgcolor=['#CCFFFF','#FFCCCC','#FFFF99','#CCCCFF','#FF9966','##87CEFA','#CCFF99','#CCFFCC','#FFCC99','#99CCCC','#99CC99','#FFFFCC','#FF99CC','#66CCCC','#FF9900'];
              $bgcolor=['#FFFFCC','#CCFFFF','#FFCCCC','#CCCCFF'];
              return $bgcolor[rand(0, count($bgcolor)-1)];
       }

       function get_url_parameter($name){//参数名称   //取url内参数值
       parse_str($_SERVER['QUERY_STRING'],$array);
       return($array['name']);
       }

       function openid_to_class($openid){//将已记录的openid与班级对应，直接显示班级名字
              switch($openid){
                     case 'o4Kckt8_djJfQqr1guobMwmlT9ME':return '软件2班';
                     case 'o4Kckt8REbfD7-b-NW4gIeOulfiU':return '云计算1班';
                     case 'o4Kcktyf4erNHbZGbMRdkMBtjM10':return '计算机1班';
                     case 'o4Kckt9KsbzPm8i5GYBIvzqYVhbI':return '计算机6班';
                     //case 'o4Kckt8REbfD7-b-NW4gIeOulfiU':return '云计算1班';
                     //case 'o4Kckt8REbfD7-b-NW4gIeOulfiU':return '云计算1班';
                     default:return'未记录班级';
              }
              }
?>

