<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113173528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', username VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroom (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', school_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_497D309DC32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guardian (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', timeline_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', position SMALLINT NOT NULL, finished TINYINT(1) NOT NULL, INDEX IDX_7A64DAFEDBEDD37 (timeline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_employee (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', school_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_A3D941E5C32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_year (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', school_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', classroom_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_B723AF33C32A47EE (school_id), INDEX IDX_B723AF336278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_guardians (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', student_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', guardian_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_6705E390CB944F1A (student_id), INDEX IDX_6705E39011CC8B0A (guardian_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher_classroom (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', teacher_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', classroom_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_33167C8641807E1D (teacher_id), INDEX IDX_33167C866278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timeline (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', school_year_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', classroom_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', active TINYINT(1) NOT NULL, INDEX IDX_46FEC666D2EECC3F (school_year_id), INDEX IDX_46FEC6666278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309DC32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAFEDBEDD37 FOREIGN KEY (timeline_id) REFERENCES timeline (id)');
        $this->addSql('ALTER TABLE school_employee ADD CONSTRAINT FK_A3D941E5C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE student_guardians ADD CONSTRAINT FK_6705E390CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE student_guardians ADD CONSTRAINT FK_6705E39011CC8B0A FOREIGN KEY (guardian_id) REFERENCES guardian (id)');
        $this->addSql('ALTER TABLE teacher_classroom ADD CONSTRAINT FK_33167C8641807E1D FOREIGN KEY (teacher_id) REFERENCES school_employee (id)');
        $this->addSql('ALTER TABLE teacher_classroom ADD CONSTRAINT FK_33167C866278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE timeline ADD CONSTRAINT FK_46FEC666D2EECC3F FOREIGN KEY (school_year_id) REFERENCES school_year (id)');
        $this->addSql('ALTER TABLE timeline ADD CONSTRAINT FK_46FEC6666278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom DROP FOREIGN KEY FK_497D309DC32A47EE');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAFEDBEDD37');
        $this->addSql('ALTER TABLE school_employee DROP FOREIGN KEY FK_A3D941E5C32A47EE');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33C32A47EE');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336278D5A8');
        $this->addSql('ALTER TABLE student_guardians DROP FOREIGN KEY FK_6705E390CB944F1A');
        $this->addSql('ALTER TABLE student_guardians DROP FOREIGN KEY FK_6705E39011CC8B0A');
        $this->addSql('ALTER TABLE teacher_classroom DROP FOREIGN KEY FK_33167C8641807E1D');
        $this->addSql('ALTER TABLE teacher_classroom DROP FOREIGN KEY FK_33167C866278D5A8');
        $this->addSql('ALTER TABLE timeline DROP FOREIGN KEY FK_46FEC666D2EECC3F');
        $this->addSql('ALTER TABLE timeline DROP FOREIGN KEY FK_46FEC6666278D5A8');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE guardian');
        $this->addSql('DROP TABLE questionnaire');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE school_employee');
        $this->addSql('DROP TABLE school_year');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_guardians');
        $this->addSql('DROP TABLE teacher_classroom');
        $this->addSql('DROP TABLE timeline');
    }
}
