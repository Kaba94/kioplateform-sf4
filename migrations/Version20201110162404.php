<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110162404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, routeur_id INT DEFAULT NULL, plateform_id INT DEFAULT NULL, prix NUMERIC(6, 2) NOT NULL, INDEX IDX_51C88FAD5F469D09 (routeur_id), INDEX IDX_51C88FADCCAA542F (plateform_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD5F469D09 FOREIGN KEY (routeur_id) REFERENCES routeur (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADCCAA542F FOREIGN KEY (plateform_id) REFERENCES plateform (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prestation');
    }
}
