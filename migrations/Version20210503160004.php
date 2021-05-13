<?php

declare(strict_types=1);

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503160004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD footer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E662412A144 FOREIGN KEY (footer_id) REFERENCES foot (id)');
        $this->addSql('CREATE INDEX IDX_23A0E662412A144 ON article (footer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E662412A144');
        $this->addSql('DROP INDEX IDX_23A0E662412A144 ON article');
        $this->addSql('ALTER TABLE article DROP footer_id');
    }
}
