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
      content: '<p>项目说明:代码于大二时期(2020年)完成，语法很烂，大佬勿喷，问就是懒得重构了(能跑就行)，有github账号的不妨动动小手点一个star，项目地址:<a href="https://github.com/Cypas/cqtbi_class" target="_blank" rel="noopener noreferrer">github</a></p>',
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
      content: '<p>个人简介:2022届毕业生，steam，ns，vr玩家，其他班需要qq机器人课表或是网页版课表的也可以联系我</font></br>QQ:<font color="#add8e6">2773793160</font></br></p>',//内容
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
   




