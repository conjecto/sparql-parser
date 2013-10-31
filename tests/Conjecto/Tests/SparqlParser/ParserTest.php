<?php

namespace Conjecto\Tests\SparqlParser;

use Conjecto\SparqlParser\GraphPattern;
use Conjecto\SparqlParser\Parser;
use Conjecto\SparqlParser\QueryTriple;

class ParserTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var string
     */
    private $prefixes = "PREFIX foaf: <http://xmlns.com/foaf/0.1/>\n";

    /**
     * setUp
     */
    protected function setUp() {
        $this->parser = new Parser();
    }

    /**
     * testParseSelect
     */
    public function _testParseSelect()
    {
        $query = $this->parser->parse("SELECT ?a ?b ?c WHERE { ?d ?e ?f }");
        $this->assertEquals("select", $query->getResultForm());
        $this->assertCount(3, $query->getResultVars());
        $this->assertEquals("select", $query->getResultForm());

        $resultPart = $query->getResultPart();
        $this->assertCount(1, $resultPart);

        /** @var GraphPattern $graphPattern */
        $graphPattern = current($resultPart);
        $this->assertInstanceOf('Conjecto\SparqlParser\GraphPattern', $graphPattern);
        $this->assertCount(3, $graphPattern->getVariables());
    }

    /**
     * testParseSubquery
     */
    public function testParseDescribe()
    {
//        $query = $this->parser->parse("DESCRIBE <http://www.w3.org/People/Berners-Lee/card.rdf‎>")
        $query = $this->parser->parse($this->prefixes."DESCRIBE ?x WHERE { <http://www.w3.org/People/Berners-Lee/card.rdf‎> foaf:knows ?x }");
        $this->assertEquals("describe", $query->getResultForm());
        $this->assertCount(1, $query->getResultVars());

        $resultPart = $query->getResultPart();
        $this->assertCount(1, $resultPart);

        /** @var GraphPattern $graphPattern */
        $graphPattern = current($resultPart);
        /** @var QueryTriple $triplePattern */
        $triplePattern = current($graphPattern->getTriplePatterns());
        $this->assertInstanceOf('EasyRdf_Resource', $triplePattern->getSubject());
        $this->assertInstanceOf('EasyRdf_Resource', $triplePattern->getPredicate());
        $this->assertEquals("?x", $triplePattern->getObject());
    }

    /**
     * testParseSubquery
     * @todo
     */
    public function _testParseSubquery()
    {
        $query = $this->parser->parse($this->prefixes."SELECT ?uri ?p ?o WHERE { { SELECT DISTINCT ?uri WHERE {?uri a foaf:Person} LIMIT 10 }. ?uri ?p ?o}");
        $this->assertEquals("select", $query->getResultForm());
    }
}
