<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115205641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sociograms (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', results_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', friendship_network_unweighted LONGTEXT NOT NULL, friendship_network_weighted LONGTEXT NOT NULL, bully_network_unweighted LONGTEXT NOT NULL, bully_network_weighted LONGTEXT NOT NULL, defending_network_unweighted LONGTEXT NOT NULL, defending_network_weighted LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_7EA85C488A30AB9 (results_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sociograms ADD CONSTRAINT FK_7EA85C488A30AB9 FOREIGN KEY (results_id) REFERENCES results (id)');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF8A30AB9');
        $this->addSql('DROP INDEX UNIQ_7A64DAF8A30AB9 ON questionnaire');
        $this->addSql('ALTER TABLE questionnaire DROP results_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sociograms DROP FOREIGN KEY FK_7EA85C488A30AB9');
        $this->addSql('DROP TABLE sociograms');
        $this->addSql('ALTER TABLE questionnaire ADD results_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF8A30AB9 FOREIGN KEY (results_id) REFERENCES results (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A64DAF8A30AB9 ON questionnaire (results_id)');
    }
}
