<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 31/05/18
 * Time: 00:05
 */

namespace CEPSearcher\Engine\View;


class View
{
    const VIEW_PATH = "view/";
    private $view;

    private $variables;
    /**
     * View constructor.
     * @param null $view
     */
    public function __construct($view = null)
    {
        $this->view = $view;
    }

    /**
     * @param array $data
     * @param $value
     * @return $this
     */
    public function setVariable($data = [], $value = null){
        if(is_array($data)){
            /** @var array $data */
            foreach ($data as $variable_name => $variable_value)
                $this->variables[$variable_name] = $variable_value;
        }elseif(is_string($data)){
            /** @var string $data */
            $this->variables[$data] = $value;
        }else die("UNUSED PROCESS DETECTED ON VIEW ENGINE");
        return $this;
    }

    public function unsetVariable($variable_name){
        /** @var string $variable_name */
        unset($this->variables[$variable_name]);
        return $this;
    }

    /**
     * @param null $view
     * @return View
     */
    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return null
     */
    public function getView()
    {
        return $this->view;
    }

    public function run(){
        if(count($this->variables)>0)
            foreach ($this->variables as $variable_name => $variable_value)
                ${$variable_name} = $variable_value;

        require_once SELF::VIEW_PATH.str_replace(".",DIRECTORY_SEPARATOR,$this->view).".php";

    }
}