<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428160406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inventory_item_field_value (id INT AUTO_INCREMENT NOT NULL, inventory_item_id INT NOT NULL, ingredient_type_field_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_FA13B5A6536BF4A2 (inventory_item_id), INDEX IDX_FA13B5A6559746DB (ingredient_type_field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventory_item_field_value ADD CONSTRAINT FK_FA13B5A6536BF4A2 FOREIGN KEY (inventory_item_id) REFERENCES inventory_item (id)');
        $this->addSql('ALTER TABLE inventory_item_field_value ADD CONSTRAINT FK_FA13B5A6559746DB FOREIGN KEY (ingredient_type_field_id) REFERENCES ingredient_type_field (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE inventory_item_field_value');
    }
}
