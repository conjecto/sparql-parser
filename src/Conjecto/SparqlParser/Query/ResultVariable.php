<?php

namespace Conjecto\SparqlParser\Query;

use Conjecto\SparqlParser\Query;

/**
 * Class ResultVariable
 * @package Conjecto\SparqlParser\Query
 */
class ResultVariable
{
    /**
     * @var null
     */
    public $variable = null;

    /**
     * @var null
     */
    public $datatype = null;

    /**
     * @var mixed|null
     */
    public $language = null;

    /**
     * @var null
     */
    public $alias    = null;

    /**
     * @var null
     */
    public $func     = null;

    /**
     * @param $variable
     */
    public function __construct($variable)
    {
        $this->variable = $variable;
        $this->language = Query::getLanguageTag($variable);
    }

    /**
     * @param $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @param $func
     */
    public function setFunc($func)
    {
        $this->func = $func;
    }

    /**
     * @param $datatype
     */
    public function setDatatype($datatype)
    {
        $this->datatype = $datatype;
    }

    /**
     * @return null
     */
    public function getId()
    {
        //FIXME
        return $this->variable;
    }

    /**
     * @return null
     */
    public function getFunc()
    {
        return $this->func;
    }

    /**
     * @return mixed|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return null
     */
    public function getDatatype()
    {
        return $this->datatype;
    }

    /**
     * @return null
     */
    public function getName()
    {
        if ($this->alias !== null) {
            return $this->alias;
        }
        //FIXME: support for nested(functions())
        return $this->variable;
    }

    /**
     * @return null
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @return null
     */
    public function __toString()
    {
        return $this->getName();
    }
}
