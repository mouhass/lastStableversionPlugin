<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220525092051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Admin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Historique (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, state VARCHAR(255) NOT NULL, jobCronHist_id INT DEFAULT NULL, INDEX IDX_A2E2D63C226D344 (jobCronHist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, expression VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, emailadmin VARCHAR(255) DEFAULT NULL, scriptExec VARCHAR(255) DEFAULT NULL, emailadmincron VARCHAR(255) DEFAULT NULL, relationHistJobComp_id INT DEFAULT NULL, INDEX IDX_C395A6186A8574FA (relationHistJobComp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jobcomposite_jobcron (jobcomposite_id INT NOT NULL, jobcron_id INT NOT NULL, INDEX IDX_49C2A74E6C4484E4 (jobcomposite_id), INDEX IDX_49C2A74E91749340 (jobcron_id), PRIMARY KEY(jobcomposite_id, jobcron_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Historique ADD CONSTRAINT FK_A2E2D63C226D344 FOREIGN KEY (jobCronHist_id) REFERENCES Job (id)');
        $this->addSql('ALTER TABLE Job ADD CONSTRAINT FK_C395A6186A8574FA FOREIGN KEY (relationHistJobComp_id) REFERENCES Job (id)');
        $this->addSql('ALTER TABLE jobcomposite_jobcron ADD CONSTRAINT FK_49C2A74E6C4484E4 FOREIGN KEY (jobcomposite_id) REFERENCES Job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jobcomposite_jobcron ADD CONSTRAINT FK_49C2A74E91749340 FOREIGN KEY (jobcron_id) REFERENCES Job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sylius_gateway_config CHANGE config config JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Historique DROP FOREIGN KEY FK_A2E2D63C226D344');
        $this->addSql('ALTER TABLE Job DROP FOREIGN KEY FK_C395A6186A8574FA');
        $this->addSql('ALTER TABLE jobcomposite_jobcron DROP FOREIGN KEY FK_49C2A74E6C4484E4');
        $this->addSql('ALTER TABLE jobcomposite_jobcron DROP FOREIGN KEY FK_49C2A74E91749340');
        $this->addSql('DROP TABLE Admin');
        $this->addSql('DROP TABLE Historique');
        $this->addSql('DROP TABLE Job');
        $this->addSql('DROP TABLE jobcomposite_jobcron');
        $this->addSql('ALTER TABLE sylius_gateway_config CHANGE config config JSON CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json_array)\'');
    }
}
