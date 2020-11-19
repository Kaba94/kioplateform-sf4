<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201113135317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plateform_user (plateform_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9AE4A1F5CCAA542F (plateform_id), INDEX IDX_9AE4A1F5A76ED395 (user_id), PRIMARY KEY(plateform_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plateform_user ADD CONSTRAINT FK_9AE4A1F5CCAA542F FOREIGN KEY (plateform_id) REFERENCES plateform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plateform_user ADD CONSTRAINT FK_9AE4A1F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE plateform_user');
    }
}
