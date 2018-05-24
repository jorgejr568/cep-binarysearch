<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 24/05/18
 * Time: 19:04
 */

namespace CEPSearcher\Controller;


use CEPSearcher\Engine\File\File;

class ProvaRefractorController extends Controller
{
    private $dummy_path="data/prova-dummy.dat";
    private $dummy_reverse_path="data/prova-dummy-reverse.dat";
    private $dummy_websites_filtered_path="data/prova-dummy-reverse.dat";
    public function __construct()
    {

    }

    public function processExercise1(File $dummy_dat,File $dummy_reverse){
        $dummy_template=config("prova_dummy_template");
        $dummy_line_size=array_sum($dummy_template);
        $last_item_pos=filesize($this->dummy_path)-$dummy_line_size;


        while($last_item_pos >= 0){
            $dummy_reverse->write(
                $dummy_dat->read($dummy_line_size,$last_item_pos),
                NULL,
                $dummy_line_size
            );

            $last_item_pos-=$dummy_line_size;
        }
    }
    public function exercise1(){
        $dummy_template=config("prova_dummy_template");
        $dummy_line_size=array_sum($dummy_template);
        
        $dummy_dat= new File();
        $dummy_reverse=new File();
        $dummy_dat->open($this->dummy_path,"r");
        $dummy_reverse->open($this->dummy_reverse_path,"w+");

        $this->processExercise1($dummy_dat,$dummy_reverse);

        require_once "view/prova-refractor/exercise-1.php";

        $dummy_dat->close();
        $dummy_reverse->close();
    }

    public function exercise2(){

    }

    public function exercise3(){

    }
}