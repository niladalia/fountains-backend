<?php

namespace App\Tests\Users\Infrastructure\Hasher;

use App\Fountains\Application\Create\FountainCreator;
use App\Tests\Fountains\Application\Create\DTO\CreateFountainRequestMother;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\FountainsUnitTestCase;
use App\Tests\Shared\Domain\UuidMother;
use App\Users\Domain\PasswordHasherRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PasswordHasherRepositoryTest extends KernelTestCase
{
    private $hasher;

    public function setUp(): void
    {
        parent::setUp();
        $this->hasher = self::getContainer()->get(PasswordHasherRepository::class);
        restore_exception_handler();
    }

    public function test_it_should_hash_a_password(): void
    {
        $password = "Chopinballade";

        $hashedPass = $this->hasher->hash($password);

        $this->assertEquals(strlen($hashedPass), 60);
    }

    public function test_it_should_verify_a_correct_hash_password(): void
    {
        $plainPass =  "SuiteBach";
        $hashedPass = $this->hasher->hash($plainPass);

        $isCorrect = $this->hasher->verifyPassword($hashedPass, $plainPass);

        $this->assertTrue($isCorrect);
    }

    public function test_it_should_not_verify_an_incorrect_hash_password(): void
    {
        $plainPass =  "4SeasonsVivaldi";
        $hashedPass = $this->hasher->hash($plainPass);

        $wrongPlainPas = "Bach4ever";
        $isCorrect = $this->hasher->verifyPassword($hashedPass, $wrongPlainPas);

        $this->assertFalse($isCorrect);
    }

}