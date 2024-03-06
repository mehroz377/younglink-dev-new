<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113174227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE classroom ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE guardian ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE school_employee ADD username VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP firstname, DROP lastname, DROP email');
        $this->addSql('ALTER TABLE school_employee DROP username, DROP firstname, DROP lastname');
        $this->addSql('ALTER TABLE guardian DROP firstname, DROP lastname, DROP email');
        $this->addSql('ALTER TABLE classroom DROP name');
        $this->addSql('ALTER TABLE `admin` DROP firstname, DROP lastname');
    }
}
