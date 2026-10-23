<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261023182257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hodnoceni (id INT AUTO_INCREMENT NOT NULL, hodnota SMALLINT NOT NULL, datum_hodnoceni DATETIME NOT NULL, yeti_id INT NOT NULL, INDEX IDX_F683ADB6B32122C (datum_hodnoceni), INDEX IDX_F683ADB66FD936CB (yeti_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE yeti (id INT AUTO_INCREMENT NOT NULL, jmeno VARCHAR(120) NOT NULL, pohlavi SMALLINT NOT NULL, vyska INT NOT NULL, vaha INT NOT NULL, bydliste VARCHAR(120) NOT NULL, popis LONGTEXT DEFAULT NULL, vytvoreno_datum_cas DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE hodnoceni ADD CONSTRAINT FK_F683ADB66FD936CB FOREIGN KEY (yeti_id) REFERENCES yeti (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hodnoceni DROP FOREIGN KEY FK_F683ADB66FD936CB');
        $this->addSql('DROP TABLE hodnoceni');
        $this->addSql('DROP TABLE yeti');
    }
}
