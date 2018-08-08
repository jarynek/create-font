<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 08.08.2018
 * Time: 13:56
 */

namespace User\Controller;


use App\Service\userService;


class UserController {

	private $user;

	public function __construct() {
		$this->user = new userService();
	}

	/**
	 * Get User
	 * @return array
	 */
	public function getUser(): array {
		return $this->user->setUser();
	}
}