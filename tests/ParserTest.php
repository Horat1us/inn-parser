<?php

namespace Horat1us\Inn\Tests;

use PHPUnit\Framework\TestCase;
use Horat1us\Inn;

/**
 * Class ParserTest
 * @package Horat1us\Inn\Tests
 * @coversDefaultClass \Horat1us\Inn\Parser
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

    public function testParse(): void
    {
        $info = $this->parser->parse();

        $this->assertTrue($info->isValid());
        $this->assertEquals(Inn\Gender::MALE, $info->getGender());
        $this->assertEquals(new \DateTime('03/12/1987'), $info->getBirthDate());
    }

    public function testInvalidInn(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Inn must contain 10 digits');
        new Inn\Parser("invalidInn");
    }

    public function testValidCheckSum(): void
    {
        $parser = new Inn\Parser("3584004820");

        $this->assertEquals(true, $parser->isValid());
    }

    public function testMaximalValue(): void
    {
        $minValue = Inn\Parser::minimalValue();
        $this->assertMatchesRegularExpression('/0{5,}$/', (string)$minValue);
        $maxValue = Inn\Parser::maximalValue();
        $this->assertMatchesRegularExpression('/9{5,}$/', (string)$maxValue);
        $this->assertLessThan($maxValue, $minValue);
    }
}
