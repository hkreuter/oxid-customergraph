<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Service;

use OxidEsales\GraphQL\Storefront\Customer\DataType\Customer as CustomerDataType;
use TheCodingMachine\GraphQLite\Annotations\ExtendType;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @ExtendType(class=CustomerDataType::class)
 */
final class CustomerExtend
{
    /**
     * @Field()
     */
    public function aboutMe(CustomerDataType $customer): string
    {
        return (string) $customer->getEshopModel()->getFieldData('aboutme');
    }
}
