<?php
/**
 * Author: kamino
 * CreateTime: 2018/5/29,下午 10:24
 * Description: 微信web app
 * Version: 1.2.1
 */

ob_start();

if ( ! empty( $_GET["v"] ) ) {
	switch ( $_GET["v"] ) {
		case "static":
			require ROOT_PATH . "template/web/staticLoader.php";
			break;
		default:
			require ROOT_PATH . "template/web/appLoader.php";
			break;
	}
} else {
	require ROOT_PATH . "template/web/index_page.php";
}

ob_end_flush();