<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217222523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE main_message (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', from_id INT DEFAULT NULL, to_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_42F6999678CED90B (from_id), INDEX IDX_42F6999630354A65 (to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_message (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', from_id INT DEFAULT NULL, main_message_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', message_text LONGTEXT NOT NULL, INDEX IDX_C9656C8B78CED90B (from_id), INDEX IDX_C9656C8B6B82674A (main_message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE main_message ADD CONSTRAINT FK_42F6999678CED90B FOREIGN KEY (from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE main_message ADD CONSTRAINT FK_42F6999630354A65 FOREIGN KEY (to_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sub_message ADD CONSTRAINT FK_C9656C8B78CED90B FOREIGN KEY (from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sub_message ADD CONSTRAINT FK_C9656C8B6B82674A FOREIGN KEY (main_message_id) REFERENCES main_message (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main_message DROP FOREIGN KEY FK_42F6999678CED90B');
        $this->addSql('ALTER TABLE main_message DROP FOREIGN KEY FK_42F6999630354A65');
        $this->addSql('ALTER TABLE sub_message DROP FOREIGN KEY FK_C9656C8B78CED90B');
        $this->addSql('ALTER TABLE sub_message DROP FOREIGN KEY FK_C9656C8B6B82674A');
        $this->addSql('DROP TABLE main_message');
        $this->addSql('DROP TABLE sub_message');
    }
}
