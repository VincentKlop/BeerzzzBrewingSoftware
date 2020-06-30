<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615144152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_item CHANGE best_before best_before DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE location CHANGE brewery_id brewery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD style_id INT NOT NULL, CHANGE malts_id malts_id INT DEFAULT NULL, CHANGE hops_id hops_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137BACD6074 FOREIGN KEY (style_id) REFERENCES beer_style (id)');
        $this->addSql('CREATE INDEX IDX_DA88B137BACD6074 ON recipe (style_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_item CHANGE best_before best_before DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE location CHANGE brewery_id brewery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137BACD6074');
        $this->addSql('DROP INDEX IDX_DA88B137BACD6074 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP style_id, CHANGE malts_id malts_id INT DEFAULT NULL, CHANGE hops_id hops_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
