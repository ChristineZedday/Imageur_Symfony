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
final class Version20210513110439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE css ADD color_titre_acote VARCHAR(10) DEFAULT NULL, ADD color_titre3 VARCHAR(10) DEFAULT NULL, ADD police_texte VARCHAR(255) DEFAULT NULL, ADD police_titre1 VARCHAR(255) DEFAULT NULL, ADD police_titre2 VARCHAR(255) DEFAULT NULL, ADD police_titre3 VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE css DROP color_titre_acote, DROP color_titre3, DROP police_texte, DROP police_titre1, DROP police_titre2, DROP police_titre3');
    }
}
