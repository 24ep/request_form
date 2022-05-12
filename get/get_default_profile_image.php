<?php
function profile_image($firstname){
$image = '
<div style="   
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #222f3e;
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