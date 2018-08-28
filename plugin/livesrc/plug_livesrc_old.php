<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/29,下午 03:48
 * Description:
 * Version:
 */

function getLiveSrc( $arr, $uid ) {
	//print_r( $arr );
	if ( $list = getPlayUrl( getRoomId( getLiveID( $arr[0] ) ) ) ) {
		$res = "下载链接:\r\n";
		$res .= implode( "\r\n\r\n", $list );
	} else {
		$res = "失败了啊QAQ";
	}

	return array( "msg" => array( $res ), "type" => 0 );
}

function getRoomId( $id ) {
	$wch = new wcurl();
	$url = "https://api.live.bilibili.com/room/v1/Room/room_init?id=" . $id;
	$raw = json_decode( $wch->setUrl( $url )->get(), true );
	if ( ! $raw["code"] == 0 ) {
		return false;
	}

	return $raw["data"]["room_id"];
}

function getPlayUrl( $room_id ) {
	$wch = new wcurl();
	$url = "https://api.live.bilibili.com/room/v1/Room/playUrl?cid={$room_id}&quality=0&platform=web";
	$raw = json_decode( $wch->setUrl( $url )->get(), true );
	if ( ! $raw["code"] == 0 ) {
		return false;
	}
	$list = array();
	foreach ( $raw["data"]["durl"] AS $item ) {
		$list[] = $item["url"];
	}

	return $list;
}

function getLiveID( $url ) {
	$str = "/[1-9]\d*/";
	preg_match( $str, $url, $match );

	return $match[0];
}

//addAction( "livesrc", "getLiveSrc" );

