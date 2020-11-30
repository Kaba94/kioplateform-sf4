<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124133952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plateform_routeur (plateform_id INT NOT NULL, routeur_id INT NOT NULL, INDEX IDX_A526322CCAA542F (plateform_id), INDEX IDX_A5263225F469D09 (routeur_id), PRIMARY KEY(plateform_id, routeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plateform_routeur ADD CONSTRAINT FK_A526322CCAA542F FOREIGN KEY (plateform_id) REFERENCES plateform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plateform_routeur ADD CONSTRAINT FK_A5263225F469D09 FOREIGN KEY (routeur_id) REFERENCES routeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE plateform_routeur');
    }
}
