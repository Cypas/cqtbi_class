<?php
/*
 * @Descripttion: 公用类，其实并没有用到
 * @Author: Mashiro_05
 * @version: 
 * @Date: 2021-04-05 19:36:41
 * @LastEditors: Mashiro_05
 * @LastEditTime: 2021-04-08 12:46:19
 */


  class Helper_Tool
  {
    static function unicodeDecode($data)//unicode解码
    {  
      function replace_unicode_escape_sequence($match) {
        
        
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        
      }  
    
      $rs = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $data);
    
      return $rs;
    }  


  }


?>