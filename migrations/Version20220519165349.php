<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519165349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, type_evenement_id INT NOT NULL, laronde_id INT NOT NULL, heure TIME NOT NULL, observation LONGTEXT DEFAULT NULL, INDEX IDX_E10AD40088939516 (type_evenement_id), INDEX IDX_E10AD4003B76173A (laronde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE la_ronde (id INT AUTO_INCREMENT NOT NULL, agent_id INT NOT NULL, site_id INT NOT NULL, materiel_id INT DEFAULT NULL, date_fin DATETIME NOT NULL, date_debut DATETIME NOT NULL, observation LONGTEXT NOT NULL, detail LONGTEXT NOT NULL, INDEX IDX_AC281E4A3414710B (agent_id), INDEX IDX_AC281E4AF6BD1646 (site_id), INDEX IDX_AC281E4A16880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, cle TINYINT(1) DEFAULT NULL, radio TINYINT(1) DEFAULT NULL, phone TINYINT(1) DEFAULT NULL, ronde TINYINT(1) DEFAULT NULL, lamp TINYINT(1) DEFAULT NULL, contact TINYINT(1) DEFAULT NULL, ivvadr TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointaux (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, laronde_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, logitude VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, INDEX IDX_1CAB072AF6BD1646 (site_id), INDEX IDX_1CAB072A3B76173A (laronde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_evenements (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD40088939516 FOREIGN KEY (type_evenement_id) REFERENCES type_evenements (id)');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD4003B76173A FOREIGN KEY (laronde_id) REFERENCES la_ronde (id)');
        $this->addSql('ALTER TABLE la_ronde ADD CONSTRAINT FK_AC281E4A3414710B FOREIGN KEY (agent_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE la_ronde ADD CONSTRAINT FK_AC281E4AF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE la_ronde ADD CONSTRAINT FK_AC281E4A16880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE pointaux ADD CONSTRAINT FK_1CAB072AF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE pointaux ADD CONSTRAINT FK_1CAB072A3B76173A FOREIGN KEY (laronde_id) REFERENCES la_ronde (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD4003B76173A');
        $this->addSql('ALTER TABLE pointaux DROP FOREIGN KEY FK_1CAB072A3B76173A');
        $this->addSql('ALTER TABLE la_ronde DROP FOREIGN KEY FK_AC281E4A16880AAF');
        $this->addSql('ALTER TABLE la_ronde DROP FOREIGN KEY FK_AC281E4AF6BD1646');
        $this->addSql('ALTER TABLE pointaux DROP FOREIGN KEY FK_1CAB072AF6BD1646');
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD40088939516');
        $this->addSql('DROP TABLE evenements');
        $this->addSql('DROP TABLE la_ronde');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE pointaux');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE type_evenements');
    }
}
