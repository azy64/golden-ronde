<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519195050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupage (id INT AUTO_INCREMENT NOT NULL, evenement_id INT NOT NULL, pointau_id INT NOT NULL, INDEX IDX_39250CC5FD02F13 (evenement_id), INDEX IDX_39250CC573347215 (pointau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupage ADD CONSTRAINT FK_39250CC5FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenements (id)');
        $this->addSql('ALTER TABLE groupage ADD CONSTRAINT FK_39250CC573347215 FOREIGN KEY (pointau_id) REFERENCES pointaux (id)');
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD4003B76173A');
        $this->addSql('DROP INDEX IDX_E10AD4003B76173A ON evenements');
        $this->addSql('ALTER TABLE evenements DROP laronde_id');
        $this->addSql('ALTER TABLE la_ronde ADD groupage_id INT NOT NULL, DROP observation, DROP detail');
        $this->addSql('ALTER TABLE la_ronde ADD CONSTRAINT FK_AC281E4A16940AE9 FOREIGN KEY (groupage_id) REFERENCES groupage (id)');
        $this->addSql('CREATE INDEX IDX_AC281E4A16940AE9 ON la_ronde (groupage_id)');
        $this->addSql('ALTER TABLE pointaux DROP FOREIGN KEY FK_1CAB072A3B76173A');
        $this->addSql('DROP INDEX IDX_1CAB072A3B76173A ON pointaux');
        $this->addSql('ALTER TABLE pointaux DROP laronde_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE la_ronde DROP FOREIGN KEY FK_AC281E4A16940AE9');
        $this->addSql('DROP TABLE groupage');
        $this->addSql('ALTER TABLE evenements ADD laronde_id INT NOT NULL');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD4003B76173A FOREIGN KEY (laronde_id) REFERENCES la_ronde (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E10AD4003B76173A ON evenements (laronde_id)');
        $this->addSql('DROP INDEX IDX_AC281E4A16940AE9 ON la_ronde');
        $this->addSql('ALTER TABLE la_ronde ADD observation LONGTEXT NOT NULL, ADD detail LONGTEXT NOT NULL, DROP groupage_id');
        $this->addSql('ALTER TABLE pointaux ADD laronde_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pointaux ADD CONSTRAINT FK_1CAB072A3B76173A FOREIGN KEY (laronde_id) REFERENCES la_ronde (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1CAB072A3B76173A ON pointaux (laronde_id)');
    }
}
