<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 01.08.2018
 * Time: 10:09
 */

namespace App\Controller;

use App\Service\FontsService;


class AdminController {

	private $font_service;

	public function __construct() {
		$this->font_service = new FontsService();
	}

	/**
	 * homepageAction
	 */
	public function homepageAction() {
		try{
			$this->font_service->uploadFiles();
			$this->font_service->createFont();
			$this->font_service->createReadme();
			$this->font_service->zipPackage();
			$this->font_service->cleanUp();
		}catch (\Exception $exception){
			echo $exception->getMessage();
		}
	}

	/**
	 * downloadAction
	 */
	public function downloadAction(){
		try{
			$this->font_service->downloadPackage();
		}catch (\Exception $exception){
			echo $exception->getMessage();
		}
	}
}