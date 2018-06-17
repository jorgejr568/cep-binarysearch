<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 16/06/18
 * Time: 14:38
 */

namespace CEPSearcher\Controller;


use CEPSearcher\Engine\File\File;
use CEPSearcher\Engine\Sort\Sort;
use CEPSearcher\Engine\View\View;
use CEPSearcher\Exception\InvalidBolsaLineException;
use CEPSearcher\Model\BolsaHash;
use CEPSearcher\Model\BolsaUser;

class BolsaHashController extends Controller
{
    const DEFAULT_HEADER_LINE=0;
    const DEFAULT_BITE_LINE=200;
    const CRYPT_USED="sha512";
    public function __construct()
    {

    }
    public function generate(){
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
                        foreach (config('bolsa_template') as $field) {
                            $BolsaHash = new BolsaHash(hash(self::CRYPT_USED, $BolsaUser->{"get".$field}()), (string)$offset, (string)$next_break);
                            $BolsaHash->save($field);
                            echo $count_lines.PHP_EOL;
                        }
                    } catch (InvalidBolsaLineException $e) {
                        die($e->getMessage());
                    }
                }
                if($count_lines==15000) break;
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
            $SearchCrypted  =   hash(self::CRYPT_USED,$Search);

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
                    $BolsaUser = (BolsaHash::create($line))->BolsaUser();
                    if($BolsaUser->{"get".$Field}() == $Search)
                        $BolsaUsers[] = $BolsaUser;

                }while(true);
                $BHF->close();
            }
            $View
                ->setView("bolsa-hash.response")
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
}