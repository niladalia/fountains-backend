<?php

namespace App\Command;

use App\Users\Application\Find\UserFinderByEmail;
use App\Users\Domain\User;
use App\Users\Domain\ValueObject\UserEmail;
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


    public function __construct(private UserFinderByEmail $finder)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Redirect to Google OAuth');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->finder->__invoke(new UserEmail("niladalia.1@gmail.com"));

        var_dump($user->toArray());

        return Command::SUCCESS;
    }
}
