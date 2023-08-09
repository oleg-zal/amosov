<?php
namespace Application\controller;

use Application\classes\helper;
use Application\model\category;
use Application\classes\view;
use Application\config\boot;

class FeedbackController
{
    public function __construct($route)
    {
        $this->lang = $route['lang'];
        $this->controller = $route['cont'];
        $this->action = $route['act'];
        $this->settings = parse_ini_file(boot::BASE_LINK . 'lang/l_' . $this->lang . '.ini', TRUE);
        $this->footer = helper::get_Footer_HTML('footer.tpl.php', category::get_Footer());
        $this->active = $this->settings[$this->controller]['menu'];
    }

    public function actionIndex()
    {
        if (isset($_POST['sendContactEmail'])) {
            $name = helper::cleanPosUrl($_POST['posName']);
            $email = helper::cleanPosUrl($_POST['posEmail']);
            $subject = helper::cleanPosUrl($_POST['posRegard']);
            $message = helper::cleanPosUrl($_POST['posText']);

            $total_error = FALSE;

            if (empty($name)) {
                $_SESSION['error']['error_name'] = "<span style=\"color:red;\">Вы не заполнили поле 'имя'</span>";
                $total_error = TRUE;
            }
            if (empty($email)) {
                $_SESSION['error']['error_email'] = "<span style=\"color:red;\">Вы не заполнили поле 'электронная почта'</span>";
                $total_error = TRUE;
            }
            if (empty($subject)) {
                $_SESSION['error']['error_subject'] = "<span style=\"color:red;\">Вы не заполнили поле 'заголовок'</span>";
                $total_error = TRUE;
            }
            if (empty($message)) {
                $_SESSION['error']['error_message'] = "<span style=\"color:red;\">Вы не заполнили поле 'сообщение'</span>";
                $total_error = TRUE;
            }

            if ($total_error) {
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['subject'] = $subject;
                $_SESSION['message'] = $message;
                helper::redirect();
            }


            //Отправка сообщения на электронную почту
            $to = boot::MYEMAIL;
            $subject_mail = "Feedback reply from www.icfcst.kiev.ua/AMOSOV_N";

            $message_mail = "name: {$name}\r\n";
            $message_mail .= "email: {$email}\r\n";
            $message_mail .= "Subject: {$subject}\r\n";
            $message_mail .= "Message: {$message}";
            $message_mail = htmlspecialchars_decode($message_mail);

            $headers = "";
            $headers .= "From: Administrator of www.icfcst.kiev.ua <v.bigdan@gmail.com>\r\n";
            $headers .= "Content-type: text/plain; charset = \"UTF-8\"";
            if (mail($to, $subject_mail, $message_mail, $headers))
                $total_error = FALSE;
            else
                $total_error = TRUE;


            if (!$total_error) {
                $_SESSION['result'] = 'Ваше сообщение удачно отправлено. Спасибо за Ваш отзыв.';
            } else {
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['subject'] = $subject;
                $_SESSION['message'] = $message;
            }
            helper::redirect();

        } else {
            $error['name'] = (empty($_SESSION['error']['error_name'])) ? "" : $_SESSION['error']['error_name'];
            $error['email'] = (empty($_SESSION['error']['error_email'])) ? "" : $_SESSION['error']['error_email'];
            $error['subject'] = (empty($_SESSION['error']['error_subject'])) ? "" : $_SESSION['error']['error_subject'];
            $error['message'] = (empty($_SESSION['error']['error_message'])) ? "" : $_SESSION['error']['error_message'];

            if (!empty($_SESSION['error'])) {
                unset($_SESSION['error']);
            }

            $result = (empty($_SESSION['result'])) ? "" : $_SESSION['result'];
            unset($_SESSION['result']);
            $s_name = (empty($_SESSION['name'])) ? "" : $_SESSION['name'];
            unset($_SESSION['name']);
            $s_email = (empty($_SESSION['email'])) ? "" : $_SESSION['email'];
            unset($_SESSION['email']);
            $s_subject = (empty($_SESSION['subject'])) ? "" : $_SESSION['subject'];
            unset($_SESSION['subject']);
            $s_message = (empty($_SESSION['message'])) ? "" : $_SESSION['message'];
            unset($_SESSION['message']);

            $header = helper::get_Header_HTML('header_1_2ed.tpl.php', $this->settings[$this->controller]['menu'], $this);

            $menu = category::get_topMenu($this->settings);
            $menu = helper::get_topMenu_HTML('top_menu.tpl.php', $menu, $this);


            $view = new View();
            $view->header = $header;
            $view->menu = $menu;
            $view->contact_information = '';
            $view->result = $result;
            $view->name = $s_name;
            $view->email = $s_email;
            $view->subject = $s_subject;
            $view->message = $s_message;
            $view->error = $error;
            $view->footer = $this->footer;
            $view->settings = $this->settings;
            $view->display('feedback.tpl.php');
        }
    }
}