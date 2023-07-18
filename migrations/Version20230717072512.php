<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717072512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE txt CHANGE type_id type_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE txt ADD CONSTRAINT FK_1C375F45C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_1C375F45C54C8C93 ON txt (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE txt DROP FOREIGN KEY FK_1C375F45C54C8C93');
        $this->addSql('DROP INDEX IDX_1C375F45C54C8C93 ON txt');
        $this->addSql('ALTER TABLE txt CHANGE type_id type_id VARCHAR(36) NOT NULL');
    }
}
