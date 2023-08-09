<?php
namespace Application\controller;
use Application\classes\helper;

class LogoutController
{
    public function __construct($route)
    {

    }

    public function actionIndex()
    {
        if( $_SESSION['auth'] === 1 )
        {
            unset($_SESSION['auth']);
        }
        $old_url	=	(empty($_SERVER['HTTP_REFERER']))	?	PATH	:	$_SERVER['HTTP_REFERER'];
        helper::redirect($old_url);
        exit;
    }
}