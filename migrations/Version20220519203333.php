<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519203333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupage ADD la_ronde_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupage ADD CONSTRAINT FK_39250CC5FAB85AAF FOREIGN KEY (la_ronde_id) REFERENCES la_ronde (id)');
        $this->addSql('CREATE INDEX IDX_39250CC5FAB85AAF ON groupage (la_ronde_id)');
        $this->addSql('ALTER TABLE la_ronde DROP FOREIGN KEY FK_AC281E4A16940AE9');
        $this->addSql('DROP INDEX IDX_AC281E4A16940AE9 ON la_ronde');
        $this->addSql('ALTER TABLE la_ronde DROP groupage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupage DROP FOREIGN KEY FK_39250CC5FAB85AAF');
        $this->addSql('DROP INDEX IDX_39250CC5FAB85AAF ON groupage');
        $this->addSql('ALTER TABLE groupage DROP la_ronde_id');
        $this->addSql('ALTER TABLE la_ronde ADD groupage_id INT NOT NULL');
        $this->addSql('ALTER TABLE la_ronde ADD CONSTRAINT FK_AC281E4A16940AE9 FOREIGN KEY (groupage_id) REFERENCES groupage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AC281E4A16940AE9 ON la_ronde (groupage_id)');
    }
}
