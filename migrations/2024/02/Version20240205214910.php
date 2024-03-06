<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205214910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE district (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_help_article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_help_expert (id INT AUTO_INCREMENT NOT NULL, district_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, specialization VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_3997276AB08FA272 (district_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_help_expert_labels (expert_id INT NOT NULL, label_id INT NOT NULL, INDEX IDX_97888F9CC5568CE4 (expert_id), INDEX IDX_97888F9C33B92F39 (label_id), PRIMARY KEY(expert_id, label_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_help_expert_label (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_help_video (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professional_help_expert ADD CONSTRAINT FK_3997276AB08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('ALTER TABLE professional_help_expert_labels ADD CONSTRAINT FK_97888F9CC5568CE4 FOREIGN KEY (expert_id) REFERENCES professional_help_expert (id)');
        $this->addSql('ALTER TABLE professional_help_expert_labels ADD CONSTRAINT FK_97888F9C33B92F39 FOREIGN KEY (label_id) REFERENCES professional_help_expert_label (id)');
        $this->addSql('ALTER TABLE school ADD district_id INT NOT NULL');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBB08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('CREATE INDEX IDX_F99EDABBB08FA272 ON school (district_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE school DROP FOREIGN KEY FK_F99EDABBB08FA272');
        $this->addSql('ALTER TABLE professional_help_expert DROP FOREIGN KEY FK_3997276AB08FA272');
        $this->addSql('ALTER TABLE professional_help_expert_labels DROP FOREIGN KEY FK_97888F9CC5568CE4');
        $this->addSql('ALTER TABLE professional_help_expert_labels DROP FOREIGN KEY FK_97888F9C33B92F39');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP TABLE professional_help_article');
        $this->addSql('DROP TABLE professional_help_expert');
        $this->addSql('DROP TABLE professional_help_expert_labels');
        $this->addSql('DROP TABLE professional_help_expert_label');
        $this->addSql('DROP TABLE professional_help_video');
        $this->addSql('DROP INDEX IDX_F99EDABBB08FA272 ON school');
        $this->addSql('ALTER TABLE school DROP district_id');
    }
}
