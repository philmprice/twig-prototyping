<?php

class ViewManager
{
	private $absPath	= '';
	
	public function ViewManager($absPath)
	{
		$this->absPath	= $absPath;
	}
	
	public function allMustacheToTwig()
	{
		//	GET tree for abs view path
		$this->mustacheToTwigFolder($this->absPath);
	}
	
	public function mustacheToTwigFolder($path)
	{
		//	INIT
		$objDir				= dir($path);
		
		//	READ sub-folders
		while(false !== ($entry = $objDir->read())) 
		{
			//	IF not just dots
			if($entry != '.' && 
			   $entry != '..')
			{
				//	IF file
				if(is_file($path.$entry))
				{
					//	IF mustache file
					if(strpos($entry, '.mustache') !== false)
					{
						$newName	= str_replace('.mustache', '.twig', $entry);
						rename($path.$entry, $path.$newName);
					}
				}
				//	IF folder
				elseif(is_dir($path.$entry))
				{
					$this->mustacheToTwigFolder($path.$entry.'/');
				}
			}
		}
		
		$objDir->close();
	}
	
	public function getTreeData()
	{
		//	GET tree for abs view path
		$arrData		= $this->getFolderContents($this->absPath);
		
		return $arrData;
	}
	
	public function getFolderContents($path)
	{
		//	INIT
		$arrData			= array();
		$objDir				= dir($path);
		
		//	READ sub-folders
		while(false !== ($entry = $objDir->read())) 
		{
			//	IF not just dots
			if($entry != '.'	&& 
			   $entry != '..'	&&
			   $entry != 'template')
			{
				//	IF file
				if(is_file($path.$entry))
				{
					//	IF twig file
					if(strpos($entry, '.twig') !== false)
					{
						//	SET values
						$label		= ucwords(str_replace('.twig','',$entry));
						$type		= 'file';
						$items		= null;
						$viewPath	= str_replace($this->absPath,'',$path.$entry);
						$viewType	= current(explode('/', $viewPath));

						switch(strtolower($viewType))
						{
							case 'template':
							case 'templates':
								$url	= null;
								break;

							case 'page':
							case 'pages':
								$url	= ROOT.str_replace('.twig','',$entry);
								break;

							default:
								$url	= ROOT.'?t='.$viewPath;
								break;
						}
					}
					//	IF not twig file, unset entry
					else
					{
						unset($entry);
					}
				}
				//	IF folder
				elseif(is_dir($path.$entry))
				{
					//	IF folder not core, not from mustache
					if($entry != '_core' && strpos($entry, '-') === false)
					{
						//	SET values
						$label		= ucwords($entry);
						$type		= 'folder';
						$items		= $this->getFolderContents($path.$entry.'/');
						$url		= '#';
					}
					else
					{
						unset($entry);
					}
				}
					
				//	IF entry still exists
				if($entry)
				{
					//	ADD data
					$arrData[]	= array('type'		=> $type,
										'name'		=> $entry,
										'label'		=> $label,
										'url'		=> $url,
										'children'	=> $items);
				}
			}
		}
		
		$objDir->close();
		
		return $arrData;
	}
    
    public function getJsonForTwig($twigPath)
    {
        //  INIT
        $arrData                = array();
        $jsonPath	      		= str_replace('.twig', '.json', $twigPath);
        
        //  IF json file exists
        if(file_exists($this->absPath.$jsonPath))
        {
            //  DECODE json data
            $arrData			= json_decode(file_get_contents(ABS_ROOT.'views/'.$jsonPath), true);
        }
        
        return $arrData;
    }
}