<?php

namespace Horat1us\Inn;

/**
 * Class Info
 * @package Horat1us\Inn
 */
class Info
{
    /** @var string */
    protected $gender;

    /** @var bool */
    protected $isValid;

    /** @var \DateTimeInterface */
    protected $birthDate;

    public function __construct(string $gender, \DateTimeInterface $birthDate, bool $isValid)
    {
        $this->setGender($gender);
        $this->isValid = $isValid;
        $this->birthDate = $birthDate;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return clone $this->birthDate;
    }

    protected function setGender(string $gender): void
    {
        $isGenderValid = $gender === Gender::MALE || $gender === Gender::FEMALE;
        if (!$isGenderValid) {
            throw new \InvalidArgumentException("Gender must be " . Gender::MALE . " or " . Gender::FEMALE);
        }
        $this->gender = $gender;
    }
}
