<?php

namespace App\Users\Application\Register;

use App\Users\Application\Create\DTO\CreateUserRequest;
use App\Users\Application\Create\UserCreator;
use App\Users\Application\Register\DTO\RegisterUserRequest;

class UserRegistration
{
    public function __construct(
        private UserCreator $userCreator,
    ) {}

    public function __invoke(RegisterUserRequest $registrationRequest): void
    {
        // Send Email , do Some Verifications ...
        $this->userCreator->__invoke(
            new CreateUserRequest(
                $registrationRequest->email(),
                $registrationRequest->password(),
                $registrationRequest->name(),
            ),
        );
    }
}
