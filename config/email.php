<?php
//邮箱相关配置
return [
    'username'=>env('mail.username')?:'',
    'password'=>env('mail.authcode')?:'',
    'smtp'=>env('mail.smtp')?:'',
    'port'=>465,

];
