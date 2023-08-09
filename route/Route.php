<?php
namespace Application\route;
class Route
{
    protected static $_instance;		


    private function __construct()
    {

    }

    private function __clone()
    {
    }

    public static function getInstance() 
    {
        
	if (null === self::$_instance) {
            
		self::$_instance = new self();
	}
	return self::$_instance;
    }

    private function get_url()
    {
	if (FOLD == "")
		$url = ltrim($_SERVER['REQUEST_URI'], '/');	
	else
	{
		$url = str_replace(FOLD, '', $_SERVER['REQUEST_URI']);
		$url = ltrim($url, '/');
	}	
	return $url;
    }

    public function get_route()
    {
        $path = $this->get_url();        var_dump($path);
        if (empty($path) )
            return array("lang"  => "ua", "action" => "index", "controller"  => "index", "view" => "index");
        elseif ($path == 'ru')
            return array("lang"  => "ru", "action" => "index", "controller"  => "index", "view" => "index");
        elseif ($path == 'en')
            return array("lang"  => "en", "action" => "index", "controller"  => "index", "view" => "index");
         
    }

}