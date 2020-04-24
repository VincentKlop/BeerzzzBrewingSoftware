<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200424120617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       // $this->addSql('DROP TABLE ingredient_type_field_unit_of_measure');
       // $this->addSql('ALTER TABLE ingredient_type_field ADD unit_of_measure_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredient_type_field ADD CONSTRAINT FK_9B925498DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id)');
        $this->addSql('CREATE INDEX IDX_9B925498DA4E2C90 ON ingredient_type_field (unit_of_measure_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ingredient_type_field_unit_of_measure (ingredient_type_field_id INT NOT NULL, unit_of_measure_id INT NOT NULL, INDEX IDX_39267F81DA4E2C90 (unit_of_measure_id), INDEX IDX_39267F81559746DB (ingredient_type_field_id), PRIMARY KEY(ingredient_type_field_id, unit_of_measure_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ingredient_type_field_unit_of_measure ADD CONSTRAINT FK_39267F81559746DB FOREIGN KEY (ingredient_type_field_id) REFERENCES ingredient_type_field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_type_field_unit_of_measure ADD CONSTRAINT FK_39267F81DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_type_field DROP FOREIGN KEY FK_9B925498DA4E2C90');
        $this->addSql('DROP INDEX IDX_9B925498DA4E2C90 ON ingredient_type_field');
        $this->addSql('ALTER TABLE ingredient_type_field DROP unit_of_measure_id');
    }
}
