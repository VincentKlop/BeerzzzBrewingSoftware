<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629151954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_hop_rows ADD unit_of_measure_time_id INT NOT NULL, ADD time_count INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe_hop_rows ADD CONSTRAINT FK_F7EC8393B2DE0BEB FOREIGN KEY (unit_of_measure_time_id) REFERENCES unit_of_measure (id)');
        $this->addSql('CREATE INDEX IDX_F7EC8393B2DE0BEB ON recipe_hop_rows (unit_of_measure_time_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_hop_rows DROP FOREIGN KEY FK_F7EC8393B2DE0BEB');
        $this->addSql('DROP INDEX IDX_F7EC8393B2DE0BEB ON recipe_hop_rows');
        $this->addSql('ALTER TABLE recipe_hop_rows DROP unit_of_measure_time_id, DROP time_count');
    }
}
