<?php

/**
 * This is an example of an Anemic Model.
 * A model that only contains data and no business logic. Doesn't contain any behavior.
 */
final class PersonAnemicModel
{
    private function __construct(private string $name, private int $age) {
    }

    // Named constructor
    public static function create(string $name, int $age): PersonAnemicModel
    {
        return new self($name, $age);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * Validation method [Just for a basic validation, generally typo validation]
     * @throws Exception
     */
    public function validate(): void {
        if (empty($this->name)) {
            throw new Exception('The name is required');
        }
    }

    // Format method [Just basic format]
    public function formatName(): string
    {
        return ucfirst($this->name);
    }

    public function toArray(): array
    {
        return ['name' => $this->name, 'age' => $this->age];
    }

    // Compare method [compare if two objects are equals]
    public function isEquals(PersonAnemicModel $anotherPerson): bool
    {
        return $this->name === $anotherPerson->getName() && $this->age === $anotherPerson->getAge();
    }
}
