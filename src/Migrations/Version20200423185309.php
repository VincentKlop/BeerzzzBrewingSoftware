<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200423185309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add Unit of Measure and its type';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE unit_of_measure (id INT AUTO_INCREMENT NOT NULL, unit_of_measure_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7EDA7E5429785A43 (unit_of_measure_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit_of_measure_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unit_of_measure ADD CONSTRAINT FK_7EDA7E5429785A43 FOREIGN KEY (unit_of_measure_type_id) REFERENCES unit_of_measure_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE unit_of_measure DROP FOREIGN KEY FK_7EDA7E5429785A43');
        $this->addSql('DROP TABLE unit_of_measure');
        $this->addSql('DROP TABLE unit_of_measure_type');
    }
}
