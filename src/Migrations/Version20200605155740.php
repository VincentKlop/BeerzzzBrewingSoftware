<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605155740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe ADD malts_id INT DEFAULT NULL, ADD hops_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13790E3B72C FOREIGN KEY (malts_id) REFERENCES recipe_malt_rows (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137C5CF93EC FOREIGN KEY (hops_id) REFERENCES recipe_hop_rows (id)');
        $this->addSql('CREATE INDEX IDX_DA88B13790E3B72C ON recipe (malts_id)');
        $this->addSql('CREATE INDEX IDX_DA88B137C5CF93EC ON recipe (hops_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13790E3B72C');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137C5CF93EC');
        $this->addSql('DROP INDEX IDX_DA88B13790E3B72C ON recipe');
        $this->addSql('DROP INDEX IDX_DA88B137C5CF93EC ON recipe');
        $this->addSql('ALTER TABLE recipe DROP malts_id, DROP hops_id');
    }
}
