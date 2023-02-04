
<?php
$configurable_session_map = array("General Settings","Tools Setting","Table Settings");
//  session |icon | table | header | description
$configurable_map = array (
    array(
        'session'=>'General Settings',
        'icon'=>'people',
        'table'=>'account',
        'title'=>' accounts',
        'function'=>'get_page',
        'description'=>'Manage any register account in system'),
    array(
        'session'=>'General Settings',
        'icon'=>'rocket',
        'table'=>'add_new_job',
        'title'=>'add_new_job',
        'function'=>'get_attribute_config',
        'description'=>'Manage attribute of new product creation (NS ticket)'),
    array(
      'session'=>'General Settings',
        'icon'=>'grid',
        'table'=>'job_cms',
        'title'=>'job_cms',
        'function'=>'get_attribute_config',
        'description'=>'manage attribute of new product creation (production job)'),
    array(
        'session'=>'General Settings',
        'icon'=>'ticket',
        'table'=>'content_request',
        'title'=>'content_request',
        'function'=>'get_attribute_config',
        'description'=>'Manage attribute of new product update (CR,DP ticket)'),
    array(
          'session'=>'Tools Settings',
          'icon'=>'apps',
          'table'=>'app_version_control',
          'title'=>'LinesheetApp',
          'function'=>'get_page',
          'description'=>'Manage lineshetAPP'),
    array(
          'session'=>'Tools Setting',
          'icon'=>'swap-horizontal',
          'table'=>'convert_mapping',
          'title'=>'Convert Mapping',
          'function'=>'get_page',
          'description'=>'Manage an converting of linesheet to PIM template'),
    array(
            'session'=>'Tools Setting',
            'icon'=>'cube',
            'table'=>'powerautomate',
            'title'=>'Power Automate',
            'function'=>'get_page',
            'description'=>'Manage an automation workflows for create new job (auto generate new ticket from email)'),
    array(
        'session'=>'Table Settings',
        'icon'=>'settings',
        'table'=>'job_attribute',
        'title'=>'Attribute setting',
        'function'=>'get_attribute_config',
        'description'=>'Manage an attribute of config table'),
    array(
        'session'=>'Table Settings',
        'icon'=>'settings',
        'table'=>'job_attribute_option',
        'title'=>'Attribute option setting',
        'function'=>'get_attribute_config',
        'description'=>'Manage an attribute of config table')

);
$length_configurable_session_map = count($configurable_session_map);
$length_configurable_map = count($configurable_map);
for ($i=0; $i < $length_configurable_session_map; $i++) {
    echo '<h5 class="bg-gradient header_configurable bg-secondary shadow-sm bg-opacity-50"">'.$configurable_session_map[$i].'</h5>
    <div class="row row-cols-1 row-cols-md-3 g-4 m-3">';
    for ($j=0; $j  < $length_configurable_map; $j++) {
        if($configurable_session_map[$i]==$configurable_map[$j]['session']){
            echo '
            <div class="col" onclick="'.$configurable_map[$j]['function'].'(&#39;'.$configurable_map[$j]['table'].'&#39;)">
                <div class="card p-3 shadow-sm border-0">
                    <ion-icon name="'.$configurable_map[$j]['icon'].'" style="font-size: 50px;color: #ababab;margin:0px 15px;"></ion-icon>
                    <div class="card-body">
                        <h5 class="card-title">'.$configurable_map[$j]['title'].'</h5>
                        <p class="card-text">'.$configurable_map[$j]['description'].'</p>
                    </div>
                </div>
            </div>
            ';
        }
    }
    echo '</div>';
}

?>


