<?php
/**
 * Author: kamino
 * CreateTime: 2018/5/30,下午 06:35
 * Description:
 * Version:
 */

$appName = $_GET["v"];

$appList = \sw\sw_web::appList();

if ( ! array_search( $appName, $appList ) ) {
	require ROOT_PATH . "template/error/404.php";
}

$appConfig = \sw\sw_web::loadApp( $appName );

if ( isset( $appConfig["index"] ) && file_exists( $appConfig["index"] ) ) {
	require $appConfig["index"];
} else {
	require ROOT_PATH . "template/error/404.php";
	exit( 1 );
}