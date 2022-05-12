<?php
function profile_image($firstname,$department,$size,$username,$position_image){

$ch = curl_init("https://content-service-gate.cdse-commercecontent.com/base/image/user_profile/".$username.".jpg");
curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT,10);
$output = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($httpcode==200) {
    return ' <img  data-bs-toggle="tooltip" data-bs-placement="top" title="'.$username.'"
     width="'.$size.'px" style="margin-left: -12px;" height="'.$size.'px" 
     src="base/image/user_profile/'.$username.'.jpg" 
     class="rounded-circle" alt="'.$username.'">';

    // echo '<img data-bs-toggle="tooltip" data-bs-placement="top" title=""
    // width="'.$size.'px" height="'.$size.'px" src="base/image/user_profile/'.$username.'.jpg"
    // class="rounded-circle" alt="'.$username.'">';
}else{
    if(strpos($department,'Content')!==false){
        $backgroud_profile_image = "#dc3545";
    }else{
        $backgroud_profile_image = "#222f3e";
    }
    
    $size_front = $size/2;
    $left_position_image = ($size_front*$position_image)-(5*$position_image);
    $image = '
    <div style="   
                width: '.$size.'px;
                height: '.$size.'px;
                border-radius: 50%;
                background: '.$backgroud_profile_image.';
                font-size: '.ceil($size_front).'px;
                color: #fff;
                text-align: center;
                line-height: '.$size.'px;
                "
                >
                '.substr(ucwords($firstname),0,1).'
    </div>';
    return $image;
}

}
?>