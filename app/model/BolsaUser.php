<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 16/06/18
 * Time: 14:09
 */

namespace CEPSearcher\Model;


use CEPSearcher\Controller\BolsaHashController;
use CEPSearcher\Engine\File\File;
use CEPSearcher\Exception\InvalidBolsaLineException;

class BolsaUser
{
    /**
     * @var null
     */
    private $UF;
    /**
     * @var null
     */
    private $codigo_SIAFI_municipio;
    /**
     * @var null
     */
    private $nome_municipio;
    /**
     * @var null
     */
    private $codigo_funcao;
    /**
     * @var null
     */
    private $codigo_subfuncao;
    /**
     * @var null
     */
    private $codigo_programa;
    /**
     * @var null
     */
    private $codigo_acao;
    /**
     * @var null
     */
    private $NIS_favorecido;
    /**
     * @var null
     */
    private $nome_favorecido;
    /**
     * @var null
     */
    private $fonte_finalidade;
    /**
     * @var null
     */
    private $valor_parcela;
    /**
     * @var null
     */
    private $mes_competencia;

    /**
     * BolsaUser constructor.
     * @param null $UF
     * @param null $codigo_SIAFI_municipio
     * @param null $nome_municipio
     * @param null $codigo_funcao
     * @param null $codigo_subfuncao
     * @param null $codigo_programa
     * @param null $codigo_acao
     * @param null $NIS_favorecido
     * @param null $nome_favorecido
     * @param null $fonte_finalidade
     * @param null $valor_parcela
     * @param null $mes_competencia
     */
    public function __construct($UF=null, $codigo_SIAFI_municipio=null, $nome_municipio=null, $codigo_funcao=null,
                                $codigo_subfuncao=null, $codigo_programa=null, $codigo_acao=null, $NIS_favorecido=null,
                                $nome_favorecido=null, $fonte_finalidade=null, $valor_parcela=null, $mes_competencia=null)
    {

        $this->UF = $UF;
        $this->codigo_SIAFI_municipio = $codigo_SIAFI_municipio;
        $this->nome_municipio = $nome_municipio;
        $this->codigo_funcao = $codigo_funcao;
        $this->codigo_subfuncao = $codigo_subfuncao;
        $this->codigo_programa = $codigo_programa;
        $this->codigo_acao = $codigo_acao;
        $this->NIS_favorecido = $NIS_favorecido;
        $this->nome_favorecido = $nome_favorecido;
        $this->fonte_finalidade = $fonte_finalidade;
        $this->valor_parcela = $valor_parcela;
        $this->mes_competencia = $mes_competencia;
    }

    /**
     * @return null
     */
    public function getUF()
    {
        return $this->UF;
    }

    /**
     * @param null $UF
     * @return BolsaUser
     */
    public function setUF($UF)
    {
        $this->UF = $UF;
        return $this;
    }

    /**
     * @return null
     */
    public function getCodigoSIAFIMunicipio()
    {
        return $this->codigo_SIAFI_municipio;
    }

    /**
     * @param null $codigo_SIAFI_municipio
     * @return BolsaUser
     */
    public function setCodigoSIAFIMunicipio($codigo_SIAFI_municipio)
    {
        $this->codigo_SIAFI_municipio = $codigo_SIAFI_municipio;
        return $this;
    }

    /**
     * @return null
     */
    public function getNomeMunicipio()
    {
        return $this->nome_municipio;
    }

    /**
     * @param null $nome_municipio
     * @return BolsaUser
     */
    public function setNomeMunicipio($nome_municipio)
    {
        $this->nome_municipio = $nome_municipio;
        return $this;
    }

    /**
     * @return null
     */
    public function getCodigoFuncao()
    {
        return $this->codigo_funcao;
    }

    /**
     * @param null $codigo_funcao
     * @return BolsaUser
     */
    public function setCodigoFuncao($codigo_funcao)
    {
        $this->codigo_funcao = $codigo_funcao;
        return $this;
    }

    /**
     * @return null
     */
    public function getCodigoSubfuncao()
    {
        return $this->codigo_subfuncao;
    }

