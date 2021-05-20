<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520170427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE crepe_commande (id INT AUTO_INCREMENT NOT NULL, crepe_id INT DEFAULT NULL, panier_id INT DEFAULT NULL, INDEX IDX_24916B9674A2DC06 (crepe_id), INDEX IDX_24916B96F77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crepe_commande_ingredients (crepe_commande_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_14BEA5499EDE10E8 (crepe_commande_id), INDEX IDX_14BEA5493EC4DCE (ingredients_id), PRIMARY KEY(crepe_commande_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crepe_commande ADD CONSTRAINT FK_24916B9674A2DC06 FOREIGN KEY (crepe_id) REFERENCES crepe (id)');
        $this->addSql('ALTER TABLE crepe_commande ADD CONSTRAINT FK_24916B96F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE crepe_commande_ingredients ADD CONSTRAINT FK_14BEA5499EDE10E8 FOREIGN KEY (crepe_commande_id) REFERENCES crepe_commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crepe_commande_ingredients ADD CONSTRAINT FK_14BEA5493EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crepe_commande_ingredients DROP FOREIGN KEY FK_14BEA5499EDE10E8');
        $this->addSql('DROP TABLE crepe_commande');
        $this->addSql('DROP TABLE crepe_commande_ingredients');
    }
}
