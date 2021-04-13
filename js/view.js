/*
 * @Descripttion: 
 * @Author: Mashiro_05
 * @version: 
 * @Date: 2021-04-13 22:09:23
 * @LastEditors: Mashiro_05
 * @LastEditTime: 2021-04-14 00:34:20
 */

jQuery.fn.rowspan = function(colIdx) { //封装的一个JQuery小插件
   return this.each(function(){
      var that;
      $('tr', this).each(function(row) {
         $('td:eq('+colIdx+')', this).filter(':visible').each(function(col) {

            
            
            if (that!=null && $(this).html() == $(that).html()) {//&& $(that).attr("bgcolor") !=="Lavender"  加上这个不会合并填充格，但会很丑
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

$(function() {
$("#class").rowspan(0);//传入的参数是对应的列数从0开始  第一列合并相同
$("#class").rowspan(1);
$("#class").rowspan(2);
$("#class").rowspan(3);
$("#class").rowspan(4);
$("#class").rowspan(5);
$("#class").rowspan(6);
$("#class").rowspan(7);

});