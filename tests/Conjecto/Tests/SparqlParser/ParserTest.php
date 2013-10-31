<?php

namespace Conjecto\Tests\SparqlParser;

use Conjecto\SparqlParser\GraphPattern;
use Conjecto\SparqlParser\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Parser
     */
    private $parser;

    /**
     * setUp
     */
    protected function setUp() {
        $this->parser = new Parser();
    }

    /**
     * testParseSimple
     */
    public function testParseSelect()
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
}
