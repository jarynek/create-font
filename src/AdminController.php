<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 01.08.2018
 * Time: 10:09
 */

namespace App\Controller;

use App\Service\CreateFontsService;


class AdminController {

	private $create_font_service;

	public function __construct() {
		$this->create_font_service = new CreateFontsService();
	}

	/**
	 * homepageAction
	 */
	public function homepageAction() {
		try{
			$this->create_font_service->uploadFiles();
			$this->create_font_service->createFont();
			$this->create_font_service->createReadme();
			$this->create_font_service->zipPackage();
		}catch (\Exception $exception){
			echo $exception->getMessage();
		}
	}

	/**
	 * downloadAction
	 */
	public function downloadAction(){
		try{
			$this->create_font_service->downloadPackage();
		}catch (\Exception $exception){
			echo $exception->getMessage();
		}
	}
}