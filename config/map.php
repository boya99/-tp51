<?php
//百度地图配置文件
return [
    'ak'=>env('baidu.ak')?:'',
    'url'=>env('baidu.url')?:'',
    'geocoder'=>env('baidu.geocoder')?:'',
    'width'=>400,
    'height'=>300,
    'staticimage'=>'staticimage/v2'
];