<?php
/*
 * Function to return config data
 */

if(!function_exists("config")){
    function config($config,$default=null){
        return isset($GLOBALS['APP_CONFIG'][$config]) ?  $GLOBALS['APP_CONFIG'][$config] : $default;
    }
}
/*
 * LOAD CONFIG FILES EXCEPT app.php
 */

$config_dir=dirname(__FILE__);
$config_files=scandir($config_dir);
foreach ($config_files as $config_file){
    if(!in_array($config_file,[".","..","app.php"]))
        $GLOBALS['APP_CONFIG'][
            str_replace(".php","",$config_file)
        ]=require($config_dir.DIRECTORY_SEPARATOR.$config_file);
}
unset($config_files);
unset($config_dir);