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
final class Version20210501173209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE home_page_css (home_page_id INT NOT NULL, css_id INT NOT NULL, INDEX IDX_D1745744B966A8BC (home_page_id), INDEX IDX_D1745744615A5518 (css_id), PRIMARY KEY(home_page_id, css_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE home_page_css ADD CONSTRAINT FK_D1745744B966A8BC FOREIGN KEY (home_page_id) REFERENCES home_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE home_page_css ADD CONSTRAINT FK_D1745744615A5518 FOREIGN KEY (css_id) REFERENCES css (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE home_page_css');
    }
}
