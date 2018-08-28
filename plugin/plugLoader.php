<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/28,下午 12:21
 * Description:
 * Version:
 */


function addAction( $hook, $actionFunc ) {
	global $i;
	$i['plugins']['hook'][ $hook ][] = $actionFunc;

	return true;
}

function doAction( $hook ) {
	global $i;
	$args = array_slice( func_get_args(), 1 );
	if ( isset( $i['plugins']['hook'][ $hook ] ) ) {
		foreach ( $i['plugins']['hook'][ $hook ] as $function ) {
			$string = call_user_func_array( $function, $args );
		}

		return $string;
	} else {
		return false;
	}
}

function hasAction( $hook ) {
	global $i;

	return isset( $i['plugins']['hook'][ $hook ] );
}

//加载插件文件
foreach ( \sw\sw_setplug::plugListOn() AS $plug ) {
	require_once ROOT_PATH . "plugin/{$plug}/plug_{$plug}.php";
}
