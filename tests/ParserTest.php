<?php

namespace Horat1us\Inn\Tests;

use PHPUnit\Framework\TestCase;
use Horat1us\Inn;

/**
 * Class ParserTest
 * @package Horat1us\Inn\Tests
 */
class ParserTest extends TestCase
{
    /** @var Inn\Parser */
    protected $parser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = new Inn\Parser(3184710691);
    }

    public function testGender(): void
    {
        $this->assertEquals(Inn\Gender::MALE, $this->parser->gender());
    }

    public function testValid(): void
    {
        $this->assertTrue($this->parser->isValid());
    }

    public function testBirthDate(): void
    {
        $this->assertEquals(new \DateTime('03/12/1987'), $this->parser->birthDate());
    }
}
