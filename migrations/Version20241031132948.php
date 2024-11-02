<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031132948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers ADD testimonial_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E211D4EC6B1 FOREIGN KEY (testimonial_id) REFERENCES testimonial (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62534E211D4EC6B1 ON customers (testimonial_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers DROP FOREIGN KEY FK_62534E211D4EC6B1');
        $this->addSql('DROP INDEX UNIQ_62534E211D4EC6B1 ON customers');
        $this->addSql('ALTER TABLE customers DROP testimonial_id');
    }
}
