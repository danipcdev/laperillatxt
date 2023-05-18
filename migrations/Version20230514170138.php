<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230514170138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tables and its relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                CREATE TABLE `txt` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `title` VARCHAR(100) NOT NULL,
                    `text` VARCHAR(500) NOT NULL,
                    INDEX IDX_txt_title (`title`)
                );
            SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                DROP TABLE `txt`;
            SQL
        );
    }
}
