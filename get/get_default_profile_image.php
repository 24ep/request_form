<?php
function profile_image($firstname,$department){

if(strpos($department,'Content')!==false){
    $backgroud_profile_image = "#dc3545";
}else{
    $backgroud_profile_image = "#222f3e";
}
$image = '
<div style="   
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: '.$backgroud_profile_image.';
            font-size: 18px;
            color: #fff;
            text-align: center;
            line-height: 35px;
            top: 0px;"
            >
            '.substr(ucwords($firstname),0,1).'
</div>';
return $image;
}
?>