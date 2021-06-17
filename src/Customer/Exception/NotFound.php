<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Exception;

use OxidEsales\GraphQL\Base\Exception\NotFound as BaseNotFound;
use function sprintf;

final class NotFound extends BaseNotFound
{
    public static function notFoundById(string $id): self
    {
        return new self(sprintf('Customer with id "%s", could not be found', $id));
    }
}
