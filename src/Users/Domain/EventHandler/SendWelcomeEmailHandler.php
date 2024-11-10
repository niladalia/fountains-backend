<?php

namespace App\Users\Domain\EventHandler;

use App\Users\Domain\Events\UserCreatedDomainEvent;

class SendWelcomeEmailHandler
{
    public function __invoke(UserCreatedDomainEvent $event): void
    {
        $email = $event->email();
        echo "Sending welcome email to " . $email . " !!";
    }
}
