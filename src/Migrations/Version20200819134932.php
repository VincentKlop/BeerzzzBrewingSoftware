<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819134932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add recipe ID to mash rows';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_mash_rows ADD recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe_mash_rows ADD CONSTRAINT FK_E80EC8B859D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_E80EC8B859D8A214 ON recipe_mash_rows (recipe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_mash_rows DROP FOREIGN KEY FK_E80EC8B859D8A214');
        $this->addSql('DROP INDEX IDX_E80EC8B859D8A214 ON recipe_mash_rows');
        $this->addSql('ALTER TABLE recipe_mash_rows DROP recipe_id');
    }
}
