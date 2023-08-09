<?php
namespace Application\controller;
use Application\classes\helper;
use Application\model\category;
use Application\classes\view;
use Application\config\boot;
class LostController
{
    public function __construct($route)
    {
        $this->lang         = $route['lang'];
        $this->controller   = 'index';
        $this->action       = $route['act'];
        $this->settings     = parse_ini_file('/../lang/l_' . $this->lang . '.ini', TRUE);
        $this->footer       = helper::get_Footer_HTML('footer.tpl.php', category::get_Footer());
    }

    public function actionIndex()
    {
        $header = helper::get_Header_HTML('header_404.tpl.php', "Ошибка 404 | Сайт посвященный Н.М.Амосову", $this);
        $menu = category::get_topMenu($this->settings);
        $menu = helper::get_topMenu_HTML('top_menu.tpl.php', $menu, $this);
        $view = new View();
        $view->header = $header;
        $view->menu = $menu;
        $view->footer = $this->footer;
        $view->display('404.tpl.php');
    }
}