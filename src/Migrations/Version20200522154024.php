<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522154024 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_brewery (user_id INT NOT NULL, brewery_id INT NOT NULL, INDEX IDX_42548B4DA76ED395 (user_id), INDEX IDX_42548B4DD15C960 (brewery_id), PRIMARY KEY(user_id, brewery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_brewery ADD CONSTRAINT FK_42548B4DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_brewery ADD CONSTRAINT FK_42548B4DD15C960 FOREIGN KEY (brewery_id) REFERENCES brewery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_item CHANGE best_before best_before DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE location CHANGE brewery_id brewery_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_brewery');
        $this->addSql('ALTER TABLE inventory_item CHANGE best_before best_before DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE location CHANGE brewery_id brewery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
