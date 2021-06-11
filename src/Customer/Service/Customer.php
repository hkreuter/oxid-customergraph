<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Customer\Service;

use Hkreuter\GraphQL\CustomerGraph\Customer\Exception\AboutMeOutOfBounds;
use Hkreuter\GraphQL\CustomerGraph\Customer\Infrastructure\Customer as CustomerInfrastructure;
use OxidEsales\GraphQL\Base\Service\Authentication;
use OxidEsales\GraphQL\Storefront\Customer\DataType\Customer as CustomerDataType;
use OxidEsales\GraphQL\Storefront\Customer\Infrastructure\Repository as CustomerRepository;

final class Customer
{
    /** @var int */
    public const MAX_LENGTH = 256;

    /** @var CustomerRepository */
    private $customerRepository;

    /** @var Authentication */
    private $authenticationService;

    /** @var CustomerInfrastructure */
    private $customerInfrastructure;

    public function __construct(
        CustomerRepository $customerRepository,
        Authentication $authenticationService,
        CustomerInfrastructure $customerInfrastructure
    ) {
        $this->customerRepository     = $customerRepository;
        $this->authenticationService  = $authenticationService;
        $this->customerInfrastructure = $customerInfrastructure;
    }

    public function setAboutMe(CustomerDataType $customer, ?string $content = null): CustomerDataType
    {
        //validate
        if (null === $content) {
            $content = '';
        }

        if (strlen($content) > self::MAX_LENGTH) {
            throw AboutMeOutOfBounds::exceedsMaxLength(self::MAX_LENGTH);
        }

        return $this->customerInfrastructure->updateCustomer($customer, $content);
    }
}
