<?php

namespace Conjecto\SparqlParser;

/**
 * Object representation of a SPARQL variable.
 *
 * @package Conjecto\SparqlParser
 */
class SparqlVariable
{
    /**
     * @var string
     */
    public $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
    *   Checks if the given subject/predicate/object
    *   is a variable name.
    *
    *   @return boolean
    */
    public static function isVariable($bject)
    {
        return is_string($bject) && strlen($bject) >= 2
             && ($bject[0] == '?' || $bject[0] == '$');
    }
}
?>
