<?php

declare(strict_types=1);

namespace Horat1us\Inn;

class Info
{
    protected bool $gender;

    /** @var bool */
    protected bool $isValid;

    protected \DateTimeInterface $birthDate;

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
        return $this->gender ? Gender::MALE : Gender::FEMALE;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return clone $this->birthDate;
    }

    protected function setGender(string $gender): void
    {
        switch ($gender) {
            case Gender::MALE:
                $this->gender = true;
                break;
            case Gender::FEMALE:
                $this->gender = false;
                break;
            default:
                throw new \InvalidArgumentException("Gender must be " . Gender::MALE . " or " . Gender::FEMALE);
        }
    }
}
