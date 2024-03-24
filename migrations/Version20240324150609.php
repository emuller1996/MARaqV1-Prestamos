<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324150609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_cliente ADD cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_cliente ADD CONSTRAINT FK_AC11852FDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC11852FDE734E51 ON user_cliente (cliente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_cliente DROP FOREIGN KEY FK_AC11852FDE734E51');
        $this->addSql('DROP INDEX UNIQ_AC11852FDE734E51 ON user_cliente');
        $this->addSql('ALTER TABLE user_cliente DROP cliente_id');
    }
}
