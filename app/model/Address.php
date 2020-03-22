<?php
/**
 * Created by PhpStorm.
 * User: jorgejr568
 * Date: 22/03/18
 * Time: 17:32
 */

namespace CEPSearcher\Model;


use CEPSearcher\Exception\InvalidCEPFormat;
use CEPSearcher\Exception\InvalidLineAddress;

class Address
{
    /**
     * @var null
     */
    private $cidade;
    /**
     * @var null
     */
    private $bairro;
    /**
     * @var null
     */
    private $logradouro;
    /**
     * @var null
     */
    private $estado;
    /**
     * @var null
     */
    private $uf;
    /**
     * @var null
     */
    private $cep;

    /**
     * Address constructor.
     * @param string $cidade
     * @param string $bairro
     * @param string $logradouro
     * @param string $estado
     * @param string $uf
     * @param string $cep
     */
    public function __construct($cidade=null, $bairro=null, $logradouro=null, $estado=null, $uf=null, $cep=null)
    {

        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->logradouro = $logradouro;
        $this->estado = $estado;
        $this->uf = $uf;
        $this->cep = $cep;
    }

    /**
     * @param string|null $cidade
     * @return Address|string
     */
    public function cidade($cidade=null)
    {
        if(!is_null($cidade)) {
            $this->cidade = $cidade;
            return $this;
        }else return $this->cidade;
    }

    /**
     * @param string|null $bairro
     * @return Address|string
     */
    public function bairro($bairro=null)
    {
        if(!is_null($bairro)) {
            $this->bairro = $bairro;
            return $this;
        }else return $this->bairro;
    }

    /**
     * @param string|null $logradouro
     * @return Address|string
     */
    public function logradouro($logradouro=null)
    {
        if(!is_null($logradouro)) {
            $this->logradouro = $logradouro;
            return $this;
        }else return $this->logradouro;
    }
    /**
     * @param string|null $cidade
     * @return Address|string
     */
    public function estado($estado=null)
    {
        if(!is_null($estado)) {
            $this->estado = $estado;
            return $this;
        }else return $this->estado;
    }

    /**
     * @param string|null $bairro
     * @return Address|string
     */
    public function uf($uf=null)
    {
        if(!is_null($uf)) {
            $this->uf = $uf;
            return $this;
        }else return $this->uf;
    }

    /**
     * @param string|null $logradouro
     * @return Address|string
     */
    public function cep($cep=null)
    {
        if(!is_null($cep)) {
            $this->cep = $cep;
            return $this;
        }else return $this->cep;
    }

    /**
     * @param $line
     * @return Address | null
     * @throws InvalidLineAddress
     */
    public static function create_from_line($line){
        if(mb_strlen($line)!=300) throw new InvalidLineAddress();
        $address=new Address();
        return $address
            ->logradouro(mb_substr($line,0,72))
            ->bairro(mb_substr($line,72,72))
            ->cidade(mb_substr($line,144,72))
            ->estado(mb_substr($line,216,72))
            ->uf(mb_substr($line,288,2))
            ->cep(mb_substr($line,290,8));
    }

    public function blank_space(){
        return " \n";
    }
    public function toLine(){
        $line="";
        $address_template=config("address_template");
        foreach ($address_template as $field => $length)
            $line.=$this->$field();
        return $line;
    }

    /**
     * @param $cep
     * @return string
     * @throws InvalidCEPFormat
     */
    public static function cepHumanFormat($cep){
        if(strlen($cep)=="8"){
            return sprintf("%.5s-%.3s",substr($cep,0,5),substr($cep,5,3));
        }else {
            throw new InvalidCEPFormat();
        }
    }
}