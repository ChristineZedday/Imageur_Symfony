<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505120210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE css ADD couleur_text VARCHAR(10) DEFAULT NULL, ADD couleur_fond VARCHAR(10) DEFAULT NULL, ADD couleur_acote VARCHAR(10) DEFAULT NULL, ADD couleur_titre1 VARCHAR(10) DEFAULT NULL, ADD couleur_titre2 VARCHAR(10) DEFAULT NULL, ADD couleur_liens VARCHAR(10) DEFAULT NULL, ADD couleur_liens_visites VARCHAR(10) DEFAULT NULL, ADD couleur_fond_sommaire VARCHAR(10) DEFAULT NULL, ADD couleur_texte_sommaire VARCHAR(10) DEFAULT NULL, ADD couleur_liens_sommaire VARCHAR(10) DEFAULT NULL, ADD couleur_liens_visites_sommaire VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE css DROP couleur_text, DROP couleur_fond, DROP couleur_acote, DROP couleur_titre1, DROP couleur_titre2, DROP couleur_liens, DROP couleur_liens_visites, DROP couleur_fond_sommaire, DROP couleur_texte_sommaire, DROP couleur_liens_sommaire, DROP couleur_liens_visites_sommaire');
    }
}
