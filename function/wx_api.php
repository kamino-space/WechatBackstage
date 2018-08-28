<?php
/**
 * Author: kamino
 * CreateTime: 2018/6/5,下午 09:21
 * Description:
 * Version:
 */

namespace wx;


class wx_api {
	/*
	 * 下载素材接口
	 */
	static function dlMedia( $media_id ) {
		$url   = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".wx_token::getToken()."&media_id=".$media_id;
		$param = array( "access_token"=>wx_token::getToken(),"media_id" => $media_id );
		$wch   = new \wcurl( $url );
		$raw   = $wch->get();

		print_r( $raw );

	}

	static function mediaList() {
		$url   = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=" . wx_token::getToken();
		$param = array(
			"type"   => "TYPE",
			"offset" => "OFFSET",
			"count"  => "COUNT"
		);
		$wch   = new \wcurl( $url );
		$raw   = $wch->post( $param );

		print_r( $raw );
	}
}