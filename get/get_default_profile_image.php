<?php
function profile_image($firstname,$department,$size){

if(strpos($department,'Content')!==false){
    $backgroud_profile_image = "#dc3545";
}else{
    $backgroud_profile_image = "#222f3e";
}
$size_front = $size/2;
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
            top: 0px;"
            >
            '.substr(ucwords($firstname),0,1).'
</div>';
return $image;
}
?>