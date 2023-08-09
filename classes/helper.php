<?php
namespace Application\classes;
use Application\config\boot;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class helper
{
    public static function get_Header_HTML($template, $title, $that, $params = array())
    {
	$vars = array(
                    'title'	=> $title,
                    'roott' => boot::ROOTT,
                    'fold'  => boot::FOLD,
                    'that'  => $that,
                    'params'=> $params
                 );
	$header = self::render($template, $vars);
	
	return $header;
    }


    public static function get_Gallery_HTML($template, $gallery)
    {
        $vars =	array(
            'gallery'	=> $gallery
        );
        $galery	=   self::render($template, $vars);
        return $galery;
    }
        
    public static function get_topMenu_HTML($template, $menu, $that)
    {
	$vars = array(
                    'menu'	    => $menu,
                    'ini_array' => $that->settings,
                    'active'    => isset($that->active) ? $that->active : "",
                    'glava'	    => isset($that->glava) ? $that->glava : "",
                    'roott'     => boot::ROOTT,
                    'fold'      => boot::FOLD,
                    'view'      => $that->controller
                  );

	$ret = self::render($template, $vars);
	return $ret;
    }
    public  static function get_deviz($settings)
    {
        $ret = <<<EOL
	<div id="slides-text">
		<h3>{$settings['deviz']['title']}</h3>
		<p class="toright">{$settings['deviz']['author']}</p>
	</div>
	<p class="fraza">
		{$settings['index']['content']}
	</p>
	<p class="fraza1">
		{$settings['index']['author']}
	</p>
EOL;
        return $ret;
    }
    
    
    public static function get_leftMenu_HTML($template, $that, $title="", $auth=0)
    {
	$vars = array(
				'glavy'		=>	isset($that->glavy) ? $that->glavy : '' ,
				'active'	=>	isset($that->glava) ? $that->glava : '',
				'title'		=>	$title,
				'view'		=>	$that->controller,
                'ini_array' =>  $that->settings,
                'auth'		=>	$auth,
                'fold'      =>  boot::PATH,
                'lang'      =>  $that->settings['language_c'],
                'that'      =>  $that
				);
	$left_menu =  self::render($template, $vars);	
	return $left_menu;
    }

    public static function get_rightContentForm_HTML($template, $that, $root="")
    {
        $vars = array(
            'that'      =>  $that,
            'root'      =>  $root
                     );
        $content =	self::render($template, $vars);
        return $content;
    }

    public static function get_rightContent_HTML($template, $auth, $that)
    {
        if ( isset( $that->glavy[$that->parent]['childs'] ) && count($that->glavy[$that->parent]['childs']) > 1  )
            $podglavy = $that->glavy[$that->parent]['childs'];
        else
            $podglavy = "";

        $vars = array(
            'auth'		 =>	 $auth,
            'lang'       =>  $that->settings['language_c'],
            'ua_link'    =>  boot::PATH . $that->settings[$that->controller]['ua'] . '/' . $that->glava,
            'ru_link'    =>  boot::PATH . $that->settings[$that->controller]['ru'] . '/' . $that->glava,
            'title'      =>	 $that->title_text,
            'edit_link'	 =>	 $that->controller . $that->settings['language_c'] . '/update/' . $that->glava,
            'arc_link'	 =>	 $that->controller . $that->settings['language_c'] . '/archive/' . $that->glava,
            'res_link'	 =>	 $that->controller . $that->settings['language_c'] . '/restore/' . $that->glava,
            'del_link'   =>  $that->controller . $that->settings['language_c'] . '/delete/',
            'glava'      =>  $that->glava,
            'content'	 =>	 $that->osn_text,
            'podglavy'   =>  $podglavy,
            'that'       =>  $that
        );
        $content =	self::render($template, $vars);
        return $content;
    }

    
    public static function get_Footer_HTML($template, $footer)
    {
	$vars = array(
		'footer' => $footer,
                'fold'  => boot::FOLD
                    );
	$ret =  self::render($template, $vars);	
	return $ret;
    }
    
    public static function render($tmp, $vars){
        
        if (file_exists(__DIR__ . '/../views/add/' . $tmp))
        {
            ob_start();
            extract($vars);
            include __DIR__ . '/../views/add/' . $tmp;
            //require (VIEW . $tmp . ".tpl.php");
            return ob_get_clean();
        }
        else
                return "Шаблон $tmp не найден";

    }
    
    public static function active($title, $active)
    {
	if ($title == $active) echo ' class="active" ';
    }

    /**
     * @param bool|false $http
     */
    public static function redirect($http = false){
        if($http)
            $link = $http;
        else
            $link = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : boot::PATH;
        header("Location: $link");
        exit;
    }

    public static function cleanPosUrl ($str)
    {
        return trim(htmlspecialchars($str));
    }
}

