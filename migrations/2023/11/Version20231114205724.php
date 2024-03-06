<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114205724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_classes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_type VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_69DD750638A36066 (class_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_security_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(200) NOT NULL, username TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 (identifier, username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL, entries_inheriting TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), INDEX IDX_9407E54977FA751A (parent_object_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE2993D9AB4A6 (object_identity_id), INDEX IDX_825DE299C671CEA1 (ancestor_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, security_identity_id INT UNSIGNED NOT NULL, field_name VARCHAR(50) DEFAULT NULL, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) NOT NULL, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id)');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE school_employee ADD school_employee_role VARCHAR(20) NOT NULL, DROP username');
        $this->addSql('ALTER TABLE teacher_classroom DROP FOREIGN KEY FK_33167C8641807E1D');
        $this->addSql('ALTER TABLE teacher_classroom DROP FOREIGN KEY FK_33167C866278D5A8');
        $this->addSql('DROP INDEX IDX_33167C8641807E1D ON teacher_classroom');
        $this->addSql('DROP INDEX `primary` ON teacher_classroom');
        $this->addSql('ALTER TABLE teacher_classroom ADD school_employee_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', DROP id, DROP teacher_id');
        $this->addSql('ALTER TABLE teacher_classroom ADD CONSTRAINT FK_33167C86DF05C3EC FOREIGN KEY (school_employee_id) REFERENCES school_employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_classroom ADD CONSTRAINT FK_33167C866278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_33167C86DF05C3EC ON teacher_classroom (school_employee_id)');
        $this->addSql('ALTER TABLE teacher_classroom ADD PRIMARY KEY (school_employee_id, classroom_id)');
        $this->addSql('ALTER TABLE school_year ADD year VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student_guardians DROP FOREIGN KEY FK_6705E39011CC8B0A');
        $this->addSql('ALTER TABLE student_guardians DROP FOREIGN KEY FK_6705E390CB944F1A');
        $this->addSql('DROP INDEX `primary` ON student_guardians');
        $this->addSql('ALTER TABLE student_guardians DROP id');
        $this->addSql('ALTER TABLE student_guardians ADD CONSTRAINT FK_6705E39011CC8B0A FOREIGN KEY (guardian_id) REFERENCES guardian (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_guardians ADD CONSTRAINT FK_6705E390CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_guardians ADD PRIMARY KEY (student_id, guardian_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acl_object_identities DROP FOREIGN KEY FK_9407E54977FA751A');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE2993D9AB4A6');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE299C671CEA1');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806EA000B10');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B8063D9AB4A6');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806DF9183C9');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE acl_classes');
        $this->addSql('DROP TABLE acl_security_identities');
        $this->addSql('DROP TABLE acl_object_identities');
        $this->addSql('DROP TABLE acl_object_identity_ancestors');
        $this->addSql('DROP TABLE acl_entries');
        $this->addSql('ALTER TABLE student_guardians DROP FOREIGN KEY FK_6705E390CB944F1A');
        $this->addSql('ALTER TABLE student_guardians DROP FOREIGN KEY FK_6705E39011CC8B0A');
        $this->addSql('DROP INDEX `PRIMARY` ON student_guardians');
        $this->addSql('ALTER TABLE student_guardians ADD id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE student_guardians ADD CONSTRAINT FK_6705E390CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE student_guardians ADD CONSTRAINT FK_6705E39011CC8B0A FOREIGN KEY (guardian_id) REFERENCES guardian (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE student_guardians ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE school_employee ADD username VARCHAR(255) NOT NULL, DROP school_employee_role');
        $this->addSql('ALTER TABLE questionnaire DROP name');
        $this->addSql('ALTER TABLE school_year DROP year');
        $this->addSql('ALTER TABLE teacher_classroom DROP FOREIGN KEY FK_33167C86DF05C3EC');
        $this->addSql('ALTER TABLE teacher_classroom DROP FOREIGN KEY FK_33167C866278D5A8');
        $this->addSql('DROP INDEX IDX_33167C86DF05C3EC ON teacher_classroom');
        $this->addSql('DROP INDEX `PRIMARY` ON teacher_classroom');
        $this->addSql('ALTER TABLE teacher_classroom ADD teacher_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE school_employee_id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE teacher_classroom ADD CONSTRAINT FK_33167C8641807E1D FOREIGN KEY (teacher_id) REFERENCES school_employee (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE teacher_classroom ADD CONSTRAINT FK_33167C866278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_33167C8641807E1D ON teacher_classroom (teacher_id)');
        $this->addSql('ALTER TABLE teacher_classroom ADD PRIMARY KEY (id)');
    }
}
