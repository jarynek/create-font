<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 01.08.2018
 * Time: 10:04
 */

require_once( dirname( __FILE__ ) . '/config/service.php' );
require_once( dirname( __FILE__ ) . '/config/bundles.php' );

$AdminController = new \App\Controller\AdminController();
$UserController = new \User\Controller\UserController();

echo '<pre>';
print_r($UserController->getUser());
echo '</pre>';

if(isset($_GET['download']) &&$_GET['download'] !== ''){
	$AdminController->downloadAction();
}else{
	$AdminController->homepageAction();
}

include_once ('template/homepage.php');