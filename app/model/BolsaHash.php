<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 16/06/18
 * Time: 15:38
 */

namespace CEPSearcher\Model;


use CEPSearcher\Engine\File\File;
use CEPSearcher\Exception\InvalidBolsaLineException;

class BolsaHash
{
    private $hash;
    private $offset;
    private $size;

    /**
     * BolsaHash constructor.
     * @param $hash
     * @param $offset
     * @param $size
     */
    public function __construct($hash=null, $offset=null, $size=null)
    {

        $this->hash = $hash;
        $this->offset = $offset;
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     * @return BolsaHash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param mixed $offset
     * @return BolsaHash
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     * @return BolsaHash
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param $line
     * @return BolsaHash
     */
    public static function create($line){
        $bolsa_hash_template=config("bolsa_hash_template");
        $BolsaHash = new BolsaHash();
        $offset=0;
        foreach ($bolsa_hash_template as $field => $size){
            if($field!="blank")
                $BolsaHash->{"set".ucfirst($field)}(substr($line,$offset,$size));

            $offset+=$size;
        }
        return $BolsaHash;
    }
    public function toLine(){
        $bolsa_hash_template=config("bolsa_hash_template");
        $line="";
        foreach ($bolsa_hash_template as $field => $size){
            if($field!="blank") $line.=str_pad(
                $this->{"get".ucfirst($field)}(),
                $size,
                " ",
                STR_PAD_RIGHT
            );
        }
        $line.=PHP_EOL;
        return $line;
    }
    public function save($field_hashed){
        $field_hashed=strtoupper($field_hashed);
        $hash_map_dir = "data/bolsa-hash/{$field_hashed}";
        if(!is_dir($hash_map_dir)) mkdir($hash_map_dir,0755,true);
        $hash_map_file = "data/bolsa-hash/{$field_hashed}/{$this->getHash()}.pak";
        $hash_map_line_size = array_sum(config("bolsa_hash_template"));
        if(file_exists($hash_map_file)) {
            $File = File::create($hash_map_file, "a");
        }
        else $File = File::create($hash_map_file,"w+");

        $File->write($this->toLine(),null,$hash_map_line_size)->close();
    }

    public function BolsaUser(){
        $File = File::create("data/bolsa.csv","r");

        $line = $File->read(((int) $this->size)-1,(int) $this->offset);
        if (mb_detect_encoding($line, 'utf-8', true) === false) {
            $line = mb_convert_encoding($line, 'utf-8', 'iso-8859-1');
        }
        $File->close();
        try {
            return BolsaUser::create($line);
        } catch (InvalidBolsaLineException $e) {
            die($e->getMessage());
        }
    }

    public function valid(){
        $deleted_registers_path = "data/bolsa-hash/DELETED_REGISTERS.pak";

        if(!file_exists("data/bolsa-hash/DELETED_REGISTERS.pak")) return true;
        else {
            $File = File::create("data/bolsa-hash/DELETED_REGISTERS.pak", "r");
            $template = config("bolsa_hash_template");
            $template_len = array_sum($template);
            do {
                $line = $File->r($template_len);
                if ($File->eof()) break;
                $BolsaHash = BolsaHash::create($line);
                if ($this->offset == (int)$BolsaHash->getOffset() && $this->size == (int)$BolsaHash->getSize()) return false;
            } while (true);
            return true;
        }
    }

    public function delete(){
        $File = File::create("data/bolsa-hash/DELETED_REGISTERS.pak","a");
        $File->write($this->toLine());
        $File->close();
        return $this;
    }
}
