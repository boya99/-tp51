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
// 商户入驻申请的文案
function bisRegister($status) {
    if($status == 1) {
        $str = "入驻申请成功";
    }elseif($status == 0) {
        $str = "待审核，审核后平台方会发送邮件通知，请关注邮件";

    }elseif($status == 2) {
        $str = "非常抱歉，您提交的材料不符合条件，请重新提交";
    }else {
        $str = "该申请已被删除";
    }
    return $str;
}
