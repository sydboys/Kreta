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

namespace Kreta\TaskManager\Domain\Model\Organization;

use Kreta\SharedKernel\Domain\Model\Collection;
use Kreta\SharedKernel\Domain\Model\CollectionElementAlreadyRemovedException;
use Kreta\TaskManager\Domain\Model\User\UserId;

abstract class MemberCollection extends Collection
{
    public function contains($element) : bool
    {
        return $this->containsUserId($element->userId());
    }

    public function containsUserId(UserId $userId) : bool
    {
        $members = $this->toArray();
        foreach ($members as $member) {
            if ($userId->equals($member->userId())) {
                return true;
            }
        }

        return false;
    }

    public function removeByUserId(UserId $userId) : void
    {
        $members = $this->toArray();
        foreach ($members as $member) {
            if ($userId->equals($member->userId())) {
                $this->removeMember($member);

                return;
            }
        }
        throw new CollectionElementAlreadyRemovedException();
    }

    private function removeMember(Member $member) : void
    {
        $this->remove($member);

        // This line it's a hack for Doctrine ORM
        // to enforce the bidirectional relationship
        // between member and organization.
        $memberReflection = new \ReflectionClass($member);
        $property = $memberReflection->getProperty('organization');
        $property->setAccessible(true);
        $property->setValue($member, null);
    }
}
