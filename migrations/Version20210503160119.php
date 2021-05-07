<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503160119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page ADD footer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE home_page ADD CONSTRAINT FK_352C07EF2412A144 FOREIGN KEY (footer_id) REFERENCES foot (id)');
        $this->addSql('CREATE INDEX IDX_352C07EF2412A144 ON home_page (footer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page DROP FOREIGN KEY FK_352C07EF2412A144');
        $this->addSql('DROP INDEX IDX_352C07EF2412A144 ON home_page');
        $this->addSql('ALTER TABLE home_page DROP footer_id');
    }
}
