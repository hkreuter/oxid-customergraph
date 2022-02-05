<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Service;

use Hkreuter\GraphQL\CustomerGraph\Customer\Exception\AboutMeOutOfBounds;
use Hkreuter\GraphQL\CustomerGraph\Customer\Infrastructure\Customer as CustomerInfrastructure;
use OxidEsales\GraphQL\Storefront\Customer\DataType\Customer as CustomerDataType;
use TheCodingMachine\GraphQLite\Types\ID;

final class Customer
{
    /** @var int */
    public const MAX_LENGTH = 256;

    /** @var CustomerInfrastructure */
    private $customerInfrastructure;

    public function __construct(
        CustomerInfrastructure $customerInfrastructure
    ) {
        $this->customerInfrastructure = $customerInfrastructure;
    }

    public function setAboutMe(ID $customerId, ?string $content = null): CustomerDataType
    {
        if (null === $content) {
            $content = '';
        }

        if (strlen($content) > self::MAX_LENGTH) {
            throw AboutMeOutOfBounds::exceedsMaxLength(self::MAX_LENGTH);
        }

        return $this->customerInfrastructure->setAboutMe(
            (string) $customerId,
            $content
        );
    }
}
