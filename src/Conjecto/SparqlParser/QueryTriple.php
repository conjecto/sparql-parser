<?php

namespace Conjecto\SparqlParser;

/**
 * Represents a query triple with subject, predicate and object.
 *
 * @package Conjecto\SparqlParser
 */
class QueryTriple
{

    /**
    * The QueryTriples Subject.
    * Can be a BlankNode or Resource, string in
    * case of a variable
    * @var Node/string
    */
    protected $subject;

    /**
    * The QueryTriples Predicate.
    * Normally only a Resource, string in
    * case of a variable
    * @var Node/string
    */
    protected $predicate;

    /**
    * The QueryTriples Object.
    * Can be BlankNode, Resource or Literal, string in
    * case of a variable
    * @var Node/string
    */
    protected $object;


    /**
    * Constructor
    *
    * @param Node $sub  Subject
    * @param Node $pred Predicate
    * @param Node $ob   Object
    */
    public function __construct($sub, $pred, $ob)
    {
        $this->subject   = $sub;
        $this->predicate = $pred;
        $this->object    = $ob;
    }

    /**
    * Returns the Triples Subject.
    *
    * @return Node
    */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
    * Returns the Triples Predicate.
    *
    * @return Node
    */
    public function getPredicate()
    {
        return $this->predicate;
    }

    /**
    * Returns the Triples Object.
    *
    * @return Node
    */
    public function getObject()
    {
        return $this->object;
    }

    /**
    *   Returns an array of all variables in this triple.
    *
    *   @return array   Array of variable names
    */
    public function getVariables()
    {
        $arVars = array();

        foreach (array('subject', 'predicate', 'object') as $strVar) {
            if (SparqlVariable::isVariable($this->$strVar)) {
                $arVars[] = $this->$strVar;
            }
        }

        return $arVars;
    }

    /**
     * _clone
     */
    public function __clone()
    {
        foreach (array('subject', 'predicate', 'object') as $strVar) {
            if (is_object($this->$strVar)) {
                $this->$strVar = clone $this->$strVar;
            }
        }
    }

}
?>
