<?php
/**
 * Created by PhpStorm.
 * User: aluno
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
            printf("ERRO 500 - CEP DAT FILE WASN'T FOUND!\n");
            exit(500);
        }
        return $this;
    }

    public function read($bytes,$offset=null){
        if($offset){
            fseek($this->stream,$offset);
        }else rewind($this->stream);
        return fread($this->stream,$bytes);
    }

    public function close(){
        fclose($this->stream);
        return $this;
    }
}