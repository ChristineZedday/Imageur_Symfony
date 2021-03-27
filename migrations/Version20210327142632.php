<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210327142632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD section_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66D823E37A ON article (section_id)');
        $this->addSql('ALTER TABLE slider ADD CONSTRAINT FK_CFC710077294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_CFC710077294869C ON slider (article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66D823E37A');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP INDEX IDX_23A0E66D823E37A ON article');
        $this->addSql('ALTER TABLE article DROP section_id');
        $this->addSql('ALTER TABLE slider DROP FOREIGN KEY FK_CFC710077294869C');
        $this->addSql('DROP INDEX IDX_CFC710077294869C ON slider');
    }
}
