<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322194659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE crepe (id INT AUTO_INCREMENT NOT NULL, img VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crepe_ingredients (crepe_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_57542FF374A2DC06 (crepe_id), INDEX IDX_57542FF33EC4DCE (ingredients_id), PRIMARY KEY(crepe_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, etat INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures_crepe (factures_id INT NOT NULL, crepe_id INT NOT NULL, INDEX IDX_52CFDAAEE9D518F9 (factures_id), INDEX IDX_52CFDAAE74A2DC06 (crepe_id), PRIMARY KEY(factures_id, crepe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crepe_ingredients ADD CONSTRAINT FK_57542FF374A2DC06 FOREIGN KEY (crepe_id) REFERENCES crepe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crepe_ingredients ADD CONSTRAINT FK_57542FF33EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factures_crepe ADD CONSTRAINT FK_52CFDAAEE9D518F9 FOREIGN KEY (factures_id) REFERENCES factures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factures_crepe ADD CONSTRAINT FK_52CFDAAE74A2DC06 FOREIGN KEY (crepe_id) REFERENCES crepe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crepe_ingredients DROP FOREIGN KEY FK_57542FF374A2DC06');
        $this->addSql('ALTER TABLE factures_crepe DROP FOREIGN KEY FK_52CFDAAE74A2DC06');
        $this->addSql('ALTER TABLE factures_crepe DROP FOREIGN KEY FK_52CFDAAEE9D518F9');
        $this->addSql('ALTER TABLE crepe_ingredients DROP FOREIGN KEY FK_57542FF33EC4DCE');
        $this->addSql('DROP TABLE crepe');
        $this->addSql('DROP TABLE crepe_ingredients');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE factures_crepe');
        $this->addSql('DROP TABLE ingredients');
    }
}
