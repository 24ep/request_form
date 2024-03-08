<?php

 session_start();

function profile_image($firstname,$department,$size,$username,$position_image){



$ch = curl_init("https://phpstack-1225538-4364543.cloudwaysapps.com/image/user_profile/".$username.".jpg");

curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers

curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch, CURLOPT_TIMEOUT,10);

$output = curl_exec($ch);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);



if($httpcode==200) {

    return ' <img  data-bs-toggle="tooltip" data-bs-placement="top" title="'.$username.'"

     width="'.$size.'px"  height="'.$size.'px" 

     src="image/user_profile/'.$username.'.jpg" 

     class="rounded-circle" alt="'.$username.'">';



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



function profile_avatar($firstname,$department,$size){

    switch ($department) {

        case "Content Followup": $bg = '336BFF'; break;

        case "Content Traffic": $bg = '33FF39'; break;

        case "Content Admin": $bg = '9633FF'; break;

        case "Content Other": $bg = 'FF3333'; break;

        case "Content Studio Traffic": $bg = '33FFB5'; break;

        case "Buyer  Home": $bg = 'FFDA33'; break;

        case "Buyer Beauty": $bg = 'FF7AD9'; break;

        case "Buyer Mom and Kids": $bg = 'FFC17A'; break;

        case "Buyer Fashion": $bg = 'FF7A7A'; break;

        case "Operation": $bg = '000000'; break;

        case "Marketing": $bg = '474747'; break;

        case "Other": $bg = 'ADADAD'; break;

        case "Brand": $bg = '6E69E7'; break;

        

        default: $bg = '000000';

      }

        $image = '<img src="https://ui-avatars.com/api/?name='.$firstname.'&background='.$bg.' ?>&color=fff&rounded=true&length=1&size='.$size.'">';

        return $image;

    

}

function profile_avatar_medium($firstname,$lastname,$department,$size){

    switch ($department) {

        case "Content Followup": $bg = '336BFF'; break;

        case "Content Traffic": $bg = '33FF39'; break;

        case "Content Admin": $bg = '9633FF'; break;

        case "Content Other": $bg = 'FF3333'; break;

        case "Content Studio Traffic": $bg = '33FFB5'; break;

        case "Buyer  Home": $bg = 'FFDA33'; break;

        case "Buyer Beauty": $bg = 'FF7AD9'; break;

        case "Buyer Mom and Kids": $bg = 'FFC17A'; break;

        case "Buyer Fashion": $bg = 'FF7A7A'; break;

        case "Operation": $bg = '000000'; break;

        case "Marketing": $bg = '474747'; break;

        case "Other": $bg = 'ADADAD'; break;

        case "Brand": $bg = '6E69E7'; break;

        

        default: $bg = '000000';

      }

        $image = '<img src="https://ui-avatars.com/api/?name='.$firstname.'+'.$lastname.'&background='.$bg.' ?>&color=fff&rounded=true&length=2&size='.$size.'">';

        return $image;

    

}





?>