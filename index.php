<?php

//	BOOT
require_once 'assets/script/boot.php';

//	GET page
$arrPath					= explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$page						= Page::getByPathArray($arrPath);

//	GET view menu
$viewManager				= new ViewManager(ABS_ROOT.'views/');

//	IF showing atomic element
if($_GET['t'])
{
	//	CHECK for json
	$twigPath			    = $_GET['t'];
    $arrData                = $viewManager->getJsonForTwig($twigPath);
	
	//	SET data
	$arrData['template']	= $twigPath;
	
	//	LOAD atomic template
	$template				= $twig->loadTemplate('template/template.twig');
}
//	IF showing page
else
{
	//	SET data
	$arrData				= $page->getData();
	
	//	LOAD page template
	$template				= $twig->loadTemplate('page/'.$page->name.'.twig');
}

//	SET global data
$arrData['root']			= ROOT;
$arrData['viewTree']		= $viewManager->getTreeData();

//	DISPLAY twig
$template->display($arrData);