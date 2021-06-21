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
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;

final class Customer
{
    /** @var CustomerService */
    private $customerService;

    /** @var Authentication */
    private $authenticationService;

    public function __construct(
        Authentication $authenticationService,
        customerService $customerService
    ) {
        $this->authenticationService = $authenticationService;
        $this->customerService       = $customerService;
    }

    /**
     * @Mutation()
     * @Logged()
     *
     * AboutMe desciption can have a maximum of 256 characters.
     */
    public function customerAboutMe(?string $aboutMe = null): CustomerDataType
    {
        return $this->customerService->setAboutMe(
            $this->authenticationService->getUserId(),
            $aboutMe
        );
    }
}
