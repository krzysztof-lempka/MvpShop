<?php

namespace MvpShop\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180204162845 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, price NUMERIC(10, 2) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updatet_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE product');
    }
}
