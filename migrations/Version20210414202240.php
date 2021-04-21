<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414202240 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE home_page (id INT AUTO_INCREMENT NOT NULL, aside_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, titre VARCHAR(255) DEFAULT NULL, INDEX IDX_352C07EF725221F6 (aside_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE home_page ADD CONSTRAINT FK_352C07EF725221F6 FOREIGN KEY (aside_id) REFERENCES aside (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE home_page');
    }
}
