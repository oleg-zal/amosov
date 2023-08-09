<?php
namespace Application\controller;
use Application\model\category;
use Application\classes\abstract_controller;
use Application\classes\view;
use Application\classes\helper;
use Application\config\boot;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class IndexController extends abstract_controller
{
   
    public function __construct($route) 
    {
        parent::__construct($route);
        $this->glavy = $this->get_glavy(array('main', 'ideology'), 0);
        $this->glava = '';
    }
    
    public function actionIndex()
    {

        /////////////// Голоса времен /////////////////////////////////////////////////////////////////////
        $this->glavy[2]['link'] = 'golosa' . $this->settings['language_c'] . '/'; //var_dump($glavy); die();
        ///////////////////////////////////////////////////////////////////////////////////////////////////

        $header	= helper::get_Header_HTML('header_1_2ed.tpl.php', $this->settings['index']['header_title'], $this);
        $menu = category::get_topMenu($this->settings);
        $menu = helper::get_topMenu_HTML('top_menu.tpl.php', $menu, $this);


        $left_menu =  helper::get_leftMenu_HTML('menu_left_sub.tpl.php', $this, '', 0);
        $content = helper::get_deviz($this->settings);

        $view = new View();

        $view->header = $header;
        $view->menu = $menu;
        $view->galery = "";
        $view->br_c = "";
        $view->left_menu =  $left_menu;
        $view->content	= $content;
        $view->footer = $this->footer;

        $view->display('index.tpl.php');
    }
}

