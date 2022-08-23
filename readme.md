博客查看样式更佳→[我的博客](https://blog.ayano.top/archives/483/)

### openid的获取

可参考这篇[文章](https://blog.ayano.top/archives/487/)

### 接口说明

> 接口数据源取自学校微信公众号内个人课表，数据与个人课表是实时同步的


<br/>

在线接口地址:</br>
https://t.ayano.top</br>

返回格式:</br>
type=1,2,3时是json;type=4时是html网页</br>

请求方式:</br>
GET</br>
请求示例:</br>
https://t.ayano.top/?openid=o4Kckt8_djJfQqr1guobMwmlT9ME&type=4&zc=9</br>
参数说明:</br>

|<font color=DeepSkyBlue>参数<font>|<font color=DeepSkyBlue>必填<font>|<font color=DeepSkyBlue>默认值<font>
|<font color=DeepSkyBlue>type要求<font>|<font color=DeepSkyBlue>说明<font>|
|--|--|--|--|--|
|openid|是|无||微信公众号个人凭证，目前只可抓包获取|
|type|否|4||1 周次查询 2 按天查询 3 日期查询 4 周次查询（网页输出）|
|zc|否|当前周次|type=1,4时需要该参数|需要查询的周次|
|day|否|0|type=2时需要该参数|偏移天数，0表示当天，正数为今天之后多少天，如1代表明天，负数则相反|
|date|否|当天|type=3时需要该参数|具体日期 格式为 2021-4-5|

返回示例(type=2,3)(type=1时除date部分外其他部分结构与之相同):

```json
{
  "openid": "o4Kckt8_djJfQqr1guobMwmlT9ME",
  "start_time": [
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
  "end_time": [
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
  "classtime": [
    {
      "course": "Web编程基础",
      "teacher": "李麒骥",
      "class_name": "19软件2",
      "zc": "2-9,11-16",
      "week": 2,
      "place": "A513",
      "start_class": "1",
      "end_class": "3",
      "start_time": "8:00",
      "end_time": "10:20"
    },
    {
      "course": "Web应用开发-Asp.Net",
      "teacher": "蔡茜",
      "class_name": "19软件2",
      "zc": "7-9,11",
      "week": 2,
      "place": "A101",
      "start_class": "4",
      "end_class": "5",
      "start_time": "10:30",
      "end_time": "12:00"
    },
    {
      "course": "人工智能导论",
      "teacher": "熊晗",
      "class_name": "19软件2",
      "zc": "2-9,11-13",
      "week": 2,
      "place": "B310",
      "start_class": "6",
      "end_class": "8",
      "start_time": "14:00",
      "end_time": "16:20"
    }
  ],
  "class_num": 3,
  "week_num": 9,
  "date": {
    "seconds": 0,
    "minutes": 0,
    "hours": 0,
    "mday": 27,
    "wday": 2,
    "mon": 4,
    "year": 2021,
    "yday": 116,
    "weekday": "Tuesday",
    "month": "April",
    "0": 1619452800
  }
}
```

部分返回说明

|参数|说明|
|--|--|
|classtime内的class_name|上课的班级|
|class_num|本次输出内有多少节课，type=1时即一周共多少节大课，type=2时即当天多少节大课|
|date|被查询日期的一系列时间参数（年月日时分秒周），但如果是周次查询时，输出的是该周周一到周日的月份与日期数据|

type=1(周次查询)时的date输出内容

```json
"date":{
"1": {
"month": "4",
"day":"26"
},
"2": {
"month": "4",
"day": "27"
},
"3": {
"month":"4",
"day": "28"
},
"4": {
"month": "4",
"day": "29"
},
"5": {
"month": "4",
"day": "30"
},
"6": {
"month": "5",
"day":"1"
},
"7": {
"month": "5",
"day": "2"
}
}
```

返回示例(type=4):(pc版与手机版页面样式会有一定不同，主要是考虑的手机版样式)
![手机版样式](https://blog.ayano.top/usr/uploads/2021/04/1424179887.png)

### 源码下载

接口源码下载:
https://github.com/Cypas/cqtbi_class
有github账号的麻烦顺便点个star更好
