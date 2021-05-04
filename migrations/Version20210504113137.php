<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504113137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE home_page_javascript (home_page_id INT NOT NULL, javascript_id INT NOT NULL, INDEX IDX_18580039B966A8BC (home_page_id), INDEX IDX_18580039E754219D (javascript_id), PRIMARY KEY(home_page_id, javascript_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE home_page_javascript ADD CONSTRAINT FK_18580039B966A8BC FOREIGN KEY (home_page_id) REFERENCES home_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE home_page_javascript ADD CONSTRAINT FK_18580039E754219D FOREIGN KEY (javascript_id) REFERENCES javascript (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE image_slider');
        $this->addSql('ALTER TABLE home_page DROP FOREIGN KEY FK_352C07EFE754219D');
        $this->addSql('DROP INDEX IDX_352C07EFE754219D ON home_page');
        $this->addSql('ALTER TABLE home_page DROP javascript_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_slider (image_id INT NOT NULL, slider_id INT NOT NULL, INDEX IDX_60DA4ECF3DA5256D (image_id), INDEX IDX_60DA4ECF2CCC9638 (slider_id), PRIMARY KEY(image_id, slider_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image_slider ADD CONSTRAINT FK_60DA4ECF2CCC9638 FOREIGN KEY (slider_id) REFERENCES slider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_slider ADD CONSTRAINT FK_60DA4ECF3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE home_page_javascript');
        $this->addSql('ALTER TABLE home_page ADD javascript_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE home_page ADD CONSTRAINT FK_352C07EFE754219D FOREIGN KEY (javascript_id) REFERENCES javascript (id)');
        $this->addSql('CREATE INDEX IDX_352C07EFE754219D ON home_page (javascript_id)');
    }
}
