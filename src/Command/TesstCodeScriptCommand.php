<?php

namespace App\Command;

use App\Users\Domain\User;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

#[AsCommand(
    name: 'app:tesst-code-script',
    description: 'Add a short description for your command',
)]
class TesstCodeScriptCommand extends Command
{
    private $hasher;

    public function __construct(PasswordHasherFactoryInterface $passwordHasher)
    {
        parent::__construct();
        $this->hasher = $passwordHasher->getPasswordHasher(User::class);

    }

    protected function configure(): void
    {
        $this->setDescription('Redirect to Google OAuth');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $falsePassword = "asereje";
        $plainPassword = "Chopinballade";

        $hashedVerify =  $this->hasher->hash($plainPassword);

        $hashedPassword = "$2y$12$93JItbyB1/VCwlHGfOUiDuDyYu2pfhRjej9Bjb/p6gfXEuQhg12lW";

        var_dump( $hashedPassword . " - " . $hashedVerify);

        var_dump("Should be TRUE : " );
        var_dump($this->hasher->verify($hashedVerify, $plainPassword));
        var_dump("Should be FALSE : ");
        var_dump($this->hasher->verify($hashedVerify, $falsePassword));

        return Command::SUCCESS;
    }
}
