<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112113018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonceur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, nom_du_contact VARCHAR(50) NOT NULL, skype_du_contact VARCHAR(255) DEFAULT NULL, email_du_contact VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postale INT NOT NULL, ville VARCHAR(255) NOT NULL, telephone INT NOT NULL, numero_siret INT NOT NULL, tva INT DEFAULT NULL, email_comptabilite VARCHAR(255) DEFAULT NULL, contact_comptabilite VARCHAR(255) DEFAULT NULL, ulr_plateform VARCHAR(255) DEFAULT NULL, mdp_plateform VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E795BC5E6C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE annonceur');
    }
}
