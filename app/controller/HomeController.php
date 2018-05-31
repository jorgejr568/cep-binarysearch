<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 31/05/18
 * Time: 00:01
 */

namespace CEPSearcher\Controller;


use CEPSearcher\Engine\View\View;

class HomeController extends Controller
{
    public function index(){
        $View = new View();
        $View
            ->setView("index")
            ->setVariable("applications" , config("applications"))
            ->run();
        }
}