<?php
/*
 * Function to return config data
 */
function config($config,$default=null){
    return isset($GLOBALS['APP_CONFIG'][$config]) ?  $GLOBALS['APP_CONFIG'][$config] : $default;
}
