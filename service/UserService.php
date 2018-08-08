<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 08.08.2018
 * Time: 13:47
 */

namespace App\Service;


class userService {

	public function setUser(): array {
		return ['user'=>['id'=>md5($_SERVER['HTTP_USER_AGENT'] .  $_SERVER['REMOTE_ADDR'])]];
	}
}