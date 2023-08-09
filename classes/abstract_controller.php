<?php
namespace Application\classes;
use Application\config\boot;
use Application\model\category;
use Application\classes\view;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class abstract_controller
{

    public $controller;
    public $action;
    public $id;
    public $settings;
    public $lang;
    public $glava;
    public $begin_glava;
    public $glavy;
    public $title_text;
    public $osn_text;
    public $active;
    public $acc_value;
    public $parent;

    public $header;
    public $menu;
    public $galery;
    public $breadCrumbs;
    public $left_menu;
    public $content;
    public $footer;
    
    
    protected function __construct($route) 
    {
        $this->lang         = $route['lang'];
        $this->controller   = $route['cont'];
        $this->action       = $route['act'];
        $this->id           = $route['id'];
        $this->settings     = parse_ini_file(boot::BASE_LINK . 'lang/l_' . $this->lang . '.ini', TRUE);

        $this->footer       = helper::get_Footer_HTML('footer.tpl.php', category::get_Footer());
        $this->galery       = helper::get_Gallery_HTML('galery.tpl.php', category::get_Gallery());
        $this->breadCrumbs[] = array(
            'link'	=>	boot::PATH . $this->settings['top_link'][0],
            'title'	=>	$this->settings['top_menu'][0]
        );

        $this->active = $this->settings[$this->controller]['menu'];

    }

    protected function Initialization($route, $partition, $level)
    {
        $this->glavy = $this->get_glavy($partition, $level);
        $this->glava = $route['id'];
        $this->begin_glava = $this->first_element($this->glavy);
        $this->glava = empty($this->glava) ? $this->begin_glava : $this->glava;
        $this->acc_value = $this->acc_value(); //var_dump($acc_value); die();
        $this->acc_value = (isset($this->acc_value)) ? $this->acc_value + 1 : 0;
        $record = category::get_content($this->glava, $this->settings);
        if (!$record) {
            throw new \Exception('ошибка');
        }
        $this->breadCrumbs($record);
        $title = $this->settings['menu_left']['title'];
        $text = $this->settings['menu_left']['tekst'];
        $this->title_text = $record->$title;
        $this->osn_text = $record->$text;
        $this->parent = $record->parent;
    }

    protected function get_glavy($param, $level)
    {
        $forLink = (is_array($param)) ? $param[0] : $param;
        $fields = $this->settings['query']['get_glavu_2ed'];
        $where = $param;
        $glavy = category::get_glavu_total($fields, $where, $forLink, $this->settings['language_c'], $level);
        return $glavy;
    }

    protected function breadCrumbs(&$article)
    {
        //var_dump($article); die();
        $lang = $this->settings['language_c'];
        $parent_glava	= $article->parent;
        $title			= $article-> {$this->settings['menu_left']['title'] };
        if ( isset($this->glavy[$parent_glava]['childs']) ) {

            $begin_book_glava = $this->first_element($this->glavy[$parent_glava]['childs']);
            $this->breadCrumbs[]	=	array(
                'link'	=>	boot::PATH . $this->controller . $lang . '/' . $begin_book_glava,
                'title'	=>	$this->glavy[$parent_glava][ $this->settings['menu_left']['title'] ]
            );
            $this->breadCrumbs[]	=	array(
                'link'	=>	"",
                'title'	=>	$title
            );
        }
        else {
            $this->breadCrumbs[]	=	array(
                'link'	=>	"",
                'title'	=>	$title
            );
        }
    }

    protected function first_element($mass) {

	if (is_array($mass)) {
		reset($mass);
		$ret =  current($mass);
		$ret =	$ret['id'];  	
	}
	else {
		$ret =  $mass;
	}
	return $ret;
    }

    protected function last_element($mass) {

        if (is_array($mass)) {
            reset($mass);
            $ret =  end($mass);
            //$ret =	$ret['id'];
        }
        else {
            $ret =  $mass;
        }
        return $ret;
    }

    protected function acc_value()
    {
        //var_dump($glavy); var_dump($this->glava); die();
	    foreach ($this->glavy as $item) {
            $hook = ($item['id'] == $this->glava) ? 1 : 0;
            
            if( isset($item['childs']) && $item['childs'] ) {
                foreach($item['childs'] as $item_child) {
                    if ($hook == 1) {
                        return $item_child['acc_value'];
                    }
                    if($item_child['id'] == $this->glava) {
                        return $item_child['acc_value'];
                    }
                }
            }
            else {
                continue;
            }
        }
	    return null;
    }

    public function last_nomer($mass)
    {
        if(isset ($mass) && $mass )
        {
            $elem = $this->last_element($mass);
            return $elem['nomer'];
        }
        else
        {
            return 0;
        }
    }

    protected function isAdmin()
    {
        if 	(empty($_SESSION['auth']))
        {
            $url = boot::PATH . $this->controller . $this->settings['language_c'] . '/' . $this->glava;
            helper::redirect($url);
            exit;
        }
    }

    protected function show_page()
    {
        $view = new View();
        $view->header   = $this->header;
        $view->menu     = $this->menu;
        $view->galery   = $this->galery;
        $view->br_c     = $this->breadCrumbs;
        $view->left_menu= $this->left_menu;
        $view->content	= $this->content;
        $view->footer   = $this->footer;
        $view->display('main.tpl.php');
    }
}
