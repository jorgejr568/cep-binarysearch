<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 16/06/18
 * Time: 14:38
 */

namespace CEPSearcher\Controller;


use CEPSearcher\Engine\File\File;
use CEPSearcher\Engine\Hash\Hash;
use CEPSearcher\Engine\View\View;
use CEPSearcher\Exception\InvalidBolsaLineException;
use CEPSearcher\Model\BolsaHash;
use CEPSearcher\Model\BolsaUser;

class BolsaHashController extends Controller
{
    const DEFAULT_HEADER_LINE=0;
    const DEFAULT_BITE_LINE=200;
    const GENERATE_REGISTERS=-1;

    public function __construct()
    {

    }
    public function generate(){
        $BT = config('bolsa_template');
        $bolsa_path= getcwd()."/data/bolsa-hash/";
        foreach ($BT as $bolsa_folder){
            $bolsa_field_path = $bolsa_path.strtoupper($bolsa_folder);
            if(is_dir($bolsa_field_path) ) shell_exec("rm -Rf {$bolsa_field_path}");
        }
        if(file_exists($bolsa_path."/DELETED_REGISTERS.pak") ) shell_exec("rm -Rf {$bolsa_path}/DELETED_REGISTERS.pak");

        $File = File::create("data/bolsa.csv","r");
        $count_lines=0;
        $line="";
        $offset=0;
        do{
            $line.=$File->r(self::DEFAULT_BITE_LINE);
            $next_break=strpos($line,"\n");

            if(strlen($line)==0 && $File->eof()) break;

            if($next_break!==FALSE) {
                $line = substr($line, 0, ($next_break-1));
                if($count_lines!=self::DEFAULT_HEADER_LINE) {
                    try {
                        $BolsaUser = BolsaUser::create($line);
                        foreach ($BT as $field) {
                            $BolsaHash = new BolsaHash(Hash::bolsa($BolsaUser->{"get".$field}()), (string)$offset, (string)$next_break);
                            $BolsaHash->save($field);
                            echo $count_lines.PHP_EOL;
                        }
                    } catch (InvalidBolsaLineException $e) {
                        die($e->getMessage());
                    }
                }
                if($count_lines==self::GENERATE_REGISTERS) break;
                $offset=$offset+$next_break+1;
                $File->seek($offset);
                $count_lines++;
                $line = "";
            }
            else {
                $offset += self::DEFAULT_BITE_LINE;
            }

        }while(true);
    }

    public function index(){
        $View = new View();
        $View->setVariable("BT",config('bolsa_template'));

        if($this->isPost()){
            $Field          =   $_POST['field'];
            $Search         =   $_POST['value'];
            $SearchCrypted  =   Hash::bolsa($Search);

            $FieldMapper    =   "data/bolsa-hash/".strtoupper($Field);

            $BolsaUsers     =   [];
            $PakFile        =   $FieldMapper.DIRECTORY_SEPARATOR.$SearchCrypted.".pak";
            $BHT            =   config("bolsa_hash_template");
            $BHT_size       =   array_sum($BHT);

            if(file_exists($PakFile)) {
                /** @var File $BHF */
                $BHF = File::create($PakFile,"r");

                do{
                    $line = $BHF->r($BHT_size);
                    if($BHF->eof()) break;
                    $BolsaHash = BolsaHash::create($line);
                    $BolsaUser = $BolsaHash->BolsaUser();
                    if($BolsaUser->{"get".$Field}() == $Search && $BolsaHash->valid())
                        $BolsaUsers[] = [
                            "user" => $BolsaUser,
                            "hash" => $BolsaHash
                        ];

                }while(true);
                $BHF->close();
            }
            $View
                ->setView("bolsa-hash.search")
                ->setVariable("BolsaUsers",$BolsaUsers)
                ->setVariable(compact(['Field',"Search","SearchCrypted"]))
                ->run();
        }
        else{
            $View
                ->setView("bolsa-hash.index")
                ->run();
        }
    }

