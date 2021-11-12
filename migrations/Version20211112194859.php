<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112194859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE slider_rubrique (slider_id INT NOT NULL, rubrique_id INT NOT NULL, INDEX IDX_50BA1D9A2CCC9638 (slider_id), INDEX IDX_50BA1D9A3BD38833 (rubrique_id), PRIMARY KEY(slider_id, rubrique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE slider_rubrique ADD CONSTRAINT FK_50BA1D9A2CCC9638 FOREIGN KEY (slider_id) REFERENCES slider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE slider_rubrique ADD CONSTRAINT FK_50BA1D9A3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE slider_rubrique');
    }
}
