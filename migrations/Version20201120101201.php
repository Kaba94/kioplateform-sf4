<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201120101201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoot ADD annonceur_id INT NOT NULL');
        $this->addSql('ALTER TABLE shoot ADD CONSTRAINT FK_7044FCBEC8764012 FOREIGN KEY (annonceur_id) REFERENCES annonceur (id)');
        $this->addSql('CREATE INDEX IDX_7044FCBEC8764012 ON shoot (annonceur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoot DROP FOREIGN KEY FK_7044FCBEC8764012');
        $this->addSql('DROP INDEX IDX_7044FCBEC8764012 ON shoot');
        $this->addSql('ALTER TABLE shoot DROP annonceur_id');
    }
}
