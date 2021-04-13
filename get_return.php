<?php
/*
 * @Descripttion: 通过一系列curl post提交获取课表
 * @Author: Mashiro_05
 * @version: 
 * @Date: 2021-04-04 13:30:23
 * @LastEditors: Mashiro_05
 * @LastEditTime: 2021-04-08 12:42:54
 */
include_once 'function.php';//引用
global $openid,$zc,$startdate;
    function curl1($openid) {//curl方式通过提交openid换取PORTAL_TICKET
       $ch = curl_init();
       $url="http://cqtbiwx.cqtbi.edu.cn/cqtbi/interface/CqtbiBsdt.php";
       $header[]= 'Host: cqtbiwx.cqtbi.edu.cn';
       $header[]= 'Connection: keep-alive';
       $header[]= 'Upgrade-Insecure-Requests: 1';
       $header[]= 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36 QBCore/4.0.1320.400 QQBrowser/9.0.2524.400 Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2875.116 Safari/537.36 NetType/WIFI MicroMessenger/7.0.20.1781(0x6700143B) WindowsWechat(0x63010200)';
       $header[]= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
       $header[]= 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.6,en;q=0.5;q=0.4';
       $header[]= 'Cookie: openid='.$openid;
       
       curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//在启用CURLOPT_RETURNTRANSFER的时候，返回原生的（Raw）输出
       curl_setopt($ch, CURLOPT_HEADER, true);//启用时会将头文件的信息作为数据流输出。
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);//超时时间
       curl_setopt($ch, CURLOPT_AUTOREFERER, true);//当根据Location:重定向时，自动设置header中的Referer:信息
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); //允许重定向
       $data = curl_exec($ch);   
       curl_close($ch);  
       preg_match("~PORTAL_TICKET=(\S+)\;~",$data,$match);
       return $match[1];
    }
    
    function curl2($PORTAL_TICKET) {//通过提交PORTAL_TICKET通过验证获得课表页面html数据
        $ch = curl_init();
        $url="http://szxy.cqtbi.edu.cn/GwAppBak/MyApp/appSsoIn.aspx";
        $get_date = array(
            'ord' => '24',            
            'PORTAL_TICKET' => $PORTAL_TICKET,
        );
        $url.="?".http_build_query($get_date);
        global $referer;
        $referer=$url;
        //echo $url;
        $header[]= 'Host: szxy.cqtbi.edu.cn';
        $header[]= 'Connection: keep-alive';
        $header[]= 'Upgrade-Insecure-Requests: 1';
        $header[]= 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36 QBCore/4.0.1320.400 QQBrowser/9.0.2524.400 Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2875.116 Safari/537.36 NetType/WIFI MicroMessenger/7.0.20.1781(0x6700143B) WindowsWechat(0x63010200)';
        $header[]= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
        $header[]= 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.6,en;q=0.5;q=0.4';
        global $openid;
        //$header[]= 'Cookie: openid='.$openid;
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //在启用CURLOPT_RETURNTRANSFER的时候，返回原生的（Raw）输出
        curl_setopt($ch, CURLOPT_HEADER, true);//启用时会将头文件的信息作为数据流输出。
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);//超时时间
        //curl_setopt($ch, CURLOPT_AUTOREFERER, true);//当根据Location:重定向时，自动设置header中的Referer:信息 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);//允许重定向(至多重定向多少次)
        
        $data=curl_exec($ch);
        $data = curl_unescape($ch,$data);
        
        curl_close($ch); 
        preg_match("~Set-Cookie:(.*?);~",$data,$match);
        return $match[1];
    }


    function curl3($cookie,$PORTAL_TICKET) {//curl2的前提下将得到的cookies重新提交至curl2重定向的页面，并加上Referer头
        $ch = curl_init();
        $url="http://szxy.cqtbi.edu.cn/GwAppBak/MyApp/studentPersonKbMobileApp.aspx";

        $header[]= 'Host: szxy.cqtbi.edu.cn';
        $header[]= 'Connection: keep-alive';
        $header[]= 'Upgrade-Insecure-Requests: 1';
        $header[]= 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36 QBCore/4.0.1320.400 QQBrowser/9.0.2524.400 Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2875.116 Safari/537.36 NetType/WIFI MicroMessenger/7.0.20.1781(0x6700143B) WindowsWechat(0x63010200)';
        $header[]= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
        $header[]= 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.6,en;q=0.5;q=0.4';
        global $openid;
        $header[]= 'Cookie:'.$cookie.';'.$PORTAL_TICKET;

        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //在启用CURLOPT_RETURNTRANSFER的时候，返回原生的（Raw）输出
        curl_setopt($ch, CURLOPT_HEADER, false);//启用时会将头文件的信息作为数据流输出。
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);//超时时间
        //curl_setopt($ch, CURLOPT_AUTOREFERER, true);//当根据Location:重定向时，自动设置header中的Referer:信息 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);//允许重定向(至多重定向多少次)      
        global $referer;
        curl_setopt($ch, CURLOPT_REFERER,$referer);//自定义referer头
        
        $data=curl_exec($ch);
        $data = curl_unescape($ch,$data);
        
        curl_close($ch); 
        
        return $data;
    }


    function curl4($zc,$cookie,$PORTAL_TICKET) {//在curl3的前提下url添加字段zs=01,02,03等来直接获取周次的课表
        $ch = curl_init();
        $url="http://szxy.cqtbi.edu.cn/GwAppBak/MyApp/studentPersonKbMobileApp.aspx?zs=".$zc;
        $header[]= 'Host: szxy.cqtbi.edu.cn';
        $header[]= 'Connection: keep-alive';
        $header[]= 'Upgrade-Insecure-Requests: 1';
        $header[]= 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36 QBCore/4.0.1320.400 QQBrowser/9.0.2524.400 Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2875.116 Safari/537.36 NetType/WIFI MicroMessenger/7.0.20.1781(0x6700143B) WindowsWechat(0x63010200)';
        $header[]= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
        $header[]= 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.6,en;q=0.5;q=0.4';
        global $openid;
        $header[]= 'Cookie:'.$cookie.';'.$PORTAL_TICKET;

        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //在启用CURLOPT_RETURNTRANSFER的时候，返回原生的（Raw）输出
        curl_setopt($ch, CURLOPT_HEADER, false);//启用时会将头文件的信息作为数据流输出。
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);//超时时间
        //curl_setopt($ch, CURLOPT_AUTOREFERER, true);//当根据Location:重定向时，自动设置header中的Referer:信息 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);//允许重定向(至多重定向多少次)      
        global $referer;
        curl_setopt($ch, CURLOPT_REFERER,$referer);//自定义referer头
        $data=curl_exec($ch);
        $data = curl_unescape($ch,$data);
        
        curl_close($ch); 
        
        return $data;
    }


?>



