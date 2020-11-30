<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126160944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoot ADD prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE shoot ADD CONSTRAINT FK_7044FCBE9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_7044FCBE9E45C554 ON shoot (prestation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoot DROP FOREIGN KEY FK_7044FCBE9E45C554');
        $this->addSql('DROP INDEX IDX_7044FCBE9E45C554 ON shoot');
        $this->addSql('ALTER TABLE shoot DROP prestation_id');
    }
}
