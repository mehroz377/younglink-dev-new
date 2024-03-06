<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120223810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guardian ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guardian ADD CONSTRAINT FK_64486055A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64486055A76ED395 ON guardian (user_id)');
        $this->addSql('ALTER TABLE school_employee ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE school_employee ADD CONSTRAINT FK_A3D941E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A3D941E5A76ED395 ON school_employee (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guardian DROP FOREIGN KEY FK_64486055A76ED395');
        $this->addSql('DROP INDEX UNIQ_64486055A76ED395 ON guardian');
        $this->addSql('ALTER TABLE guardian DROP user_id');
        $this->addSql('ALTER TABLE school_employee DROP FOREIGN KEY FK_A3D941E5A76ED395');
        $this->addSql('DROP INDEX UNIQ_A3D941E5A76ED395 ON school_employee');
        $this->addSql('ALTER TABLE school_employee DROP user_id');
    }
}
