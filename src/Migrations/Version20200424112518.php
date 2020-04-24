<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200424112518 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ingredient_type (id INT AUTO_INCREMENT NOT NULL, unit_of_measurement_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D28FE7BFB9979A2F (unit_of_measurement_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_type_field (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_type_field_ingredient_type (ingredient_type_field_id INT NOT NULL, ingredient_type_id INT NOT NULL, INDEX IDX_9573E66A559746DB (ingredient_type_field_id), INDEX IDX_9573E66AC47B8755 (ingredient_type_id), PRIMARY KEY(ingredient_type_field_id, ingredient_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_type_field_unit_of_measure (ingredient_type_field_id INT NOT NULL, unit_of_measure_id INT NOT NULL, INDEX IDX_39267F81559746DB (ingredient_type_field_id), INDEX IDX_39267F81DA4E2C90 (unit_of_measure_id), PRIMARY KEY(ingredient_type_field_id, unit_of_measure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_type ADD CONSTRAINT FK_D28FE7BFB9979A2F FOREIGN KEY (unit_of_measurement_type_id) REFERENCES unit_of_measure_type (id)');
        $this->addSql('ALTER TABLE ingredient_type_field_ingredient_type ADD CONSTRAINT FK_9573E66A559746DB FOREIGN KEY (ingredient_type_field_id) REFERENCES ingredient_type_field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_type_field_ingredient_type ADD CONSTRAINT FK_9573E66AC47B8755 FOREIGN KEY (ingredient_type_id) REFERENCES ingredient_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_type_field_unit_of_measure ADD CONSTRAINT FK_39267F81559746DB FOREIGN KEY (ingredient_type_field_id) REFERENCES ingredient_type_field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_type_field_unit_of_measure ADD CONSTRAINT FK_39267F81DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredient_type_field_ingredient_type DROP FOREIGN KEY FK_9573E66AC47B8755');
        $this->addSql('ALTER TABLE ingredient_type_field_ingredient_type DROP FOREIGN KEY FK_9573E66A559746DB');
        $this->addSql('ALTER TABLE ingredient_type_field_unit_of_measure DROP FOREIGN KEY FK_39267F81559746DB');
        $this->addSql('DROP TABLE ingredient_type');
        $this->addSql('DROP TABLE ingredient_type_field');
        $this->addSql('DROP TABLE ingredient_type_field_ingredient_type');
        $this->addSql('DROP TABLE ingredient_type_field_unit_of_measure');
    }
}
