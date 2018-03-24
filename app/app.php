<?php
namespace CEPSearcher;

use CEPSearcher\Controller\AddressController;

class App{
    private $structure=[
        "config" => [
            "app"
        ],
        "exception" => "*",
        "model" => "*",
        "engine" => "*",
        "fn" => "*",
        "controller" => "*",
    ];
    private function require_dir($dir_path){
        rtrim($dir_path,"/");
        $dir_files=scandir($dir_path);
        foreach ($dir_files as $dir_item){
            if(!in_array($dir_item,[".",".."])) {
                $dir_item_full_path = $dir_path . DIRECTORY_SEPARATOR . $dir_item;
                if (is_dir($dir_item_full_path)) {
                    $this->require_dir($dir_item_full_path);
                } else require_once $dir_item_full_path;
            }
        }
    }
    public function run(){
        chdir(dirname(__FILE__));

        foreach($this->structure as $dir => $structure_types_ordered) {
            if ($structure_types_ordered == "*") $this->require_dir($dir);
            else {
                foreach ($structure_types_ordered as $file_to_be_required)
                    require_once __DIR__
                        . DIRECTORY_SEPARATOR
                        . $dir
                        . DIRECTORY_SEPARATOR
                        . $file_to_be_required
                        . ".php";
            }
        }
        $addressController=new AddressController();
        $addressController->run();
    }
}

return new App();