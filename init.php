<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/26,下午 11:15
 * Description:
 * Version:
 */

//一个全局变量
global $i;

//加载配置文件
require_once "sw_config.php";

//加载依赖类
$libs = scandir( ROOT_PATH . "library", false );
unset( $libs[0], $libs[1] );
foreach ( $libs AS $lib ) {
	require_once ROOT_PATH . "library/" . $lib;
}

//加载主程序
$funs = scandir( ROOT_PATH . "function", false );
unset( $funs[0], $funs[1] );
foreach ( $funs AS $fun ) {
	require_once ROOT_PATH . "function/" . $fun;
}

//加载插件
require_once ROOT_PATH . "plugin/plugLoader.php";