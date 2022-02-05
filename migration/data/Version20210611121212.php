<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210611121212 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        $customerTable = $schema->getTable('oxuser');

        if (!$customerTable->hasColumn('ABOUTME')) {
            $this->addSql("ALTER TABLE `oxuser` ADD COLUMN `ABOUTME`
                 varchar(254) NOT NULL DEFAULT '' COMMENT 'about me';
            ");
        }
    }

    public function down(Schema $schema): void
    {
    }
}
