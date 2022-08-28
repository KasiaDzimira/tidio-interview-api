<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220828102502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO department (id, name, salary_supplement, supplement_type) VALUES ('e4fe528a-26bb-11ed-a261-0242ac120002', 'Human Resources', 100, 'FIXED_AMOUNT')");
        $this->addSql("INSERT INTO department (id, name, salary_supplement, supplement_type) VALUES ('0dfdbfe0-26bc-11ed-a261-0242ac120002', 'Finance', 10, 'PERCENTAGE')");
        $this->addSql("INSERT INTO employee (id, department, first_name, last_name, basic_salary, employment_year) VALUES ('7471530e-26bc-11ed-a261-0242ac120002', 'e4fe528a-26bb-11ed-a261-0242ac120002', 'Alicia', 'McGrath', 1000, '2007-08-01')");
        $this->addSql("INSERT INTO employee (id, department, first_name, last_name, basic_salary, employment_year) VALUES ('bd9fc7b8-26bc-11ed-a261-0242ac120002', '0dfdbfe0-26bc-11ed-a261-0242ac120002', 'William', 'Ned', 1100, '2017-08-01')");
    }

    public function down(Schema $schema): void
    {
    }
}
