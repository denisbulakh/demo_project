<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208222348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function isTransactional(): bool
    {
        return false;
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE advisor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, availability TINYINT(1) NOT NULL, price_per_minute DOUBLE PRECISION NOT NULL, languages LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', image MEDIUMBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE advisor');
    }
}
