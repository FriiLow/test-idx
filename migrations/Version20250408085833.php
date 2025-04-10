<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408085833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stapling_config ADD container_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stapling_config ADD CONSTRAINT FK_4D78C213BC21F742 FOREIGN KEY (container_id) REFERENCES stapling_config_container (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4D78C213BC21F742 ON stapling_config (container_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stapling_config DROP FOREIGN KEY FK_4D78C213BC21F742');
        $this->addSql('DROP INDEX UNIQ_4D78C213BC21F742 ON stapling_config');
        $this->addSql('ALTER TABLE stapling_config DROP container_id');
    }
}
