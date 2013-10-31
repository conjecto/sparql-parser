<?php

namespace Conjecto\SparqlParser;

/**
 * Class ParseException
 *
 * @package Conjecto\SparqlParser
 */
class ParseException extends \Exception
{
    /**
     * @var \Exception
     */
    private $tokenPointer;

    /**
     * @param string $message
     * @param int $code
     * @param \Exception $pointer
     */
    public function __construct($message, $code = 0, $pointer)
    {
		$this->tokenPointer = $pointer;
		parent::__construct($message, $code);
	}

	/**
	* Returns a pointer to the token which caused the exception.
	* @return int
	*/
	public function getPointer()
    {
		return $this->tokenPointer;
	}
}
