<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Infrastructure;

use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use OxidEsales\GraphQL\Storefront\Customer\DataType\Customer as CustomerDataType;

final class Customer
{
    public function updateCustomer(CustomerDataType $customer, string $data): CustomerDataType
    {
        /** @var EshopModelUser $customerModel */
        $customerModel = $customer->getEshopModel();

        $customerModel->assign(
            [
                'ABOUTME' => $data,
            ]
        );
        $customerModel->save();

        return $customer;
    }
}
