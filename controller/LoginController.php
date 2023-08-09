<?php
namespace Application\controller;
use Application\classes\helper;
use Application\model\category;
use Application\classes\view;
use Application\config\boot;

class LoginController
{
    public function __construct($route)
    {
        $this->lang         = $route['lang'];
        $this->controller   = $route['cont'];
        $this->action       = $route['act'];
        $this->settings     = parse_ini_file(boot::BASE_LINK . 'lang/l_' . $this->lang . '.ini', TRUE);
        $this->footer       = helper::get_Footer_HTML('footer.tpl.php', category::get_Footer());
    }
    public function actionIndex()
    {
        if (isset($_POST['submit_login'])) {
            $login			=	helper::cleanPosUrl($_POST['login']);
            $password		=	helper::cleanPosUrl($_POST['password']);
            if (($login == boot::LOGIN) && (SHA1($password) == boot::PASS))
            {
                $_SESSION['auth'] = 1;
                $old_url = $_SESSION['old_url'];
                unset($_SESSION['old_url']);
                if (strpos($old_url, 'login') !== false){
                    $old_url = boot::PATH;
                }
                helper::redirect($old_url);
                exit;
            }
            else {
                $_SESSION['error_login']	= "<p style=\"color:red;\">Вы ввели не правильное Имя или Пароль</p>";
                helper::redirect();
            }
        }
        else{
            $result	= "";
            $error_login = "";
            if (!empty($_SESSION['error_login'])) {
                $error_login = $_SESSION['error_login'];
                unset($_SESSION['error_login']);
            }
            $_SESSION['old_url']	=	(empty($_SERVER['HTTP_REFERER']))	?	boot::PATH	:	$_SERVER['HTTP_REFERER'];

            $header = helper::get_Header_HTML(	'header_1_2ed.tpl.php', 'Вход в Админку ', $this );

            $menu = category::get_topMenu($this->settings);
            $menu = helper::get_topMenu_HTML('top_menu.tpl.php', $menu, $this);


            $view = new View();
            $view->header = $header;
            $view->menu = $menu;
            $view->result = $result;
            $view->error_login = $error_login;
            $view->footer = $this->footer;
            $view->display('login.tpl.php');
        }
    }
}