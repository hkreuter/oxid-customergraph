<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Shared\Service;

use OxidEsales\GraphQL\Base\Framework\NamespaceMapperInterface;

final class NamespaceMapper implements NamespaceMapperInterface
{
    public function getControllerNamespaceMapping(): array
    {
        return [
            '\\Hkreuter\\GraphQL\\CustomerGraph\\Customer\\Controller' => __DIR__ . '/../../Customer/Controller/',
        ];
    }

    public function getTypeNamespaceMapping(): array
    {
        return [
            '\\Hkreuter\\GraphQL\\CustomerGraph\\Customer\\Service' => __DIR__ . '/../../Customer/Service/',
        ];
    }
}
