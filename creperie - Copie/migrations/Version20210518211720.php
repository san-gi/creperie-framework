<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518211720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier ADD facture_id INT DEFAULT NULL, ADD etat INT NOT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF27F2DEE08 FOREIGN KEY (facture_id) REFERENCES factures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24CC0DF27F2DEE08 ON panier (facture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF27F2DEE08');
        $this->addSql('DROP INDEX UNIQ_24CC0DF27F2DEE08 ON panier');
        $this->addSql('ALTER TABLE panier DROP facture_id, DROP etat');
    }
}
