<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 24/05/18
 * Time: 19:04
 */

namespace CEPSearcher\Controller;


use CEPSearcher\Engine\File\File;
use CEPSearcher\Exception\InvalidLineProvaDummy;
use CEPSearcher\Model\ProvaDummy;

class ProvaRefractorController extends Controller
{
    private $dummy_path="data/prova-dummy.dat";
    private $dummy_reverse_path="data/prova-dummy-reverse.dat";
    private $dummy_websites_filtered_path="data/prova-dummy-website.dat";
    private $view_path="view/prova-refractor";

    public function __construct()
    {

    }

    private function processExercise1(File $dummy_dat,File $dummy_reverse){
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

        $dummy_reverse->close()->open($this->dummy_reverse_path,"r");

        require_once $this->view_path."/exercise-1.php";

        $dummy_dat->close();
        $dummy_reverse->close();
    }

    private function listDummyExtensions(){
        $dummy_template=config("prova_dummy_template");
        $dummy_size=array_sum($dummy_template);

        $extensions=[];
        $dummy_file=new File();
        $dummy_file->open($this->dummy_path,"r");
        while (true){
            $dummy_line=$dummy_file->r($dummy_size);
            if($dummy_file->eof()) break;

            try {
                $Dummy = ProvaDummy::create_from_line($dummy_line);
            } catch (InvalidLineProvaDummy $e) {
                die($e->getMessage());
            }

            $extension=trim(substr($Dummy->getWebsite(),strpos($Dummy->getWebsite(),".")));

            if(!in_array($extension,$extensions)) $extensions[]=$extension;
        }
        $dummy_file->close();
        return $extensions;
    }

    public function exercise2(){
        $dummy_template=config("prova_dummy_template");
        $dummy_size=array_sum($dummy_template);
        if($this->isPost()){
            $dummy_file=File::create($this->dummy_path,"r");
            $dummy_filtered=File::create($this->dummy_websites_filtered_path,"w+");

            $endCheck=trim($_POST['extension']);
            $endCheckLen=strlen($endCheck);


            while(true){
                $dummy_line=$dummy_file->r($dummy_size);
                if($dummy_file->eof()) break;
                try {
                    $Dummy = ProvaDummy::create_from_line($dummy_line);
                } catch (InvalidLineProvaDummy $e) {
                    die($e->getMessage());
                }
                $website=trim($Dummy->getWebsite());
                if(substr($website,$endCheckLen*-1)==$endCheck)  $dummy_filtered->write($dummy_line,null,$dummy_size);
            }
            $dummy_file->close();
            $dummy_filtered->close()->open($this->dummy_websites_filtered_path,"r")->seek(0);
            require $this->view_path."/exercise-response-2.php";
        }else{
            $extensions=$this->listDummyExtensions();
            require $this->view_path."/exercise-2.php";
        }
    }

    public function exercise3(){

    }
}