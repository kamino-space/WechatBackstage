<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/29,下午 03:19
 * Description:
 * Version:
 */

function myName( $arr, $uid ) {
	$name = $arr[0];
	if ( \sw\sw_user::updateName( $uid, $name ) ) {
		return array( "msg" => array( "你好, " . \sw\sw_user::userName( $uid ) ), "type" => 0 );
	} else {
		return array( "msg" => array( "失败了啊" ), "type" => 0 );
	}

}

addAction( "myname", "myName" );