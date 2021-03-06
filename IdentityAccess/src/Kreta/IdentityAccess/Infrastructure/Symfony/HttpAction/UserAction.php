<?php

/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kreta\IdentityAccess\Infrastructure\Symfony\HttpAction;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserAction
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function __invoke() : JsonResponse
    {
        $user = $this->tokenStorage->getToken()->getUser();

        return new JsonResponse([
            'user_id'    => $user->id,
            'user_name'  => $user->userName,
            'email'      => $user->email,
            'first_name' => $user->firstName,
            'last_name'  => $user->lastName,
            'full_name'  => $user->fullName,
            'image'      => $user->image,
        ]);
    }
}
