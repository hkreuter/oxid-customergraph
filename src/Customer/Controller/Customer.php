<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Controller;

use Hkreuter\GraphQL\CustomerGraph\Customer\Service\Customer as CustomerService;
use OxidEsales\GraphQL\Base\Service\Authentication;
use OxidEsales\GraphQL\Storefront\Customer\DataType\Customer as CustomerDataType;
use OxidEsales\GraphQL\Storefront\Customer\Service\Customer as StorefrontCustomerService;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;

final class Customer
{
    /** @var CustomerService */
    private $customerService;

    /** @var StorefrontCustomerService */
    private $storefrontCustomerService;

    /** @var Authentication */
    private $authenticationService;

    public function __construct(
        Authentication $authenticationService,
        CustomerService $customerService,
        StorefrontCustomerService $storefrontCustomerService
    ) {
        $this->authenticationService     = $authenticationService;
        $this->customerService           = $customerService;
        $this->storefrontCustomerService = $storefrontCustomerService;
    }

    /**
     * @Mutation()
     * @Logged()
     *
     * AboutMe desciption can have a maximum of 256 characters.
     */
    public function CustomerAboutMe(?string $aboutMe = null): CustomerDataType
    {
        $customer = $this->storefrontCustomerService->customer(
            $this->authenticationService->getUserId()
        );

        return $this->customerService->setAboutMe($customer, $aboutMe);
    }
}
