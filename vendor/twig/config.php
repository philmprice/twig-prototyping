<?php

//	REGISTER
Twig_Autoloader::register(true);

//	LOADER
$twig_loader	= new Twig_Loader_Filesystem( array(ABS_ROOT.'views/'));

//	ENVIRONMENT
$twig			= new Twig_Environment($twig_loader, array(
					'cache' => false //dirname(__FILE__).'/cache'
				));

$function		= new Twig_SimpleFunction('inc', function(Twig_Environment $env, $context, $template, $variables = array(), $withContext = true, $ignoreMissing = false, $sandboxed = false) {
					
					//	GET json filename
					$jsonFilename			= str_replace('.twig', '.json', $template);
					
					//	IF json default data exists
					if(file_exists(ABS_ROOT.'views/'.$jsonFilename))
					{
						//	GET data
						$arrData			= json_decode(file_get_contents(ABS_ROOT.'views/'.$jsonFilename), true);
						
						//	MERGE data into context
						foreach($arrData AS $key => $data)
						{
							if(!array_key_exists($key, $context))
							{
								$context[$key]	= $data;
							}
						}
					}
	
					//	INCLUDE and display template
					echo twig_include($env, $context, $template, $variables, $withContext, $ignoreMissing, $sandboxed);
	
				}, array('needs_environment' => true, 'needs_context' => true));
$twig->addFunction($function);

//	FILENAME SUFFIX filter
$function		= new Twig_SimpleFunction('defaultData', function(&$context) {
					
					$context['debug']= "this has changed!";
					$context['items']= array(
										"0"	=> array('date'		=> '1/1',
													 'headline'	=> 'Testing 12345678'),
										"1"	=> array('date'		=> '2/2',
													 'headline'	=> 'Testing 23456789')
									);
				}, array('needs_context'	=> true));
$twig->addFunction($function);

//	FILENAME SUFFIX filter
$filter			= new Twig_SimpleFilter('size_*', function ($suffix, $filename) {
					$dot_position	= strrpos($filename, ".");
					$filename_base	= substr($filename, 0, $dot_position);
					$filename_ext	= substr($filename, $dot_position);
					$newname		= $filename_base . '_' . $suffix . $filename_ext;

					return $newname;
				});
$twig->addFilter($filter);

//	ABRIDGE filter
$filter			= new Twig_SimpleFilter('char_limit_*', function ($intCharCount, $string) {
					if(strlen($string) < $intCharCount)
					{
						$string = substr($string, 0, $intCharCount).'...';
					}

					return $string;
				});
$twig->addFilter($filter);

