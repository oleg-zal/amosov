<?php
namespace Application\classes;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class View
{
    protected $data = [];
    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }
    public function __get($k) {
        return $this->data[$k];
    }
    public function display($path)
    {
        foreach ($this->data as $k => $v) {
            $$k = $v;
        }
        include __DIR__ . '/../views/' . $path;
    }
}
