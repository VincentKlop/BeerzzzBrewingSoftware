<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616122434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_malt_rows ADD recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe_malt_rows ADD CONSTRAINT FK_D8CE67F59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_D8CE67F59D8A214 ON recipe_malt_rows (recipe_id)');
        $this->addSql('ALTER TABLE recipe_hop_rows ADD recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe_hop_rows ADD CONSTRAINT FK_F7EC839359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_F7EC839359D8A214 ON recipe_hop_rows (recipe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_hop_rows DROP FOREIGN KEY FK_F7EC839359D8A214');
        $this->addSql('DROP INDEX IDX_F7EC839359D8A214 ON recipe_hop_rows');
        $this->addSql('ALTER TABLE recipe_hop_rows DROP recipe_id');
        $this->addSql('ALTER TABLE recipe_malt_rows DROP FOREIGN KEY FK_D8CE67F59D8A214');
        $this->addSql('DROP INDEX IDX_D8CE67F59D8A214 ON recipe_malt_rows');
        $this->addSql('ALTER TABLE recipe_malt_rows DROP recipe_id');
    }
}
