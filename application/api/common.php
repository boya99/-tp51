<?php
function show($status,$message='',$data){
    $data = [
        'status'=>intval($status),
        'message'=>$message,
        'data'=>$data?:[],
    ];
    return json($data);

}
