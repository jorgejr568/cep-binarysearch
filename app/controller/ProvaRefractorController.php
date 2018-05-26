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
    private $dummy_disordered_path="data/prova-dummy-desordered.dat";
    private $dummy_merge_path="data/prova-dummy-merge.dat";
    private $view_path="view/prova-refractor";


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
    private function websiteEndsWith($website,$end){
        return (substr($website,strlen($end)*-1)==$end);

    }
    public function exercise2(){
        $dummy_template=config("prova_dummy_template");
        $dummy_size=array_sum($dummy_template);
        if($this->isPost()){
            $dummy_file=File::create($this->dummy_path,"r");
            $dummy_filtered=File::create($this->dummy_websites_filtered_path,"w+");

            $end=trim($_POST['extension']);


            while(true){
                $dummy_line=$dummy_file->r($dummy_size);
                if($dummy_file->eof()) break;
                try {
                    $Dummy = ProvaDummy::create_from_line($dummy_line);
                } catch (InvalidLineProvaDummy $e) {
                    die($e->getMessage());
                }
                $website=trim($Dummy->getWebsite());
                if($this->websiteEndsWith($website,$end))  $dummy_filtered->write($dummy_line,null,$dummy_size);
            }
            $dummy_file->close();
            $dummy_filtered->close()->open($this->dummy_websites_filtered_path,"r")->seek(0);
            require $this->view_path."/exercise-response-2.php";
        }else{
            $extensions=$this->listDummyExtensions();
            require $this->view_path."/exercise-2.php";
        }
    }

    private function searchOnOrdered(File $file,$register_size,$id,$min,$max){
        $middle=ceil(($min+$max)/2);
        try {
            $Dummy = ProvaDummy::create_from_line($file->read($register_size,$middle*$register_size));
        } catch (InvalidLineProvaDummy $e) {
            die($e->getMessage());
        }
        $register_id=(int) $Dummy->getId();
        if($register_id==$id) return true;
        elseif($min==$max) return false;
        elseif($id<$register_id) return $this->searchOnOrdered($file,$register_size,$id,$min,$middle-1);
        else return $this->searchOnOrdered($file,$register_size,$id,$middle+1,$max);
    }

    public function exercise3(){
        $dummy_template=config("prova_dummy_template");


        $file_ordered=File::create($this->dummy_path,"r");
        $file_disordered=File::create($this->dummy_disordered_path,"r")->seek(0);

        $dummy_size=array_sum($dummy_template);
        $dummy_ordered_register_count=filesize($this->dummy_path)/$dummy_size;
        $file_merged=File::create($this->dummy_merge_path,"w+");
        while(true){
            $dummy_line=$file_disordered->r($dummy_size);
            if($file_disordered->eof()) break;
            try {
                $register_id = (int)ProvaDummy::create_from_line($dummy_line)->getId();
            } catch (InvalidLineProvaDummy $e) {
                die(var_dump($e->getMessage()));
            }
            if($this->searchOnOrdered($file_ordered,$dummy_size,$register_id,0,$dummy_ordered_register_count-1)) $file_merged->write($dummy_line,NULL,$dummy_size);
        }
        $file_merged->close()->open($this->dummy_merge_path,"r");
        require $this->view_path."/exercise-3.php";
        $file_disordered->close();
        $file_ordered->close();
        $file_merged->close();

    }
}