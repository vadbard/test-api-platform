<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241010121543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE child_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE parent_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE child_entity (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_677D8034727ACA70 ON child_entity (parent_id)');
        $this->addSql('CREATE TABLE parent_entity (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE child_entity ADD CONSTRAINT FK_677D8034727ACA70 FOREIGN KEY (parent_id) REFERENCES parent_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE child_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE parent_entity_id_seq CASCADE');
        $this->addSql('ALTER TABLE child_entity DROP CONSTRAINT FK_677D8034727ACA70');
        $this->addSql('DROP TABLE child_entity');
        $this->addSql('DROP TABLE parent_entity');
    }
}
