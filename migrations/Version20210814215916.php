<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210814215916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competences ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competences ADD CONSTRAINT FK_DB2077CEFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_DB2077CEFB88E14F ON competences (utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3275ED078');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3275ED078 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP profil_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competences DROP FOREIGN KEY FK_DB2077CEFB88E14F');
        $this->addSql('DROP INDEX IDX_DB2077CEFB88E14F ON competences');
        $this->addSql('ALTER TABLE competences DROP utilisateur_id');
        $this->addSql('ALTER TABLE utilisateur ADD profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3275ED078 FOREIGN KEY (profil_id) REFERENCES competences (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3275ED078 ON utilisateur (profil_id)');
    }
}
