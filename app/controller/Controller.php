<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 24/05/18
 * Time: 19:33
 */

namespace CEPSearcher\Controller;


class Controller
{
    public function isPost(){
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}