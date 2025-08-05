<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250805113315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rubrique DROP FOREIGN KEY FK_8FA4097CBB1E4E52');
        $this->addSql('DROP INDEX IDX_8FA4097CBB1E4E52 ON rubrique');
        $this->addSql('ALTER TABLE rubrique DROP site_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rubrique ADD site_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rubrique ADD CONSTRAINT FK_8FA4097CBB1E4E52 FOREIGN KEY (site_id_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_8FA4097CBB1E4E52 ON rubrique (site_id_id)');
    }
}
