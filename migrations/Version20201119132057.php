<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119132057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base ADD plateform_id INT NOT NULL');
        $this->addSql('ALTER TABLE base ADD CONSTRAINT FK_C0B4FE61CCAA542F FOREIGN KEY (plateform_id) REFERENCES plateform (id)');
        $this->addSql('CREATE INDEX IDX_C0B4FE61CCAA542F ON base (plateform_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base DROP FOREIGN KEY FK_C0B4FE61CCAA542F');
        $this->addSql('DROP INDEX IDX_C0B4FE61CCAA542F ON base');
        $this->addSql('ALTER TABLE base DROP plateform_id');
    }
}
