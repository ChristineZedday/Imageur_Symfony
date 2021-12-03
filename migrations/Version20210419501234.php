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
final class Version202104119501234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_javascript (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, article_id INT DEFAULT NULL, javascript_id INT DEFAULT NULL,
        CONSTRAINT FK_B83341767294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE, CONSTRAINT FK_B8334176E754219D FOREIGN KEY (javascript_id) REFERENCES javascript (id) ON DELETE CASCADE, INDEX IDX_352C07EF7252EEEE (article_id), INDEX IDX_352C07EF7252FFFF (javascript_id),PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }  

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_javascript');
       
    }
}
