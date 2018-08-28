<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/28,上午 11:46
 * Description:
 * Version:
 */

function demo( $a ) {

	return array( "msg" => array( "your value is " . implode( "-", $a ) ), "type" => 0 );
}

addAction( "demo", "demo" );