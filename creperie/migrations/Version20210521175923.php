<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521175923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crepe ADD price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE crepe_commande DROP FOREIGN KEY FK_24916B96F77D927C');
        $this->addSql('DROP INDEX IDX_24916B96F77D927C ON crepe_commande');
        $this->addSql('ALTER TABLE crepe_commande DROP panier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crepe DROP price');
        $this->addSql('ALTER TABLE crepe_commande ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE crepe_commande ADD CONSTRAINT FK_24916B96F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_24916B96F77D927C ON crepe_commande (panier_id)');
    }
}
