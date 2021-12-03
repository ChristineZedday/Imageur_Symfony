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
final class Version20210419202435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        $this->addSql('ALTER TABLE section ADD home_page_id INT DEFAULT NULL, CHANGE article_id article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFB966A8BC FOREIGN KEY (home_page_id) REFERENCES home_page (id)');
        $this->addSql('CREATE INDEX IDX_2D737AEFB966A8BC ON section (home_page_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
       
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFB966A8BC');
        $this->addSql('DROP INDEX IDX_2D737AEFB966A8BC ON section');
        $this->addSql('ALTER TABLE section DROP home_page_id, CHANGE article_id article_id INT NOT NULL');
    }
}
