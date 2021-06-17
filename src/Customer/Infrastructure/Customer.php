<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Infrastructure;

use Hkreuter\GraphQL\CustomerGraph\Customer\Exception\NotFound;
use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use OxidEsales\GraphQL\Storefront\Customer\DataType\Customer as CustomerDataType;

final class Customer
{
    public function setAboutMe(string $customerId, string $data): CustomerDataType
    {
        /** @var EshopModelUser */
        $customer = oxNew(EshopModelUser::class);

        if (!$customer->load($customerId)) {
            throw NotFound::notFoundById($customerId);
        }

        $customer->assign([
            'ABOUTME' => $data,
        ]);
        $customer->save();

        return new CustomerDataType($customer);
    }
}
