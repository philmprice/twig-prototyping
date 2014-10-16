<?php

/**
 * Page object, for doing all your pagey things.
 *
 * @author Phil M Price
 */
class Page {
    
    public	$json;
    public	$name;
    
    //  CONSTRUCT
    public function Page($name)
    {
        //  SET name
        $this->name     = $name;
    }

    //  GET an object by passing it's name.
    public static function getByName($name)
    {
        //  RETURN page object
        return new Page($name);
    }
	
	public static function getByPathArray($arrPath)
	{
		if(sizeof($arrPath) > 1)
		{
			$pageName		= $arrPath[1];
		}
		else
		{
			$pageName		= 'home';
		}
		
		return Page::getByName($pageName);
	}
	
	//	GET data
	public function getData()
	{
		//	INIT
		$arrData			= array();
		
		//	IF this page has json
		if($this->hasJson())
		{
			//	GET data from json
			$arrData		= json_decode($this->getJson(), true);
		}
		
		return $arrData;
	}
    
    //  IS json available for this page?
    public function hasJson()
    {
        return file_exists('views/page/'.$this->name.'.json');
    }
	
	public function getJson()
	{
		return file_get_contents('views/page/'.$this->name.'.json');
	}
}
