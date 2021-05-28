<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518205725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier_crepe (panier_id INT NOT NULL, crepe_id INT NOT NULL, INDEX IDX_AC5058C0F77D927C (panier_id), INDEX IDX_AC5058C074A2DC06 (crepe_id), PRIMARY KEY(panier_id, crepe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE panier_crepe ADD CONSTRAINT FK_AC5058C0F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_crepe ADD CONSTRAINT FK_AC5058C074A2DC06 FOREIGN KEY (crepe_id) REFERENCES crepe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier_crepe DROP FOREIGN KEY FK_AC5058C0F77D927C');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE panier_crepe');
    }
}
