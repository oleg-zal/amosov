<?php
namespace Application\controller;

use Application\model\category;
use Application\classes\abstract_controller;
use Application\classes\helper;
use Application\config\boot;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NatureController extends abstract_controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->breadCrumbs[] = array(
            'link' => boot::PATH . 'publication' . $this->settings['language_c'],
            'title' => $this->settings['publication']['title']
        );
        $this->breadCrumbs[] = array(
            'link' => boot::PATH . $this->controller . $this->settings['language_c'],
            'title' => $this->settings[$this->controller]['title']
        );
        $this->Initialization($route, 'nature', 0);
    }

    public function actionIndex()
    {
        $auth = isset($_SESSION['auth']) ? $_SESSION['auth'] : 0;

        $this->header = helper::get_Header_HTML('header_1_2ed.tpl.php',
            $this->title_text . ' | ' . $this->settings[$this->controller]['title'],
            $this
        );

        $menu = category::get_topMenu($this->settings);
        $this->menu = helper::get_topMenu_HTML('top_menu.tpl.php', $menu, $this);

        $this->left_menu = helper::get_leftMenu_HTML('menu_left_sub.tpl.php', $this, $this->settings[$this->controller]['title'], $auth);

        $this->content = helper::get_rightContent_HTML('content_right.tpl.php', $auth, $this);

        $this->show_page();
    }

    public function actionUpdate()
    {
        $this->isAdmin();
        if (isset($_POST['del'])) {
            $del_link = $_POST['del'];
            $del_link .= $_POST['glava'];
            $_SESSION['id'] = $_POST['glava'];
            helper::redirect($del_link);

        }
        if (isset($_POST['submitText'])) {
            if (empty(trim($_POST['posText'])) || empty(trim($_POST['posName']))) {
                $_SESSION['edit_error'] = "<p style=\"color:red;\">Текст статьи и его заголовок должны быть набраны</p>";
                helper::redirect();
            }
            if (trim($_POST['posText']) == 'root')
                $url = boot::PATH . $this->controller . $this->settings['language_c'] . '/';
            else
                $url = boot::PATH . $this->controller . $this->settings['language_c'] . '/' . $this->glava;

            $model = new category();
            $model->{$this->settings['menu_left']['tekst']} = trim($_POST['posText']);
            $model->{$this->settings['menu_left']['title']} = trim($_POST['posName']);

            $model->save((int)$_POST['glava_h']);
            $_SESSION['edit_error'] = "<p style=\"color:green;\">Текст статьи удачно сохранен в базе данных</p>";
            helper::redirect($url);
        } else {
            if (isset($_SESSION['root']) && ($_SESSION['root'] == 'r')) {
                $root = $_SESSION['root'];
                $str1 = '';
                $str2 = '';
                unset($_SESSION['root']);
            } else {
                $root = '';
                $str1 = '<script type="text/javascript" src="' . boot::ROOTT . 'js/ckeditor/ckeditor.js"></script>';
                $str2 = 'CKEDITOR.replace(\'posText\');';
            }
            // Построение
            $this->header = helper::get_Header_HTML('header_1_2ed.tpl.php',
                "Редактирование - " . $this->title_text . " | " . $this->settings[$this->controller]['title'],
                $this, array('str1' => $str1, 'str2' => $str2)
            );
            $menu = category::get_topMenu($this->settings);
            $this->menu = helper::get_topMenu_HTML('top_menu.tpl.php', $menu, $this);
            $this->left_menu = helper::get_leftMenu_HTML('menu_left_sub.tpl.php', $this, $this->settings[$this->controller]['title'], 0);
            $this->content = helper::get_rightContentForm_HTML('content_right_form.tpl.php', $this, $root);
            $this->show_page();
        }
    }

    public function actionAdd()
    {
        $this->isAdmin();
        if (isset($_POST['submitText'])) {
            if (empty(trim($_POST['posText'])) || empty(trim($_POST['posName']))) {
                $_SESSION['edit_error'] = "<p style=\"color:red;\">Текст статьи и его заголовок должны быть набраны</p>";
                helper::redirect();
            }
            $model = new category();
            $model->{$this->settings['menu_left']['tekst']} = trim($_POST['posText']);
            $model->{$this->settings['menu_left']['title']} = trim($_POST['posName']);
            $model->parent = (int)$_POST['glava_h'];
            $model->nomer = (int)$_POST['nomer_por'];
            $model->book = $_POST['type'];
            $model->save();
            $id = $model->id;
            $url = boot::PATH . $this->controller . $this->settings['language_c'] . '/' . $id;
            $_SESSION['edit_error'] = "<p style=\"color:green;\">Текст статьи удачно добален в базу данных</p>";
            helper::redirect($url);
        } else {
            $str1 = '<script type="text/javascript" src="' . boot::ROOTT . 'js/ckeditor/ckeditor.js"></script>';
            $str2 = 'CKEDITOR.replace(\'posText\');';
            $this->title_text = '';
            $this->osn_text = '';
            // Построение
            $this->header = helper::get_Header_HTML('header_1_2ed.tpl.php',
                "Добавление записи в раздел " . $this->title_text . " | " . $this->settings[$this->controller]['title'],
                $this, array('str1' => $str1, 'str2' => $str2)
            );
            $menu = category::get_topMenu($this->settings);
            $this->menu = helper::get_topMenu_HTML('top_menu.tpl.php', $menu, $this);
            $this->left_menu = helper::get_leftMenu_HTML('menu_left_sub.tpl.php', $this, $this->settings[$this->controller]['title'], 0);
            $this->content = helper::get_rightContentForm_HTML('content_right_form_add.tpl.php', $this, "");
            $this->show_page();
        }
    }

    public function actionDelete()
    {
        $this->isAdmin();
        $id = $_SESSION['id'];
        if (isset($this->glavy[$this->parent]['childs'])) {
            $podGlavy = $this->glavy[$this->parent]['childs'];
            $id_vozvrat = $this->first_element($podGlavy);
        }
        else {
            $id_vozvrat = "";
        }

        $link = boot::PATH . $this->controller . $this->settings['language_c'] . '/' . $id_vozvrat;

        $category = new category();
        $category->delete($id);
        helper::redirect($link);
        exit;
    }

    public function actionUpdater()
    {
        $_SESSION['root'] = 'r';
        $link = boot::PATH . $this->controller . $this->settings['language_c'] . '/update/' . $this->glava;
        helper::redirect($link);
        exit;
    }

}