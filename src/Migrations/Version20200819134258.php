<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819134258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipe_mash_rows (id INT AUTO_INCREMENT NOT NULL, unit_of_measure_temprature_id INT NOT NULL, temperature DOUBLE PRECISION NOT NULL, time_in_minutes INT NOT NULL, INDEX IDX_E80EC8B8F4CD4E4B (unit_of_measure_temprature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_mash_rows ADD CONSTRAINT FK_E80EC8B8F4CD4E4B FOREIGN KEY (unit_of_measure_temprature_id) REFERENCES unit_of_measure (id)');
        $this->addSql('ALTER TABLE inventory_item CHANGE best_before best_before DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unit_of_measure CHANGE factor factor DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE recipe_hop_rows CHANGE time_count time_count INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location CHANGE brewery_id brewery_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recipe_mash_rows');
        $this->addSql('ALTER TABLE inventory_item CHANGE best_before best_before DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE location CHANGE brewery_id brewery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe_hop_rows CHANGE time_count time_count INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unit_of_measure CHANGE factor factor DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
