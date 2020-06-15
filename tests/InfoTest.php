<?php

declare(strict_types=1);

namespace Horat1us\Inn\Tests;

use PHPUnit\Framework\TestCase;
use Horat1us\Inn;

/**
 * @coversDefaultClass \Horat1us\Inn\Info
 */
class InfoTest extends TestCase
{
    public function innDataProvider(): array
    {
        return [
            [Inn\Gender::MALE, new \DateTimeImmutable('01/01/1900 + 10 days'), true,],
            [Inn\Gender::FEMALE, new \DateTimeImmutable('01/01/2000 + 10 days'), false,],
            [
                'invalid', new \DateTimeImmutable('01/01/2000 + 10 days'), true,
                new \InvalidArgumentException('Gender must be male or female')
            ],
        ];
    }

    /**
     * @dataProvider innDataProvider
     */
    public function testConstructor(string $g, \DateTimeInterface $bd, bool $valid, \Exception $e = null): void
    {
        if (!is_null($e)) {
            $this->expectExceptionObject($e);
        }
        $inn = new Inn\Info($g, $bd, $valid);
        $this->assertEquals($g, $inn->getGender());
        $this->assertEquals($bd, $inn->getBirthDate());
        $this->assertEquals($valid, $inn->isValid());
    }
}
