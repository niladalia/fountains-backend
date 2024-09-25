<?php
// src/Command/GoogleAuthCommand.php

namespace App\Command;

use Google_Client;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand(
    name: 'test-google-code',
    description: 'php bin/console test-google-codeZ',
)]
class GoogleAuthCommand extends Command
{
    // Ensure the command name is not empty
    protected static $defaultName = 'test-google-code';

    protected function configure()
    {
        $this->setDescription('Redirect to Google OAuth');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $clientId = "145496455551-eeks788t5j0nrjplj5b74h81u5k23deh.apps.googleusercontent.com";
        $clientSecret = "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";
        $redirectUri = "http://localhost:8000/api/auth/google";

        // Initialize Google Client
        $client = new Google_Client();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope('email');
        $client->addScope('profile');

        // Generate the authorization URL
        $authUrl = $client->createAuthUrl();
        $output->writeln("Open the following URL in your browser:");
        $output->writeln($authUrl);

        return Command::SUCCESS; // Return success
    }
}
