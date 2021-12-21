<?php

declare(strict_types=1);

namespace Horat1us\Inn;

class Parser
{
    public const PATTERN = '/^\d{10}$/';
    public const START_DATE = '1900-01-01';

    protected string $inn;

    public function __construct(string $inn)
    {
        if (empty($inn) || !preg_match(static::PATTERN, $inn)) {
            throw new \InvalidArgumentException("Inn must contain 10 digits");
        }

        $this->inn = $inn;
    }

    public function gender(): string
    {
        return (substr($this->inn, 8, 1) % 2) ? Gender::MALE : Gender::FEMALE;
    }

    public function isValid(): bool
    {
        $split = str_split($this->inn);

        $multipliers = [
            -1,
            5,
            7,
            9,
            4,
            6,
            10,
            5,
            7
        ];

        for ($i = 0, $controlSum = 0; $i < count($multipliers); $i++) {
            $controlSum += $split[$i] * $multipliers[$i];
        }

        $control = (int)($controlSum - (11 * (int)($controlSum / 11)));
        if ($control === 10) {
            $control = 0;
        }

        return $control == (int)$split[9];
    }

    public function birthDate(): \DateTime
    {
        $days = substr($this->inn, 0, 5) - 1;
        $birthDate = new \DateTime(static::START_DATE . ' + ' . $days . ' days');
        return $birthDate;
    }

    public function parse(): Info
    {
        return new Info($this->gender(), $this->birthDate(), $this->isValid());
    }

    public static function maximalValue(int $age = 18, $padStr = '9'): int
    {
        return (int)str_pad(
            date_create("- {$age} years")->diff(date_create(static::START_DATE))->format('%a'),
            10,
            $padStr
        );
    }

    public static function minimalValue(int $age = 70): int
    {
        return static::maximalValue($age, '0');
    }
}
