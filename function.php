<?php
/*
 * @Descripttion: 公用函数集
 * @Author: Mashiro_05
 * @version: 
 * @Date: 2021-04-05 19:50:47
 * @LastEditors: Mashiro_05
 * @LastEditTime: 2021-04-15 16:19:09
 */
global $openid,$zc,$startdate;
$startdate=date_create("2021-3-1");/////////////////第一周开始时间，每学期都要改


    function del_object($arr,$week){////获取到的都是周课表，需要删除非当天的数据
        
        switch($week){
            case 0:
                $week='7';break;
            case 1:
                $week='1';break;
            case 2:
                $week='2';break;
            case 3:
                $week='3';break;
            case 4:
                $week='4';break;
            case 5:
                $week='5';break;
            case 6:
                $week='6';break;
            default:
                echo '周次错误';break;
        }

        /*
        foreach ($arr['classtime'] as $key => $value) {//
            if(strpos($value["week"],$week)=== false){
             
                unset($arr['classtime'][$key]);
            }
        }
        return($arr);
        */
        
        $new_array=array();
        foreach ($arr['classtime'] as $key => $value) {
            if(strpos($value["week"],$week)=== 0)
            $new_array[]=$arr['classtime'][$key];            
        }
        $arr['classtime']=$new_array;
        return($arr);

    }

    function get_week_num($date=null){//取当前周次 $date=null 表示参数可缺省
        global $startdate;
        if($date!==null){
            $week_num=date_diff($startdate,date_create($date))->format('%a');
        }else{
            $week_num=date_diff($startdate,date_create(date("Y-m-d")))->format('%a');
        }
        $week_num=intval($week_num/7)+1;
        if($week_num<10)$week_num="0".$week_num;
        return $week_num;
    }

    function get_date_array($zc,$xq){//取当前周次 $date=null 表示参数可缺省
        global $startdate;
        $starttime=date_format($startdate,"Y-m-d");
        $time=strtotime($starttime)+604800*$zc+86400*($xq-1);
        $month=date('n',$time);
        $day=date('j',$time);
        //$array=['month'=>$month,'day'=>$day];
        //return $array;
        return ['month'=>$month,'day'=>$day];
    }
  
  
    function getTabledate($openid,$info){//table格式化为二维数组
        $info = str_replace(array("--","<br/>","\t","\r\n","\r","\n"),"",$info);
        //preg_match_all("~<table[^>]+[^>]*>(.*?)<\/table>~", $info, $content);//原版代码,不太适用于本校课表
        preg_match_all("~</thead>([\s\S]*)</table>~", $info, $content);
        $content = $content[1][0];
        $content = preg_replace("'<tr[^>]*?>'si","",$content);	//替换前面的tr为空                    
        $content = preg_replace("'<td[^>]*?>'si","",$content);    //替换前面的td为空
        $content = str_replace("</tr>","{tr}",$content);
        $content = str_replace("</td>","{td}",$content);
        $content = preg_replace("'<[/!]*?[^<>]*?>'si","",$content); //替换其他多余的标签
        $content = preg_replace("'([rn])[s]+'","",$content);   	  //替换换行符和空格
        $content = str_replace(" ","",$content);
        $content = explode('{tr}', $content);							//tr分割
        array_pop($content);    //最后一个元素为空
        $res=[];
        $keys=["course","teacher","class_name","zc","week","place","start_class","end_class","start_time","end_time"];
        foreach ($content as $key=>$tr) {		//遍历每一行
            $line = explode('{td}', $tr);  //td分割
            array_pop($line);   //最后一个元素是由原来的</td>分割的，为空值，删掉，array_pop表示删掉数组最后一个值
            
            if(sizeof($line)>1){ //不是空行

                $array_out=array();    //将处理后的数据替换原数据   替换课程开始与结束时间
                preg_match("~\[(.*?)-(.*?)\]~",$line[4],$array_out);
                $start_class = $array_out[1];  
                $end_class   = $array_out[2];
                $start_time = get_start_time($array_out[1]);  //php正则匹配0为完整匹配，1为第一个子匹配，2为第二个子匹配
                $end_time   = get_end_time($array_out[2]);
                array_push($line,$start_class,$end_class,$start_time,$end_time);
                

                $array_out=array();//将处理后的数据替换原数据   替换课名
                preg_match("~(?<=\]).*~",$line[0],$array_out);
                $line[0]=$array_out[0];

                $array_out=array();//将处理后的数据替换原数据   替换week
                
                $line[4]=wday_tonum($line[4]);
                
                if(empty($line[5])){$line[5]="操场";
                }else{ 
                                if(substr($line[5], 0, 9) === "行知楼")//一个中文占两个字节，对于一个UTF-8的中文字符，会把它当做3个字节来处理   //将处理后的数据替换原数据   替换地点
                            {                    
                                $place=substr($line[5], 0, 13);
                                }else{
                                    $array_out=array();
                                    preg_match("~[a-zA-Z][0-9]{3}~",$line[5],$array_out);
                                    $place=$array_out[0];
                                }
                                $line[5]=$place;
                     } 


             $res[]=array_combine($keys,$line);//数组添加元素，并赋予键名
             
            
            }
        }    
        $array3['openid']=$openid;
        $array3['start_time']=array('8:00','8:50','9:40','10:30','11:20','14:00','14:50','15:40','16:30','17:20','19:00','19:50');
        $array3['end_time']=array('8:40','9:30','10:20','11:10','12:00','14:40','15:30','16:20','17:10','18:00','19:40','20:30');
        $array3['classtime']=$res;////封装三维数组
        
        return $array3;
        
    }


    function get_start_time($str){
        $start_time=array('null','8:00','8:50','9:40','10:30','11:20','14:00','14:50','15:40','16:30','17:20','19:00','19:50');
        switch($str){
            case 1:$time=$start_time[1];break;
            case 2:$time=$start_time[2];break;
            case 3:$time=$start_time[3];break;
            case 4:$time=$start_time[4];break;
            case 5:$time=$start_time[5];break;
            case 6:$time=$start_time[6];break;
            case 7:$time=$start_time[7];break;
            case 8:$time=$start_time[8];break;
            case 9:$time=$start_time[9];break;
            case 10:$time=$start_time[10];break;
            case 11:$time=$start_time[11];break;
            case 12:$time=$start_time[12];break;
            default:$time="null";break;
            
        }
        return $time;
    }    
    
    function get_end_time($str){
        $end_time=array('null','8:40','9:30','10:20','11:10','12:00','14:40','15:30','16:20','17:10','18:00','19:40','20:30');
        switch($str){
            case 1:$time=$end_time[1];break;
            case 2:$time=$end_time[2];break;
            case 3:$time=$end_time[3];break;
            case 4:$time=$end_time[4];break;
            case 5:$time=$end_time[5];break;
            case 6:$time=$end_time[6];break;
            case 7:$time=$end_time[7];break;
            case 8:$time=$end_time[8];break;
            case 9:$time=$end_time[9];break;
            case 10:$time=$end_time[10];break;
            case 11:$time=$end_time[11];break;
            case 12:$time=$end_time[12];break;
            default:$time="null";break;


        }
        return $time;
    }

    function wday_tonum($week){
        $week=substr($week, 0, 3);
        switch($week){
               case '一': return 1;
               case '二': return 2;
               case '三': return 3;
               case '四': return 4;
               case '五': return 5;
               case '六': return 6;
               case '日': return 7;
        }
       
 }



?>