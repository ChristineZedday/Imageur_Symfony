<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421152438 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page ADD javascript_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE home_page ADD CONSTRAINT FK_352C07EFE754219D FOREIGN KEY (javascript_id) REFERENCES javascript (id)');
        $this->addSql('CREATE INDEX IDX_352C07EFE754219D ON home_page (javascript_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE home_page DROP FOREIGN KEY FK_352C07EFE754219D');
        $this->addSql('DROP INDEX IDX_352C07EFE754219D ON home_page');
        $this->addSql('ALTER TABLE home_page DROP javascript_id');
    }
}
