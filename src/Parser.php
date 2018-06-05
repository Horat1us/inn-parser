<?php

namespace Horat1us\Inn;

/**
 * Class Parser
 * @package Horat1us\Inn
 */
class Parser
{
    protected $inn;

    public function __construct(string $inn)
    {
        if (empty($inn) || !preg_match('/^\d{10}$/', $inn)) {
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

        return $control == (int)$split[9];
    }

    public function birthDate(): \DateTime
    {
        $days = substr($this->inn, 0, 5) - 1;
        $birthDate = new \DateTime('01/01/1900 + ' . $days . ' days');
        return $birthDate;
    }

    public function parse(): Info
    {
        return new Info($this->gender(), $this->birthDate(), $this->isValid());
    }
}
