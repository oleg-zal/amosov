<?php
namespace Application\model;
use Application\classes\abstract_model;
use Application\config\boot;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class category extends abstract_model
{
    static protected $table = 'category';

    public static function get_content($glava, $settings){
        $fields = $settings['query']['get_content'];
        //var_dump($fields);var_dump($glava);
        $content = category::findOneByPk($glava, $fields);
        return $content;

    }

    public static function get_glavu_total($fields, $where, $forLink, $lang, $parent_id=false)
    {
        if (is_array($where)) {
		    $where_list = "";
		    foreach ($where as $item) {
			    $where_list .= "book='$item' OR ";
		    }
		    $where_list = substr($where_list, 0, -3);
            $where_list .= ' ORDER BY parent ASC, nomer ASC';
	    }
	    else {
		    $where_list = "book='" . $where . "' ORDER BY nomer ASC";
	    }
        $res = category::findAll($fields, $where_list);
        $pages = array();
        foreach ($res as $element)
        {
            $element->link = $forLink . '/' . $element->id; 
            $pages[$element->id] = $element->data;
        }
        
        if ($parent_id !== false) {
		$pages = self::map_tree($pages, $parent_id);
	    }
        
        $glavy = self::add_link($pages, $forLink, $lang, 'golosa');
        return $glavy; 
    }
    
    public static function map_tree($dataset, $parent) {
	$tree = array();
        
	foreach ($dataset as $id=>&$node) { 
            //var_dump($node->data); exit;  
            if ($node['parent'] == $parent){
		$tree[$id] = &$node;
            }
            else{ 
                $dataset[$node['parent']]['childs'][$id] = &$node;
            }
	}

	return $tree;
    }
    
    public static function add_link($glavy, $razdel, $lang, $exclude="")
    {
    //
    // $acc_value - порядковый номер елемента $glavy, который имеет дочерний елемент (одна глава имеет подглавы)
    //
	$acc_value	= 0;
	foreach ($glavy as &$item)
	{
            if( isset($item['childs']) && $item['childs'] ) 
            {
                $iter = 1;
                foreach($item['childs'] as &$item_child) 
                {

                    if($iter == 1){
                        $item['link'] = $razdel . $lang . '/' . $item_child['id'];
                        $item_child['link'] = $razdel . $lang .'/' . $item_child['id'];
                    }
                    else {
                        $item_child['link'] = $razdel . $lang .'/' . $item_child['id'];
                    }
                    $item_child['acc_value']	= $acc_value; 
                    $iter++;
                }
                $acc_value++;	
            }
            else {
		        $item['link'] = $razdel . $lang .'/' . $item['id'];
		    }
	}
	return $glavy;
    }

public static function get_Gallery()
    {
        $gallery = array(
            'slide1'	=>	'am01.jpg',
            'slide2'	=>	'am02.jpg',
            'slide3'	=>	'am03.jpg',
            'slide4'	=>	'am04.jpg',
            'slide5'	=>	'am05.jpg'
        );
        return $gallery;
    }

public static  function get_topMenu($settings)
    {
        $path = boot::FOLD;
        $menu = array(
            'nom1' => array('link'=>$path . $settings['top_link'][0],
                'title'=>$settings['top_menu'][0]),
            'nom2' => array('link'=>$path . $settings['top_link'][1],
                'title'=>$settings['top_menu'][1]),
            'nom3' => array('link'=>$path . $settings['top_link'][2],
                'title'=>$settings['top_menu'][2]),
            'nom4' => array('link'=>$path . $settings['top_link'][3],
                'title'=>$settings['top_menu'][3]),
            'nom5' => array('link'=>$path . $settings['top_link'][4],
                'title'=>$settings['top_menu'][4]),
            'nom6' => array('link'=>$path . $settings['top_link'][5],
                'title'=>$settings['top_menu'][5])
        );

        if (isset($_SESSION['auth']) &&( $_SESSION['auth'] === 1 ))
        {
            $menu['nom7'] = array('link'=>$path . $settings['top_link'][6],
                'title'=>$settings['top_menu'][6]);
        }

        else
        {
            //$menu['nom7'] = array('link'=>$path . 'login', 	'title'=>'Вход');
        }

        return $menu;
    }

public static  function get_Footer()
    {
        $footer = array(
            'line1'		=>	'Last modified: '. date("d M, Y"),
            'line2'		=>	'Copyright &copy;1999-2016 ICFCST.',
            'line3'		=>	'All Rights Reserved'
    );
        return $footer;
    }
    
}
