/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */


 //获取地址栏参数  输入为参数名
function GetQueryString(name)

{

     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");

     var r = window.location.search.substr(1).match(reg);

     if(r!=null)return  unescape(r[2]); return null;

}

//from内添加元素

//网页布局自适应
( function( window ) {

   'use strict';
   
   // class helper functions from bonzo https://github.com/ded/bonzo
   
   function classReg( className ) {
     return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
   }
   
   // classList support for class management
   // altho to be fair, the api sucks because it won't accept multiple classes at once
   var hasClass, addClass, removeClass;
   
   if ( 'classList' in document.documentElement ) {
     hasClass = function( elem, c ) {
       return elem.classList.contains( c );
     };
     addClass = function( elem, c ) {
       elem.classList.add( c );
     };
     removeClass = function( elem, c ) {
       elem.classList.remove( c );
     };
   }
   else {
     hasClass = function( elem, c ) {
       return classReg( c ).test( elem.className );
     };
     addClass = function( elem, c ) {
       if ( !hasClass( elem, c ) ) {
         elem.className = elem.className + ' ' + c;
       }
     };
     removeClass = function( elem, c ) {
       elem.className = elem.className.replace( classReg( c ), ' ' );
     };
   }
   
   function toggleClass( elem, c ) {
     var fn = hasClass( elem, c ) ? removeClass : addClass;
     fn( elem, c );
   }
   
   window.classie = {
     // full names
     hasClass: hasClass,
     addClass: addClass,
     removeClass: removeClass,
     toggleClass: toggleClass,
     // short names
     has: hasClass,
     add: addClass,
     remove: removeClass,
     toggle: toggleClass
   };
   
   })( window );

//函数:合并table
jQuery.fn.rowspan = function(colIdx) { //封装的一个JQuery小插件
   return this.each(function(){
      var that;
      $('tr', this).each(function(row) {
         $('td:eq('+colIdx+')', this).filter(':visible').each(function(col) {

            
            
            if (that!=null && $(that).attr("bgcolor") !=="#d3eef4" && $(this).html() == $(that).html()) {//&& $(that).attr("bgcolor") !=="Lavender"  加上这个不会合并填充格，但会很丑
               rowspan = $(that).attr("rowSpan");
               if (rowspan == undefined) {
                  $(that).attr("rowSpan",1);
                  rowspan = $(that).attr("rowSpan"); }
               rowspan = Number(rowspan)+1;
               $(that).attr("rowSpan",rowspan);
               $(this).hide();
            } else {
               that = this;
            }
         });
      });
   });
}

function msg_about_class() {//创建消息框 关于课表

  VtMessage.panel({
      content: $('#panel').html(),
      offset: 'vt-center-center',
      title: '关于课表',
      content: '<p>大一时我也就写过一个手动导入课程数据，本地连接mysql数据库进行查询，再连接机器人进行推送的课表，但麻烦的是每次改课都要跟着改数据库。</br>大二有了一定技术后着手抓包学工系统的课表，但发现学工系统任何页面的课表输出都是图片，而不是table表格，腾讯云ocr接口也要钱（这才是主要原因吧）</br></br>碰壁后计划解析微信课表，抓包过程中发现通过一个openid的值也就能取到最终的课表页面（事实是到现在为止也没找到除抓包外获取openid的方法），于是开始设计网页解析接口，很多函数全都不会，然后就是一边百度，一边码代码，更多时候也都是修bug....最终，耗费了我两周多的时间，终于算是完成了这个项目及其qq机器人推送，html表格页面。</br></br>事实上，这个页面的框架，消息框，各类css，js都是从别人模板下扣下来的，自己前端设计是真的菜orz，也就撑死搞搞后端算了。</br></br>本项目同时已开源，感兴趣的也可以去看看，有github账号的顺便点个star更好，地址为:<a href="https://github.com/ayano05/cqtbi_class" target="_blank" rel="noopener noreferrer">github</a></p>',//内容
      footer: true,
      style: {
          minWidth: 400
      },
  });

  showLeftPush = document.getElementById('showLeftPush');
  $(showLeftPush).trigger("click");

}

function msg_contact() {//创建消息框 联系方式

  VtMessage.panel({
      content: $('#pane2').html(),
      offset: 'vt-center-center',
      title: '联系方式',
      content: '<p>个人简介:喜欢动漫的非二次元死宅，大二软件技术在读学生，steam骨灰级玩家(fps游戏除外)，擅长各种编程语言<s>的hello world！</s></br>希望能认识更多优秀的人</br><font color="#FF0000">其他班需要qq机器人课表或是网页版课表的也可以联系我，扫一个二维码就可以了</font></br>QQ:<font color="#add8e6">2773793160</font></br>邮箱:<font color="#add8e6">ayano05@outlook.com</font></br>steamid:<font color="#add8e6">420985217</font></p>',//内容
      footer: true,
      style: {
          minWidth: 400
      },
  });

  showLeftPush = document.getElementById('showLeftPush');
  $(showLeftPush).trigger("click");

}
//合并table

$(function() { 
   $("#class").rowspan(0);//传入的参数是对应的列数从0开始  第一列合并相同
   $("#class").rowspan(1);
   $("#class").rowspan(2);
   $("#class").rowspan(3);
   $("#class").rowspan(4);
   $("#class").rowspan(5);
   $("#class").rowspan(6);
   $("#class").rowspan(7);
   $("#class").rowspan(8);
   $("#class").rowspan(9);
   $("#class").rowspan(10);
   $("#class").rowspan(11);
   $("#class").rowspan(12);
   $("#class").rowspan(13);
   $("#class").rowspan(14);
   });
   




