<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/29,上午 01:21
 * Description: 回复消息
 * Version:
 */

function textMsg( $arr, $uid ) {
	$msg = $arr[0];
	if ( \sw\sw_config::getConfig( "kwreply" ) && $reply = \sw\sw_diyreply::reply( $msg ) ) {

		return array( "msg" => array( $reply ), "type" => 0 );
	}
	if ( preg_match( "/\>\>(\w+||\d+||_)\:/", $msg, $f ) && preg_match( "/{$f[1]}\:(.*)/", $msg, $v ) ) {
		if ( empty( $function = $f[1] ) ) {
			return array( "msg" => array( "啥东西啊" ), "type" => 0 );
		}
		$value = explode( ",", $v[1] );
		if ( hasAction( $function ) ) {
			$res = doAction( $function, $value, $uid );
			if ( is_array( $res ) ) {
				return array( "msg" => $res["msg"], "type" => $res["type"] );
			} else {
				return array( "msg" => array( $res ), "type" => 0 );
			}
		} else {
			return array( "msg" => array( "unknown function " . $function ), "type" => 0 );
		}
	} elseif ( $msg == "【收到不支持的消息类型，暂无法显示】" ) {
		return array( "msg" => array( "难以理解" ), "type" => 0 );
	} else {
		if ( hasAction( "tulingAI" ) ) {

			return array( "msg" => array( doAction( "tulingAI", urlencode( $msg ), $uid ) ), "type" => 0 );
		} else {
			return array( "msg" => "自动回复", "type" => 0 );
		}
	}
}

addAction( "textMsg", "textMsg" );

function eventMsg( $arr, $uid ) {
	switch ( $arr[0] ) {
		case "subscribe":
			\sw\sw_user::newUser( $uid );

			return array( "msg" => array( \sw\sw_config::getConfig( "hellomsg" ) ), "type" => 0 );
			break;
		case "unsubscribe":
			\sw\sw_user::delUser( $uid );

			return array( "msg" => array( "取消关注" ), "type" => 0 );
			break;
		default:
			return array( "msg" => array( $arr[0] . $arr[1] ), "type" => 0 );
			break;
	}
}

addAction( "eventMsg", "eventMsg" );









