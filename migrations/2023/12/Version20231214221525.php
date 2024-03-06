<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214221525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE student_questionnaire (student_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', questionnaire_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_523AB531CB944F1A (student_id), INDEX IDX_523AB531CE07E8FF (questionnaire_id), PRIMARY KEY(student_id, questionnaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student_questionnaire ADD CONSTRAINT FK_523AB531CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_questionnaire ADD CONSTRAINT FK_523AB531CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire ADD type VARCHAR(255) NOT NULL, ADD fill_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_questionnaire DROP FOREIGN KEY FK_523AB531CB944F1A');
        $this->addSql('ALTER TABLE student_questionnaire DROP FOREIGN KEY FK_523AB531CE07E8FF');
        $this->addSql('DROP TABLE student_questionnaire');
        $this->addSql('ALTER TABLE questionnaire DROP type, DROP fill_date');
    }
}
