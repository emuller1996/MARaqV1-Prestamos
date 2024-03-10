<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309225951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prestamos (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, valor_total NUMERIC(20, 0) NOT NULL, fecha_prestamo DATE NOT NULL, porcentaje_interes NUMERIC(10, 0) NOT NULL, valor_interes NUMERIC(20, 0) NOT NULL, estado VARCHAR(20) NOT NULL, deuda_actual NUMERIC(20, 0) NOT NULL, dia_pago INT DEFAULT NULL, INDEX IDX_4849844FDE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestamos ADD CONSTRAINT FK_4849844FDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestamos DROP FOREIGN KEY FK_4849844FDE734E51');
        $this->addSql('DROP TABLE prestamos');
    }
}
