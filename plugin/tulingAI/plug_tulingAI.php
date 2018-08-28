<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/28,下午 12:40
 * Description:
 * Version:
 */


function tulingAI( $text, $uid ) {
	$url   = "http://www.tuling123.com/openapi/api";
	$key   = "7d83ee1868714f6aae96130e34e65313";
	$loc   = "";
	$uid   = substr( $uid, 5, 5 );
	$value = "key=$key&info=$text&loc=$loc&userid=$uid";
	$wch   = new wcurl( $url );
	$raw   = json_decode( $wch->post( $value ), true );
	switch ( $raw["code"] ) {
		case 100000:
		case 40002:
			return $raw["text"];
			break;
		case 200000:
			return $raw["text"] . " >> " . $raw["url"];
			break;
		default:
			return "";
			break;
	}
}

addAction( "tulingAI", "tulingAI" );