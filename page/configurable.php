
<?php
$configurable_session_map = array("General Settings","Table Setting","Tools Setting","Table Settings");
//  session |icon | table | header | description
$configurable_map = array (
    array(
        'session'=>'General Settings',
        'icon'=>'people',
        'table'=>'account',
        'database'=>'all_in_one_project',
        'prefix'=>'ac',
        'title'=>'Accounts management',
        'function'=>'get_page',
        'description'=>'Manage any register account in system'),
    array(
        'session'=>'General Settings',
        'icon'=>'file-tray-stacked',
        'table'=>'project_bucket',
        'database'=>'all_in_one_project',
        'prefix'=>'pb',
        'title'=>'Project bucket',
        'function'=>'get_page',
        'description'=>'Manage bucket of request'),
    array(
        'session'=>'General Settings',
        'icon'=>'file-tray-stacked',
        'table'=>'origin_of_ticket',
        'database'=>'all_in_one_project',
        'prefix'=>'oi',
        'title'=>'Origin of ticket',
        'function'=>'get_page',
        'description'=>'Manage origin of request'),
    array(
        'session'=>'Table Setting',
        'icon'=>'rocket',
        'table'=>'add_new_job',
        'database'=>'all_in_one_project',
        'prefix'=>'anj',
        'title'=>'add_new_job',
        'function'=>'get_attribute_config',
        'description'=>'Manage attribute of new product creation (NS ticket)'),
    array(
        'session'=>'Table Setting',
        'icon'=>'grid',
        'table'=>'job_cms',
        'title'=>'job_cms',
        'database'=>'u749625779_cdscontent',
        'prefix'=>'jc',
        'function'=>'get_attribute_config',
        'description'=>'manage attribute of new product creation (production job)'),
    array(
        'session'=>'Table Setting',
        'icon'=>'ticket',
        'table'=>'content_request',
        'database'=>'all_in_one_project',
        'prefix'=>'cr',
        'title'=>'content_request',
        'function'=>'get_attribute_config',
        'description'=>'Manage attribute of new product update (CR,DP ticket)'),
    array(
        'session'=>'Table Setting',
        'icon'=>'people',
        'table'=>'account',
        'database'=>'all_in_one_project',
        'prefix'=>'cr',
        'title'=>'account',
        'function'=>'get_attribute_config',
        'description'=>'Manage attribute of register accounts'),
    array(
          'session'=>'Tools Setting',
          'icon'=>'apps',
          'table'=>'app_version_control',
          'database'=>'all_in_one_project',
          'prefix'=>'avc',
          'title'=>'LinesheetApp',
          'function'=>'get_page',
          'description'=>'Manage lineshetAPP'),
    array(
          'session'=>'Tools Setting',
          'icon'=>'swap-horizontal',
          'table'=>'convert_mapping',
          'database'=>'external_link',
          'prefix'=>'cm',
          'title'=>'Convert Mapping',
          'function'=>'get_page',
          'description'=>'Manage an converting of linesheet to PIM template'),
    array(
            'session'=>'Tools Setting',
            'icon'=>'cube',
            'table'=>'powerautomate',
            'database'=>'external_link',
            'prefix'=>'pa',
            'title'=>'Power Automate',
            'function'=>'get_page',
            'description'=>'Manage an automation workflows for create new job (auto generate new ticket from email)'),
    array(
        'session'=>'Table Settings',
        'icon'=>'settings',
        'table'=>'job_attribute',
        'database'=>'u749625779_cdscontent',
        'prefix'=>'ja',
        'title'=>'Attribute setting',
        'function'=>'get_attribute_config',
        'description'=>'Manage an attribute of config table'),
    array(
        'session'=>'Table Settings',
        'icon'=>'settings',
        'table'=>'job_attribute_option',
        'database'=>'u749625779_cdscontent',
        'prefix'=>'jao',
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
            <div class="col" onclick="'.$configurable_map[$j]['function'].'(&#39;'.$configurable_map[$j]['table'].'&#39;,&#39;'.$configurable_map[$j]['database'].'&#39;,&#39;'.$configurable_map[$j]['prefix'].'&#39;)">
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


