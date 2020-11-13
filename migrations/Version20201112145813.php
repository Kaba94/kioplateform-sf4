<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112145813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E795BC5E1C955764 ON annonceur (skype_du_contact)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E795BC5E70096015 ON annonceur (email_du_contact)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_E795BC5E1C955764 ON annonceur');
        $this->addSql('DROP INDEX UNIQ_E795BC5E70096015 ON annonceur');
    }
}
