<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Exception;

use OxidEsales\GraphQL\Base\Exception\OutOfBounds;
use function sprintf;

final class AboutMeOutOfBounds extends OutOfBounds
{
    public static function exceedsMaxLength(int $max): self
    {
        return new self(sprintf('Input exceeds allowed length of max %s characters', (string) $max));
    }
}
