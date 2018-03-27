<?php
/**
 * Created by PhpStorm.
 * User: jorgejr568
 * Date: 22/03/18
 * Time: 19:13
 */

namespace CEPSearcher\Controller;


use CEPSearcher\Engine\File\File;
use CEPSearcher\Exception\InvalidCEPFormat;
use CEPSearcher\Exception\InvalidLineAddress;
use CEPSearcher\Model\Address;

class AddressController
{
    private $consults=[

    ];

    /**
     * @param array|null $consult
     * @return AddressController|array
     */
    public function consults(array $consult=null)
    {
        if(!is_null($consult)) {
            $this->consults[] = $consult;
            return $this;
        }else return $this->consults;
    }

    public function binarySearch(File $file,$cep, $line_size, $min, $max){
        $middle=ceil(($max+$min)/2);
        /** @var array <Address> $lines */
        $lines=[
            "min" => $file->read($line_size,($line_size*$min)),
            "middle" => $file->read($line_size,($line_size*$middle)),
            "max" => $file->read($line_size,($line_size*$max))
        ];


        try {
            $lines=array_map(function ($line){
                return Address::create_from_line($line);
            }, $lines);
        }catch (InvalidLineAddress $exception){
            die($exception->getMessage());
        }
        $this->consults([
            "min" => $min." (".Address::cepHumanFormat($lines['min']->cep()).")",
            "middle" => $middle." (".Address::cepHumanFormat($lines['middle']->cep()).")",
            "max" => $max." (".Address::cepHumanFormat($lines['max']->cep()).")"
        ]);
        if($lines['min']->cep()==$cep){
            return $lines['min'];
        }
        elseif($lines['middle']->cep()==$cep){
            return $lines['middle'];
        }
        elseif($lines['max']->cep()==$cep){
            return $lines['max'];
        }
        elseif(($max-$min)<=1){
            return false;
        }
        elseif(
            (int) $lines['min']->cep()< (int) $cep &&
            (int) $lines['middle']->cep() > (int) $cep
        ){
            return $this->binarySearch($file,$cep,$line_size,$min+1,$middle-1);
        }
        else{
            return $this->binarySearch($file,$cep,$line_size,$middle+1,$max-1);

        }
    }

    private function cepOrder(){
        $file_path="data/cep.dat";
        $output_path="data/cep-ordered.dat";
        $file=new File();
        $file->open($file_path,"r");
        $line_size=array_sum(config('address_template'));
        $addresses=[];
        $pointer_offset=0;
        while($line = $file->read($line_size,($line_size*$pointer_offset))){
            if(empty($line)) break;
            try {
                $addresses[] = Address::create_from_line($line);
            } catch (InvalidLineAddress $e) {
                echo "ERROR ".$e->getCode()." - ".$e->getMessage().PHP_EOL;
                exit($e->getCode());
            }
            $pointer_offset++;
        }
        $count_addresses=count($addresses);
        for($i=0;$i<$count_addresses;$i++){
            for($j=0;$j<($count_addresses-$i-1);$j++){
                if($addresses[$j]->cep() > $addresses[$j+1]->cep()){
                    printf("(%d - %d | %d > %d ) ",$i,$j,$addresses[$j]->cep(),$addresses[$j+1]->cep());
                    echo "$j <-> ".($j+1)." \n";
                    $c=$addresses[$j];
                    $addresses[$j]=$addresses[($j+1)];
                    $addresses[($j+1)]=$c;
                    unset($c);
                }
            }
        }

        $output=new File();
        $output->open($output_path,"w+");

        foreach ($addresses as $line_i => $address) {
            /** @var Address $address */
            $output->write($address->toLine(), null, $line_size);
            echo "-> Writing line #$line_i [cep=".$address->cep()."]\n";
        }
        $output->close();
    }

    private function cepParseOnlyNumbers($cep){
        preg_match_all("/[0-9]+/",$cep,$cep_number_match,PREG_PATTERN_ORDER);
        $cep=implode("",array_unique($cep_number_match[0]));
        unset($cep_number_match);
        return $cep;
    }

    /**
     * @param $cep
     * @return bool
     * @throws InvalidCEPFormat
     */
    private function abstractProcedure($cep){
        $cep=$this->cepParseOnlyNumbers($cep);
        if(strlen($cep)!=8) throw new InvalidCEPFormat();

        $file_template=config("address_template");
        $file_path="data/cep-ordered.dat";

        if(!file_exists($file_path)){
            $this->cepOrder();
        }
        $file_size=filesize($file_path);
        $line_size=array_sum($file_template);
        $file_lines=$file_size/$line_size;
        $search_opts=[
            "max" => $file_lines-1,
            "min" => 0
        ];

        $file=new File();
        $file->open($file_path,"r");
        $address=$this->binarySearch($file,$cep,$line_size,$search_opts['min'],$search_opts['max']);
        $file->close();
        return $address;
    }
    public function run(){
        if(php_sapi_name()=="cli"){
            /*
             * IF is console executed
             */
            if($GLOBALS['argc']<2) {
                echo "ERRO 401 - CEP wasn't informed!\n";
                exit(401);
            }
            $cep=$GLOBALS['argv'][1];
            try {
                /** @var Address $address */
                $address=$this->abstractProcedure($cep);
            }catch (InvalidCEPFormat $exception){
                echo "ERRO ".$exception->getCode()." - ".$exception->getMessage()."\n";
                exit($exception->getCode());
            }
            if($address){
                echo PHP_EOL;
                foreach (config("address_template") as $config => $size){
                    if($config!="blank_space") printf("%s: %.".$size."s\n",strtoupper($config),$address->$config());
                }
            }else{
                echo "\n- CEP NÃO ENCONTRADO -\n";
            }
        }
        else {
            header("Content-type: text/html; charset=utf-8");

            if (!isset($_GET['cep'])) {
                header("HTTP/1.1 401 CEP wasn't informed!");
                echo "<h1>ERRO 401 - CEP wasn't informed!</h1>";
                exit(500);
            }
            $cep = $_GET['cep'];
            try {
                /** @var Address $address */
                $address = $this->abstractProcedure($cep);
            } catch (InvalidCEPFormat $exception) {
                header("HTTP/1.1 " . $exception->getCode() . " " . $exception->getMessage());
                echo "<h1>ERRO " . $exception->getCode() . " - " . $exception->getMessage() . "</h1>";
                exit($exception->getCode());
            }
            if ($address) header("HTTP/1.1 200 OK");
            else header("HTTP/1.1 404 CEP NOT FOUND");
            require "view/response.php";
        }
    }
}