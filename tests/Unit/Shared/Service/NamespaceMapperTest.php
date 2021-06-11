<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Tests\Unit\Shared\Service;

use Hkreuter\GraphQL\CustomerGraph\Shared\Service\NamespaceMapper;
use PHPUnit\Framework\TestCase;

/**
 * @covers Hkreuter\GraphQL\CustomerGraph\Shared\Service\NamespaceMapper
 */
final class NamespaceMapperTest extends TestCase
{
    public function testFooBar(): void
    {
        $namespaceMapper = new NamespaceMapper();
        $this->assertCount(
            1,
            $namespaceMapper->getControllerNamespaceMapping()
        );
        $this->assertCount(
            1,
            $namespaceMapper->getTypeNamespaceMapping()
        );
    }
}
