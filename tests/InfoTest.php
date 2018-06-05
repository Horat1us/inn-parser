<?php

namespace Horat1us\Inn\Tests;

use PHPUnit\Framework\TestCase;
use Horat1us\Inn;

/**
 * Class InfoTest
 * @package Horat1us\Inn\Tests
 */
class InfoTest extends TestCase
{
    protected const BIRTH_DATE = '01/01/1900 + 10 days';
    protected const IS_VALID = true;
    protected const GENDER = Inn\Gender::MALE;

    /** @var Inn\Info */
    protected $info;

    protected function setUp(): void
    {
        parent::setUp();
        $this->info = new Inn\Info(
            static::GENDER,
            new \DateTime(static::BIRTH_DATE),
            static::IS_VALID
        );
    }

    public function testValid(): void
    {
        $this->assertTrue($this->info->isValid());
    }

    public function testGender(): void
    {
        $this->assertEquals(static::GENDER, $this->info->getGender());
    }

    public function testBirthDate(): void
    {
        $bd = $this->info->getBirthDate();
        $this->assertEquals(new \DateTime(static::BIRTH_DATE), $bd);

        // check immutable
        if ($bd instanceof \DateTime) {
            $bd->add(new \DateInterval('P1D'));
            $this->assertEquals(new \DateTime(static::BIRTH_DATE), $this->info->getBirthDate());
        }
    }
}
