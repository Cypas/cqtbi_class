### openid的获取

可参考这篇[文章](https://blog.ayano.top/archives/485/)

### 接口说明

接口地址:</br>
https://t.ayano.top</br>

返回格式:</br>
type=1,2,3时是json;type=4时是html网页</br>

请求方式:</br>
GET</br>
请求示例:</br>
https://t.ayano.top/index.php?openid=o4Kckt8_djJfQqr1guobMwmlT9ME&type=4&zc=8</br>
参数说明:</br>

|<font color=DeepSkyBlue>参数<font>|<font color=DeepSkyBlue>必填<font>|<font color=DeepSkyBlue>默认值<font>|<font color=DeepSkyBlue>type要求<font>|<font color=DeepSkyBlue>说明<font>|
|--|--|--|--|--|
|openid|是|无||微信公众号个人凭证，目前只可抓包获取|
|type|否|4||1 周次查询  2  按天查询  3 日期查询  4  周次查询（网页输出）|
|zc|否|当前周次|type=1,4时需要该参数|需要查询的周次|
|day|否|0|type=2时需要该参数|偏移天数，0表示当天，正数为今天之后多少天，如1代表明天，负数则相反|
|date|否|当天|type=3时需要该参数|具体日期   格式为   2021-4-5|

返回示例(type=1,2,3):

```json
{
    "openid":"o4Kckt8_djJfQqr1guobMwmlT9ME",
    "start_time":[
        "8:00",
        "8:50",
        "9:40",
        "10:30",
        "11:20",
        "14:00",
        "14:50",
        "15:40",
        "16:30",
        "17:20",
        "19:00",
        "19:50"
    ],
    "end_time":[
        "8:40",
        "9:30",
        "10:20",
        "11:10",
        "12:00",
        "14:40",
        "15:30",
        "16:20",
        "17:10",
        "18:00",
        "19:40",
        "20:30"
    ],
    "classtime":[
        {
            "course":"PHP程序设计",
            "teacher":"施旭",
            "class_name":"19软件2班",
            "zc":"4-5,7-9,11-15,17-19",
            "week":1,
            "place":"行知楼4005",
            "start_class":"6",
            "end_class":"8",
            "start_time":"14:00",
            "end_time":"16:20"
        },
        {
            "course":"Web编程基础",
            "teacher":"李麒骥",
            "class_name":"19软件2",
            "zc":"2-9,11-16",
            "week":2,
            "place":"A513",
            "start_class":"1",
            "end_class":"3",
            "start_time":"8:00",
            "end_time":"10:20"
        },
        {
            "course":"Web应用开发-Asp.Net",
            "teacher":"蔡茜",
            "class_name":"19软件2",
            "zc":"7-9,11",
            "week":2,
            "place":"A101",
            "start_class":"4",
            "end_class":"5",
            "start_time":"10:30",
            "end_time":"12:00"
        },
        {
            "course":"人工智能导论",
            "teacher":"熊晗",
            "class_name":"19软件2",
            "zc":"2-9,11-13",
            "week":2,
            "place":"B310",
            "start_class":"6",
            "end_class":"8",
            "start_time":"14:00",
            "end_time":"16:20"
        },
        {
            "course":"形势与政策4",
            "teacher":"周媛",
            "class_name":"19软件1、2合班",
            "zc":"7-9,11",
            "week":3,
            "place":"C403",
            "start_class":"4",
            "end_class":"5",
            "start_time":"10:30",
            "end_time":"12:00"
        },
        {
            "course":"Web应用开发-Asp.Net",
            "teacher":"蔡茜",
            "class_name":"19软件2",
            "zc":"1-2,6,8-17",
            "week":4,
            "place":"A101",
            "start_class":"1",
            "end_class":"3",
            "start_time":"8:00",
            "end_time":"10:20"
        },
        {
            "course":"信息系统综合开发实训(.NET)",
            "teacher":"蔡茜",
            "class_name":"19软件2",
            "zc":"8-19",
            "week":4,
            "place":"A101",
            "start_class":"6",
            "end_class":"8",
            "start_time":"14:00",
            "end_time":"16:20"
        },
        {
            "course":"软件工程",
            "teacher":"叶超",
            "class_name":"19软件2",
            "zc":"3-6,8-18",
            "week":5,
            "place":"A217",
            "start_class":"1",
            "end_class":"3",
            "start_time":"8:00",
            "end_time":"10:20"
        },
        {
            "course":"Web编程基础",
            "teacher":"李麒骥",
            "class_name":"19软件2",
            "zc":"8",
            "week":7,
            "place":"C408",
            "start_class":"6",
            "end_class":"8",
            "start_time":"14:00",
            "end_time":"16:20"
        }
    ],
    "class_num":9,
    "week_num":8,
    "date":{
        "seconds":10,
        "minutes":40,
        "hours":9,
        "mday":20,
        "wday":2,
        "mon":4,
        "year":2021,
        "yday":109,
        "weekday":"Tuesday",
        "month":"April",
        "0":1618882810
    }
}
```

部分返回说明

|参数|说明|
|--|--|
|classtime内的class_name|上课的班级|
|class_num|本次输出内有多少节课，type=1时即一周共多少节大课，type=2时即当天多少节大课|
|date|被查询日期的一系列时间参数（年月日时分秒周），但如果是周次查询时，输出的是该周周一数据|
