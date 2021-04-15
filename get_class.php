<?php
/*
 * @Descripttion: 课表解析及输出
 * @Author: Mashiro_05
 * @version: 
 * @Date: 2021-04-05 16:06:57
 * @LastEditors: Mashiro_05
 * @LastEditTime: 2021-04-15 14:46:42
 */
include_once 'get_return.php';//引用
include_once 'function.php';//引用

    function get_class_week($openid,$zc) {//获取周课表
        
        
        $ticket = curl1($openid);
        $cookie = curl2($ticket);
        $data   = curl4($zc,$cookie,$ticket);
        $data   = getTabledate($openid,$data);  //table内容变为数组
        
        $data['class_num'] = count($data['classtime'],0);   //数组额外输出点数据让客户端省事  class_num是今天的课程节数
        $data['week_num']  = (int)$zc;  //周次
        $data['date']      = getdate();       //当天的数据 年月日时分秒周 等等
        
        $data = json_encode($data);   //数组内容变为json格式
        echo $data;
        
    } 

    function get_class_day($openid,$day) {//获取当天课表
        if($day==0){
        $week_num=get_week_num();
        }else{  
        $week_num=get_week_num(date("Y-m-d",strtotime($day." day")));//取周次
        }
        
        $week=date('w',strtotime(date("Y-m-d",strtotime($day." day"))));////取星期几   php时间的计算只能转化为unix时间戳后再进行计算最后还原为文本
        $ticket = curl1($openid);
        $cookie = curl2($ticket);
        $data   = curl4($week_num,$cookie,$ticket);
        $data   = getTabledate($openid,$data);
        $data   = del_object($data,$week);    //一周内的课表删除掉非今日的数据
        
        
        $data['class_num'] = count($data['classtime'],0);   //数组额外输出点数据让客户端省事  class_num是今天的课程节数
        $data['week_num']  = (int)$week_num;  //周次
        $data['date']      = getdate(strtotime(date("Y-m-d",strtotime($day." day"))));       //当天的数据 年月日时分秒周 等等
        
        $data   = json_encode($data);         //数组内容变为json格式
        echo $data;
        
     }


    function get_class_date($openid,$date) {//获取某天课表
        $week_num=get_week_num($date);

        $week=date('w',strtotime($date));////取星期几   php时间的计算只能转化为unix时间戳后再进行计算最后还原为文本
        $ticket = curl1($openid);
        $cookie = curl2($ticket);
        $data   = curl4($week_num,$cookie,$ticket);
        $data   = getTabledate($openid,$data);
        $data   = del_object($data,$week);    //一周内的课表删除掉非今日的数据
        
        
        $data['class_num'] = count($data['classtime'],0);   //数组额外输出点数据让客户端省事  class_num是今天的课程节数
        $data['week_num']  = (int)$week_num;  //周次
        $data['date']      = getdate(strtotime($date));       //当天的数据 年月日时分秒周 等等
        
        
        $data   = json_encode($data);         //数组内容变为json格式
        echo $data;



     }

    function get_class_html($openid,$zc) {//获取网页页面（待完善，目前先输出学校的课表页面）
        $ticket = curl1($openid);
        $cookie = curl2($ticket);
        $data   = curl4($zc,$cookie,$ticket);
        $data   = getTabledate($openid,$data); //table内容变为数组
        
        $data['class_num'] = count($data['classtime'],0);   //数组额外输出点数据让客户端省事  class_num是今天的课程节数
        $data['week_num']  = (int)$zc;  //周次
        $data['date']      = getdate();  
        return $data;


        }

?>