<?php
/*
 * @Descripttion: 主接口
 * @Author: Mashiro_05
 * @version: 
 * @Date: 2021-04-04 13:26:18
 * @LastEditors: Mashiro_05
 * @LastEditTime: 2021-04-13 23:43:15
 */
include_once 'get_return.php';//引用
include_once 'get_class.php';//引用
include_once 'function.php';//引用
include_once 'view.php';//引用


!isset($_GET['openid'])?(print 'code:100;缺少参数openid').(exit()):($openid=$_GET['openid']);//三元运算符，注意echo无法使用，只能用print,多行执行代码需要加括号并用.连接
!isset($_GET['type'])?$type=4:$type=$_GET['type'];
!isset($_GET['zc'])?$zc=get_week_num():($zc=$_GET['zc']).($zc<10?$zc="0".$zc:$zc=$zc);
!isset($_GET['day'])?$day=0:$day=$_GET['day'];
!isset($_GET['date'])?$date=date("Y-m-d"):$date=$_GET['date'];

;//url3要求的周次为小于10时要加0

switch ($type) {
    case 1:
        get_class_week($openid,$zc);break;
    case 2:
        get_class_day($openid,$day);break;
    case 3:
        get_class_date($openid,$date);break;
    case 4:
        get_html(get_class_html($openid,$zc));break;
    default:
        get_html(get_class_html($openid,$zc));break;

    }


/*
openid  微信个人凭证，必填
type   1 周次查询  2 按天查询  3日期查询  4 周次查询（网页） 缺省为4
zc   周次，type=1,type=4时可用   缺省为当前周次
day 时间更变量，type=2时可用   单位天，缺省为0，表示当天，正数为之后多少天，负数为之前多少天
date 完整时间，type=3时可用，格式“2021-4-5”，缺省为当天
*/
?>
