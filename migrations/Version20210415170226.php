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
final class Version20210415170226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page ADD description VARCHAR(255) DEFAULT NULL, ADD keywords VARCHAR(255) DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, auteur VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page DROP description, DROP keywords');
    }
}
