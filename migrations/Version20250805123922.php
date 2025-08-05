<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250805123922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aside ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aside ADD CONSTRAINT FK_60B56D49F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_60B56D49F6BD1646 ON aside (site_id)');
        $this->addSql('ALTER TABLE css ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE css ADD CONSTRAINT FK_78CEA6D8F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_78CEA6D8F6BD1646 ON css (site_id)');
        $this->addSql('ALTER TABLE foot ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE foot ADD CONSTRAINT FK_C98F3993F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_C98F3993F6BD1646 ON foot (site_id)');
        $this->addSql('ALTER TABLE javascript ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE javascript ADD CONSTRAINT FK_84EA90F7F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_84EA90F7F6BD1646 ON javascript (site_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aside DROP FOREIGN KEY FK_60B56D49F6BD1646');
        $this->addSql('DROP INDEX IDX_60B56D49F6BD1646 ON aside');
        $this->addSql('ALTER TABLE aside DROP site_id');
        $this->addSql('ALTER TABLE css DROP FOREIGN KEY FK_78CEA6D8F6BD1646');
        $this->addSql('DROP INDEX IDX_78CEA6D8F6BD1646 ON css');
        $this->addSql('ALTER TABLE css DROP site_id');
        $this->addSql('ALTER TABLE foot DROP FOREIGN KEY FK_C98F3993F6BD1646');
        $this->addSql('DROP INDEX IDX_C98F3993F6BD1646 ON foot');
        $this->addSql('ALTER TABLE foot DROP site_id');
        $this->addSql('ALTER TABLE javascript DROP FOREIGN KEY FK_84EA90F7F6BD1646');
        $this->addSql('DROP INDEX IDX_84EA90F7F6BD1646 ON javascript');
        $this->addSql('ALTER TABLE javascript DROP site_id');
    }
}
