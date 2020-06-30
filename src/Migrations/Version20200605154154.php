<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605154154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipe_malt_rows (id INT AUTO_INCREMENT NOT NULL, malt_id INT NOT NULL, count INT NOT NULL, INDEX IDX_D8CE67F953A9F01 (malt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_hop_rows (id INT AUTO_INCREMENT NOT NULL, hop_id INT NOT NULL, count INT NOT NULL, target_alpha DOUBLE PRECISION NOT NULL, INDEX IDX_F7EC8393BC3870B6 (hop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_malt_rows ADD CONSTRAINT FK_D8CE67F953A9F01 FOREIGN KEY (malt_id) REFERENCES inventory_item (id)');
        $this->addSql('ALTER TABLE recipe_hop_rows ADD CONSTRAINT FK_F7EC8393BC3870B6 FOREIGN KEY (hop_id) REFERENCES inventory_item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recipe_malt_rows');
        $this->addSql('DROP TABLE recipe_hop_rows');
    }
}
