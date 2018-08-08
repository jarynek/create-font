<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 08.08.2018
 * Time: 13:53
 */

namespace App\user;

use App\Service\userService;


class UserController {

	public function getUser():array{
		return ['user'=>'jarek'];
	}
}