<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250805121239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE home_page ADD CONSTRAINT FK_352C07EFF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_352C07EFF6BD1646 ON home_page (site_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page DROP FOREIGN KEY FK_352C07EFF6BD1646');
        $this->addSql('DROP INDEX IDX_352C07EFF6BD1646 ON home_page');
        $this->addSql('ALTER TABLE home_page DROP site_id');
    }
}
