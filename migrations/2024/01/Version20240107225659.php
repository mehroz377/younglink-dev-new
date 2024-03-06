<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240107225659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE results (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', questionnaire_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', raw_json JSON NOT NULL, aggression NUMERIC(5, 4) DEFAULT NULL, bully_core_periphery1 NUMERIC(5, 4) DEFAULT NULL, bully_core_periphery2 NUMERIC(5, 4) DEFAULT NULL, bullying_reciprocation NUMERIC(5, 4) DEFAULT NULL, victim_defending NUMERIC(5, 4) DEFAULT NULL, classroom_bullies SMALLINT DEFAULT NULL, classroom_bully_victims SMALLINT DEFAULT NULL, classroom_defenders SMALLINT DEFAULT NULL, classroom_victims SMALLINT DEFAULT NULL, healthy_relationships_index NUMERIC(5, 4) DEFAULT NULL, trustworthiness_score NUMERIC(5, 4) DEFAULT NULL, lower80_ci NUMERIC(5, 4) DEFAULT NULL, upper80_ci NUMERIC(5, 4) DEFAULT NULL, cohesion NUMERIC(5, 4) DEFAULT NULL, core_periphery1 NUMERIC(5, 4) DEFAULT NULL, overall_reciprocity NUMERIC(5, 4) DEFAULT NULL, UNIQUE INDEX UNIQ_9FA3E414CE07E8FF (questionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_results (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', results_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', student_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', degree NUMERIC(5, 4) DEFAULT NULL, betweenness NUMERIC(5, 4) DEFAULT NULL, group1 SMALLINT DEFAULT NULL, group2 SMALLINT DEFAULT NULL, group3 SMALLINT DEFAULT NULL, group4 SMALLINT DEFAULT NULL, nr_groups_classroom_notnormalized SMALLINT DEFAULT NULL, nr_groups_classroom NUMERIC(4, 2) DEFAULT NULL, influence_x NUMERIC(5, 4) DEFAULT NULL, leadership SMALLINT DEFAULT NULL, group_identification SMALLINT DEFAULT NULL, internalization NUMERIC(4, 2) DEFAULT NULL, closeness_friendships NUMERIC(5, 4) DEFAULT NULL, victimization_indegree NUMERIC(5, 4) DEFAULT NULL, bullying_outdegree NUMERIC(5, 4) DEFAULT NULL, defending_indegree NUMERIC(5, 4) DEFAULT NULL, defending_outdegree NUMERIC(5, 4) DEFAULT NULL, resilience NUMERIC(5, 4) DEFAULT NULL, INDEX IDX_729551EC8A30AB9 (results_id), INDEX IDX_729551ECCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E414CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('ALTER TABLE student_results ADD CONSTRAINT FK_729551EC8A30AB9 FOREIGN KEY (results_id) REFERENCES results (id)');
        $this->addSql('ALTER TABLE student_results ADD CONSTRAINT FK_729551ECCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('DROP TABLE import_log');
        $this->addSql('ALTER TABLE questionnaire ADD results_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF8A30AB9 FOREIGN KEY (results_id) REFERENCES results (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A64DAF8A30AB9 ON questionnaire (results_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF8A30AB9');
        $this->addSql('CREATE TABLE import_log (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', student_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, data JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE results DROP FOREIGN KEY FK_9FA3E414CE07E8FF');
        $this->addSql('ALTER TABLE student_results DROP FOREIGN KEY FK_729551EC8A30AB9');
        $this->addSql('ALTER TABLE student_results DROP FOREIGN KEY FK_729551ECCB944F1A');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE student_results');
        $this->addSql('DROP INDEX UNIQ_7A64DAF8A30AB9 ON questionnaire');
        $this->addSql('ALTER TABLE questionnaire DROP results_id');
    }
}
