<?php
/**
 * Author: kamino
 * CreateTime: 2018/5/30,下午 05:07
 * Description:
 * Version:
 */

function loadStatic( $path, $mine = "text/txt" ) {
	switch ( $mine ) {
		case "css":
			header( "Content-Type: text/css" );
			break;
		case "js":
			header( "Content-Type: application/javascript" );
			break;
		case "jpg":
			header( "Content-Type: image/jpeg" );
			break;
		case "png":
			header( "Content-Type: image/png" );
			break;
		case "gif":
			header( "Content-Type: image/gif" );
			break;
		default:
			header( "Content-Type: text/txt" );
			break;
	}
	$f       = fopen( $path, "rb" );
	$content = fread( $f, filesize( $path ) );
	fclose( $f );
	echo $content;
}

/*
 * app
 * path
 * type
 */

if ( empty( $_GET["app"] ) || empty( $_GET["path"] ) ) {
	require ROOT_PATH . "template/error/404.php";
	exit( 1 );
}

$staticType = "text/txt";
$appName    = htmlspecialchars( $_GET["app"] );
$staticPath = htmlspecialchars( $_GET["path"] );
$staticType = htmlspecialchars( $_GET["type"] );

$appConfig = \sw\sw_web::loadApp( $appName );

if ( $appConfig === false ) {
	require ROOT_PATH . "template/error/404.php";
	exit( 1 );
}

$realPath = ROOT_PATH . "template/web/apps/" . $appName . "/" . $staticPath;

if ( ! file_exists( $realPath ) ) {
	require ROOT_PATH . "template/error/404.php";
	exit( 1 );
}

@loadStatic( $realPath, $staticType );

/*
if ( empty( $_GET["app"] ) ) {
	require ROOT_PATH . "template/error/404.php";
} else {
	$appName = $_GET["app"];
}

if ( empty( $_GET["type"] ) ) {
	require ROOT_PATH . "template/error/404.php";
} else {
	$fileType = $_GET["type"];
}

if ( empty( $_GET["id"] ) ) {
	$fileId = 0;
} else {
	$fileId = $_GET["id"];
}

$appConfig = \sw\sw_web::loadApp( $appName );

if ( $appConfig === false ) {
	require ROOT_PATH . "template/error/404.php";
}

if ( isset( $appConfig[ $fileType ][ $fileId ] ) ) {
	$filePath = $appConfig[ $fileType ][ $fileId ];
	if ( ! file_exists( $filePath ) ) {
		require ROOT_PATH . "template/error/404.php";
	}
	loadStatic( $filePath, $fileType );
} else {
	require ROOT_PATH . "template/error/404.php";
}
*/