    public function create(){
        $View = new View();
        $BT = config('bolsa_template');
        if($this->isPost()){
            $data = [];
            foreach ($BT as $config) $data[$config] = isset($_POST[$config]) ? trim($_POST[$config]) : null;
            $errors = [];

            foreach ($data as $info => $datum) if(strlen($datum)<1) $errors[] = "$info -> Este campo precisa ser preenchido";
            if(count($errors)>0){
                header("Location: bolsa-hash-create.php?".http_build_query(["errors" => $errors,"old" => $data]));
                exit;
            }

            $BolsaUser = new BolsaUser();
            foreach ($data as $info => $datum) $BolsaUser->{"set".$info}($datum);


            $BolsaUser->save();

            $View
                ->setView("bolsa-hash.stored")
                ->setVariable([
                    "BT" => $BT,
                    "BolsaUser" => $BolsaUser,
                ])
                ->run();

        }else{
            $errors = isset($_GET['errors'])? $_GET['errors'] : [];
            $old = isset($_GET['old'])? $_GET['old'] : null;
            $View
                ->setVariable("BT",$BT)
                ->setVariable("errors",$errors)
                ->setVariable("old",$old)
                ->setView("bolsa-hash.create")
                ->run();
        }
    }
    public function remove(){
        $View = new View();
        $BT = config('bolsa_template');
        if($this->isPost()){

            $length = isset($_POST['length']) ? $_POST['length'] : null;
            $offset = isset($_POST['offset']) ? $_POST['offset'] : null;
            $BolsaHash = new BolsaHash(null,$offset,$length);

            $BolsaHash->delete();

            $View
                ->setView("bolsa-hash.deleted")
                ->setVariable([
                    "BT" => $BT,
                    "BolsaHash" => $BolsaHash,
                ])
                ->run();

        }else{
            $length = isset($_GET['length']) ? $_GET['length'] : null;
            $offset = isset($_GET['offset']) ? $_GET['offset'] : null;
            $BolsaHash = new BolsaHash(null,$offset,$length);

            if($BolsaHash->valid()) $BolsaUser= $BolsaHash->BolsaUser();
            else $BolsaUser = null;
            $View
                ->setVariable([
                    "BT" => $BT,
                    "BolsaUser" => $BolsaUser,
                    "offset" => $offset,
                    "length" => $length
                ])
                ->setView("bolsa-hash.remove")
                ->run();
        }
    }

    public function update(){
        $View = new View();
        $BT = config('bolsa_template');
        if($this->isPost()){
            $length = isset($_POST['length']) ? $_POST['length'] : null;
            $offset = isset($_POST['offset']) ? $_POST['offset'] : null;

            $data = [];
            foreach ($BT as $config) $data[$config] = isset($_POST[$config]) ? trim($_POST[$config]) : null;
            $errors = [];

            foreach ($data as $info => $datum) if(strlen($datum)<1) $errors[] = "$info -> Este campo precisa ser preenchido";
            if(count($errors)>0){
                header("Location: bolsa-hash-update.php?".http_build_query(["errors" => $errors,"old" => $data,
                        "offset" => $offset,"length" => $length]));
                exit;
            }

            $BolsaUser = new BolsaUser();
            foreach ($data as $info => $datum) $BolsaUser->{"set".$info}($datum);

            $BolsaHash = new BolsaHash(null,$offset,$length);

            $BolsaHash->delete();

            $BolsaUser->save();

            $View
                ->setView("bolsa-hash.updated")
                ->setVariable([
                    "BT" => $BT,
                    "BolsaUser" => $BolsaUser,
                ])
                ->run();

        }else{
            $errors = isset($_GET['errors'])? $_GET['errors'] : [];
            $old = isset($_GET['old'])? $_GET['old'] : null;

            $length = isset($_GET['length']) ? $_GET['length'] : null;
            $offset = isset($_GET['offset']) ? $_GET['offset'] : null;
            $BolsaHash = new BolsaHash(null,$offset,$length);

            if($BolsaHash->valid()) $BolsaUser= $BolsaHash->BolsaUser();
            else $BolsaUser = null;
            $View
                ->setVariable("errors",$errors)
                ->setVariable("old",$old)
                ->setVariable([
                    "BT" => $BT,
                    "BolsaUser" => $BolsaUser,
                    "offset" => $offset,
                    "length" => $length
                ])
                ->setView("bolsa-hash.edit")
                ->run();
        }
    }
}