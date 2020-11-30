<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126132237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoot ADD base_id INT NOT NULL');
        $this->addSql('ALTER TABLE shoot ADD CONSTRAINT FK_7044FCBE6967DF41 FOREIGN KEY (base_id) REFERENCES base (id)');
        $this->addSql('CREATE INDEX IDX_7044FCBE6967DF41 ON shoot (base_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoot DROP FOREIGN KEY FK_7044FCBE6967DF41');
        $this->addSql('DROP INDEX IDX_7044FCBE6967DF41 ON shoot');
        $this->addSql('ALTER TABLE shoot DROP base_id');
    }
}
