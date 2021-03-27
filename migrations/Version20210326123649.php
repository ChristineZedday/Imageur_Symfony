<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326123649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slider ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE slider ADD CONSTRAINT FK_CFC710077294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_CFC710077294869C ON slider (article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slider DROP FOREIGN KEY FK_CFC710077294869C');
        $this->addSql('DROP INDEX IDX_CFC710077294869C ON slider');
        $this->addSql('ALTER TABLE slider ADD article VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP article_id');
    }
}
