<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/28,上午 12:43
 * Description:
 * Version:
 */

namespace sw;


class sw_setplug {

	/*
	 * 获取插件列表，正确的插件格式为: {插件名}/plug_{插件名}.php
	 * @return array
	 */
	static function plugList() {
		$file_list = scandir( ROOT_PATH . "plugin", false );
		unset( $file_list[0], $file_list[1] );
		foreach ( $file_list AS $n => $item ) {
			if ( ! file_exists( ROOT_PATH . "plugin/{$item}/plug_{$item}.php" ) ) {
				unset( $file_list[ $n ] );
			}
		}
		sort( $file_list );

		return $file_list;
	}

	/*
	 * 获取已经启用的插件列表
	 * @return array
	 */
	static function plugListOn() {
		$list = array();
		foreach ( self::plugList() AS $item ) {
			if ( file_exists( ROOT_PATH . "plugin/{$item}/run" ) ) {
				$list[] = $item;
			}
		}

		return $list;
	}

	/*
	 * 查看插件启动状态
	 * @return true|false
	 */
	static function plugStatus( $name ) {
		if ( file_exists( ROOT_PATH . "plugin/{$name}/run" ) ) {
			return true;
		} else {
			return false;
		}
	}

	/*
	 * 启动指定插件
	 * @return 0|1|2|3 插件不存在|启用成功|插件已启用|可能是权限不足
	 */
	static function openPlug( $name ) {
		if ( ! file_exists( ROOT_PATH . "plugin/{$name}/plug_{$name}.php" ) ) {
			return 0;
		}
		if ( file_exists( ROOT_PATH . "plugin/{$name}/run" ) ) {
			return 2;
		}
		@file_put_contents( ROOT_PATH . "plugin/{$name}/run", "" );

		return 1;

	}

	/*
	 * 关闭指定插件
	 * @return true|false
	 */
	static function offPlug( $name ) {
		if ( @unlink( ROOT_PATH . "/plugin/{$name}/run" ) ) {
			return true;
		} else {
			return false;
		}
	}

	/*
	 * 插件列表+状态
	 */
	static function allPlug() {
		$all  = self::plugList();
		$on   = self::plugListOn();
		$list = array();
		foreach ( $all AS $n => $item ) {
			$list[ $n + 1 ]["name"] = $item;
			if ( array_search( $item, $on ) !== false ) {
				$list[ $n + 1 ]["status"] = "on";
			} else {
				$list[ $n + 1 ]["status"] = "off";
			}
		}

		return $list;
	}

}