<?php
/**
 * Created by PhpStorm.
 * User: jorgejr568
 * Date: 22/03/18
 * Time: 19:31
 */

namespace CEPSearcher\Engine\File;


class File
{
    private $stream;

    /**
     * @param $path
     * @param $mode
     * @return $this
     */
    public function open($path, $mode){
        if(!$this->stream=fopen($path,$mode)){
            printf("ERRO 500 - FILE COULDN'T BE OPENED!\n");
            exit(500);
        }
        return $this;
    }

    public function read($bytes,$offset=null){
        if($offset){
            $this->seek($offset);
        }else rewind($this->stream);
        return mb_convert_encoding(fread($this->stream,$bytes),'UTF-8','ISO-8859-1');
    }

    public function r($bytes){
        return fread($this->stream,$bytes);
    }
    public function rewind(){
        rewind($this->stream);
        return $this;
    }

    public function close(){
        fclose($this->stream);
        return $this;
    }

    public function seek($offset){
        fseek($this->stream,$offset);
        return $this;
    }

    public function write($content,$offset=null,$length=null){
        if($offset===0) $this->rewind();
        elseif($offset>0) $this->seek($offset);

        if($length===null) fwrite($this->stream,$content);
        else fwrite($this->stream,$content,$length);

        return $this;
    }

    public function eof(){
        return feof($this->stream);
    }
    public static function create($path, $mode){
        $File=new File();
        $File->open($path,$mode);
        return $File;
    }
}