<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220822205546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE department (id UUID NOT NULL, name VARCHAR(255) NOT NULL, salary_supplement INT NOT NULL, supplement_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN department.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE employee (id UUID NOT NULL, department UUID DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, basic_salary DOUBLE PRECISION NOT NULL, employment_year DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D9F75A1CD1DE18A ON employee (department)');
        $this->addSql('COMMENT ON COLUMN employee.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employee.department IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1CD1DE18A FOREIGN KEY (department) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT FK_5D9F75A1CD1DE18A');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE employee');
    }
}
