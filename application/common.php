<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status) {
    if($status == 1) {
        $str = "<span class=\"label label-success radius\">正常</span>";
    }elseif($status ==0) {
        $str = "<span class=\"label label-danger radius\">待审</span>";
    }else {
        $str = "<span class=\"label label-danger radius\">删除</span>";
    }
    return $str;
}

/**
 * 通用的分页样式
 * @param $obj
 */
function pagination($obj) {
    if(!$obj) {
        return '';
    }
    // 优化的方案
    $params = request()->param();
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->appends($params)->render().'</div>';
}

/**
 * @param $url
 * @param int $type 0 get  1 post
 * @param array $data
 */
function doCurl($url, $type=0, $data=[]) {
    $ch = curl_init(); // 初始化
    // 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER,0);

    if($type == 1) {
        // post
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    //执行并获取内容
    $output = curl_exec($ch);
    // 释放curl句柄
    curl_close($ch);
    return $output;
}

/**
 * 发起http请求
 * @param string $url 目标url
 * @param string $body 需要发送的数据，json字符串之类的
 * @param string $method 请求方法，get put post delete
 * @param array $headers 请求头
 * @param bool $certPath 证书路径
 * @return void
 */
function http_request($url,$body='',$method='GET', $headers=[],$certPath=false){
    $options = [
        CURLOPT_URL => $url,
        // 将curl_exec()获取的信息以文件流的形式返回，而不是直接输出
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_INFILESIZE => -1,
        // 请求时间
        CURLOPT_TIMEOUT => 60,
        // 请求方法
        CURLOPT_CUSTOMREQUEST => $method,
        // 是否启用证书验证
        CURLOPT_SSL_VERIFYHOST => false,
        // 检查公用名是否存在，并且是否与提供的主机名匹配。 和证书验证一起使用
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER => true,
    ];

    if( $body != "" ) {
        $options[CURLOPT_POSTFIELDS] = $body;
    }
    // 设置method
    if( $method === "POST" ) {
        $options[CURLOPT_POST] = true;
    } else if(  $method !== "GET" ) {
        $options[ CURLOPT_CUSTOMREQUEST ] = $method;
    }

    if ( count($headers) )
    {
        $dataHeaders = [];
        foreach ($headers as $key => $value)
            $dataHeaders[] = $key . ': ' . $value;

        $options[ CURLOPT_HTTPHEADER ] = $dataHeaders;
    }

    if ( $certPath )
        $options[CURLOPT_CAINFO] = $certPath;

    $result = [];
    $result["error"] = false;
    $result["content"] = null;

    try
    {
        // 初始化一个 curl 会话
        if (!$curl = curl_init())
            throw new Exception('Unable to initialize cURL');

        if (!curl_setopt_array($curl, $options))
            throw new Exception(curl_error($curl));

        $response = curl_exec($curl);
        if(  $response === false ) {
            throw new Exception( curl_error($curl) );
        }

        $result["responseCode"] = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
        $headerSize = curl_getinfo( $curl, CURLINFO_HEADER_SIZE );
        $result["content"] = substr( $response, $headerSize );

        //    prevent PHP from returning false
        if( !$result["content"] )
            $result["content"] = "";

        $result["header"] = substr( $response, 0, $headerSize );

        // 关闭 curl 会话资源
        curl_close($curl);
    }
    catch ( Exception $e )
    {
        $result["error"] = "CURL error: " . $e->getMessage();
    }

    return $result;
}