    /**
     * @param null $codigo_subfuncao
     * @return BolsaUser
     */
    public function setCodigoSubfuncao($codigo_subfuncao)
    {
        $this->codigo_subfuncao = $codigo_subfuncao;
        return $this;
    }

    /**
     * @return null
     */
    public function getCodigoPrograma()
    {
        return $this->codigo_programa;
    }

    /**
     * @param null $codigo_programa
     * @return BolsaUser
     */
    public function setCodigoPrograma($codigo_programa)
    {
        $this->codigo_programa = $codigo_programa;
        return $this;
    }

    /**
     * @return null
     */
    public function getCodigoAcao()
    {
        return $this->codigo_acao;
    }

    /**
     * @param null $codigo_acao
     * @return BolsaUser
     */
    public function setCodigoAcao($codigo_acao)
    {
        $this->codigo_acao = $codigo_acao;
        return $this;
    }

    /**
     * @return null
     */
    public function getNISFavorecido()
    {
        return $this->NIS_favorecido;
    }

    /**
     * @param null $NIS_favorecido
     * @return BolsaUser
     */
    public function setNISFavorecido($NIS_favorecido)
    {
        $this->NIS_favorecido = $NIS_favorecido;
        return $this;
    }

    /**
     * @return null
     */
    public function getNomeFavorecido()
    {
        return $this->nome_favorecido;
    }

    /**
     * @param null $nome_favorecido
     * @return BolsaUser
     */
    public function setNomeFavorecido($nome_favorecido)
    {
        $this->nome_favorecido = $nome_favorecido;
        return $this;
    }

    /**
     * @return null
     */
    public function getFonteFinalidade()
    {
        return $this->fonte_finalidade;
    }

    /**
     * @param null $fonte_finalidade
     * @return BolsaUser
     */
    public function setFonteFinalidade($fonte_finalidade)
    {
        $this->fonte_finalidade = $fonte_finalidade;
        return $this;
    }

    /**
     * @return null
     */
    public function getValorParcela()
    {
        return $this->valor_parcela;
    }

    /**
     * @param null $valor_parcela
     * @return BolsaUser
     */
    public function setValorParcela($valor_parcela)
    {
        $this->valor_parcela = $valor_parcela;
        return $this;
    }

    /**
     * @return null
     */
    public function getMesCompetencia()
    {
        return $this->mes_competencia;
    }

    /**
     * @param null $mes_competencia
     * @return BolsaUser
     */
    public function setMesCompetencia($mes_competencia)
    {
        $this->mes_competencia = $mes_competencia;
        return $this;
    }

    /**
     * @param $line
     * @return BolsaUser
     * @throws InvalidBolsaLineException
     */
    public static function create($line){
        $template = config("bolsa_template");
        $offset=0;
        $BolsaUser = new BolsaUser();
        foreach ($template as $key => $field) {
            $next_tab=strpos($line,"\t",$offset);
            if($next_tab!==FALSE){
                $BolsaUser->{"set".$field}(substr($line,$offset,($next_tab-$offset)));
                $offset=($next_tab+1);
            }
            else{
                if(count($template)==($key+1)){
                    $BolsaUser->{"set".$field}(substr($line,$offset));
                }else throw new InvalidBolsaLineException("INVALID BOLSA LINE!");
            }
        }
        return $BolsaUser;
    }
    public function toLine(){
        $template = config("bolsa_template");
        $line="";
        foreach ($template as $key => $field) {
            $line.=$this->{"get".$field}();
            $line .= (count($template) == ($key + 1) ? "\n" : "\t");
        }
        return $line;
    }

    public function save(){
        $line= $this->toLine();
        $line_len = strlen($line);
        $offset = filesize("data/bolsa.csv");

        $File = (File::create("data/bolsa.csv","a"));
        $File->write($line)->close();


        foreach (config('bolsa_template') as $field) {
            $BolsaHash = new BolsaHash(
                hash(BolsaHashController::CRYPT_USED, $this->{"get".$field}()),
                (string) $offset,
                (string) $line_len
            );

            $BolsaHash->save($field);
        }
    }
}