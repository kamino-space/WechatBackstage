<?php
/**
 * Author: kamino
 * CreateTime: 2018/5/29,下午 10:24
 * Description:
 * Version:
 */

namespace sw;


class sw_web {
	static function getJsapi( $apiList = array(), $tag = true ) {
		$js        = new \wx\wx_jsapi();
		$appid     = WX_APPID;
		$timestamp = $js->getTimestamp();
		$noncestr  = $js->getNoncestr();
		$signature = $js->getSignature();
		$debug     = WEB_DEBUG ? "true" : "false";
		$list      = empty( $apiList ) ? "" : "'" . implode( "','", $apiList ) . "'";
		if ( $tag ) {
			echo "<script>";
		}
		echo "wx.config({
                debug: {$debug},
                appId: '{$appid}',
                timestamp: '{$timestamp}',
                nonceStr: '{$noncestr}',
                signature: '{$signature}',
                jsApiList: [{$list}]
            });
            wx.error(function (msg) {
                alert(msg)
            })";
		if ( $tag ) {
			echo "</script>";
		}
	}

	static function appList() {
		$appList = scandir( ROOT_PATH . "template/web/apps", false );
		unset( $appList[0], $appList[1] );

		return $appList;
	}

	static function loadApp( $name ) {
		$path   = ROOT_PATH . "template/web/apps/" . $name . "/";
		$config = array();
		if ( ! file_exists( $path . "app_config.json" ) ) {
			return false;
		}
		if ( $raw = json_decode( file_get_contents( $path . "app_config.json" ), true ) ) {
			$config["name"]    = isset( $raw["name"] ) ? $raw["name"] : "default";
			$config["version"] = isset( $raw["version"] ) ? $raw["version"] : "unknown";
			$config["icon"]    = isset( $raw["icon"] ) ? $path . $raw["icon"] : ROOT_PATH . "source/image/lys.jpg";
			$config["index"]   = $path . $raw["index"];
			foreach ( $raw["js"] AS $js ) {
				$config["js"][] = $js;
			}
			foreach ( $raw["css"] AS $css ) {
				$config["css"][] = $css;
			}

			return $config;
		}

		return false;
	}

	static function getHeader( $name = "", $head = false ) {
		$config = true;
		if ( ! empty( $name ) ) {
			$config = self::loadApp( $name );
		}
		echo "<!DOCTYPE html>";
		echo "<html lang=\"zh-cmn-Hans\">";
		echo "<head>";
		echo "<meta charset=\"UTF-8\">";
		echo "<title>";
		echo $config ? $config["name"] . " - 四维平面" : "四维平面";
		echo "</title>";
		echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/source/css/weui.css\">";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/source/css/wx-web.css\">";
		if ( ! empty( $config["css"] ) ) {
			foreach ( $config["css"] AS $css ) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/web/static?app={$name}&type=css&path={$css}\">";
			}
		}
		echo "<script src=\"/source/js/jweixin-1.2.0.js\" type=\"text/javascript\"></script>";
		echo "<script src=\"/source/js/weui.min.js\" type=\"text/javascript\"></script>";
		echo "<script src=\"/source/js/jquery.min.js\" type=\"text/javascript\"></script>";
		echo "<script src=\"/source/js/wx-web.js\" type=\"text/javascript\"></script>";
		echo "<script src=\"/source/js/layer.js\" type=\"text/javascript\"></script>";
		if ( ! empty( $config["js"] ) ) {
			foreach ( $config["js"] AS $js ) {
				echo "<script src=\"/web/static?app={$name}&type=js&path={$js}\"  type=\"text/javascript\"></script>";
			}
		}
		echo " </head> ";
		echo $head ? "<div class=\"page_hd\">
    <h1 class=\"page_title\" onclick=\"window.location.reload()\">四维平面</h1>
    <p class=\"page_desc\">siweipingmian</p>
</div>
<div class=\"container\" id=\"container\">
</div>" : null;

		return $config;
	}

	static function getFooter( $link = "四维平面技术部" ) {
		echo "<div class=\"weui-footer\">
    <p class=\"weui-footer__links\">
        <a href=\"https://aikamino.cn/\" class=\"weui-footer__link\">{$link}</a>
    </p>
    <p class=\"weui-footer__text\">Copyright © 2018 四维平面</p>
</div>";
		echo "</html> ";
	}
}