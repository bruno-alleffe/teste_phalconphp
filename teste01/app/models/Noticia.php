<?php

class Noticia extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $titulo;

    /**
     *
     * @var string
     */
    protected $texto;

    /**
     *
     * @var string
     */
    protected $data_ultima_atualizacao;

    /**
     *
     * @var string
     */
    protected $data_cadastro;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field titulo
     *
     * @param string $titulo
     * @return $this
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Method to set the value of field texto
     *
     * @param string $texto
     * @return $this
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Method to set the value of field data_ultima_atualizacao
     *
     * @param string $data_ultima_atualizacao
     * @return $this
     */
    public function setDataUltimaAtualizacao($data_ultima_atualizacao)
    {
        $this->data_ultima_atualizacao = $data_ultima_atualizacao;

        return $this;
    }

    /**
     * Method to set the value of field data_cadastro
     *
     * @param string $data_cadastro
     * @return $this
     */
    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Returns the value of field texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Returns the value of field data_ultima_atualizacao
     *
     * @return string
     */
    public function getDataUltimaAtualizacao()
    {
        return $this->data_ultima_atualizacao;
    }

    /**
     * Returns the value of field data_cadastro
     *
     * @return string
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcont_teste01");
        $this->setSource("noticia");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'noticia';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Noticia[]|Noticia|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Noticia|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'titulo' => 'titulo',
            'texto' => 'texto',
            'data_ultima_atualizacao' => 'data_ultima_atualizacao',
            'data_cadastro' => 'data_cadastro'
        ];
    }

}
