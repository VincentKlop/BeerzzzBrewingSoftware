<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522165246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_item ADD location_id INT NOT NULL, CHANGE best_before best_before DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory_item ADD CONSTRAINT FK_55BDEA3064D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_55BDEA3064D218E ON inventory_item (location_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_item DROP FOREIGN KEY FK_55BDEA3064D218E');
        $this->addSql('DROP INDEX IDX_55BDEA3064D218E ON inventory_item');
        $this->addSql('ALTER TABLE inventory_item DROP location_id, CHANGE best_before best_before DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE location CHANGE brewery_id brewery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
