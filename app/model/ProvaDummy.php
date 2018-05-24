<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 24/05/18
 * Time: 19:11
 */

namespace CEPSearcher\Model;


use CEPSearcher\Exception\InvalidLineProvaDummy;

class ProvaDummy
{
    private $id;
    private $name;
    private $username;
    private $email;
    private $phone;
    private $website;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ProvaDummy
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ProvaDummy
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return ProvaDummy
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return ProvaDummy
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return ProvaDummy
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     * @return ProvaDummy
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * ProvaDummy constructor.
     * @param $id
     * @param $name
     * @param $username
     * @param $email
     * @param $phone
     * @param $website
     */
    public function __construct($id=null, $name=null, $username=null, $email=null, $phone=null, $website=null)
    {

        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->website = $website;
    }

    /**
     * @param $line
     * @throws InvalidLineProvaDummy
     */
    public static function create_from_line($line){
        $prova_dummy_template=config("prova_dummy_template");
        if(strlen($line)!=array_sum($prova_dummy_template)) throw new InvalidLineProvaDummy();
        $offset=0;
        $Dummy=new ProvaDummy();
        foreach ($prova_dummy_template as $target => $size) {
            if ($target != "_blank") $Dummy->{"set".ucfirst(strtolower($target))}(substr($line,$offset,$size));
            else break;
            $offset+=$size;
        }
        return $Dummy;
    }

    public function toLine(){
        $line="";
        $prova_dummy_template=config("prova_dummy_template");
        foreach ($prova_dummy_template as $field => $length)
            $line.=$this->{"get".ucfirst(strtolower($field))}();
        return $line;
    }
}