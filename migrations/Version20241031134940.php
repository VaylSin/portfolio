<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031134940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers DROP FOREIGN KEY FK_62534E211D4EC6B1');
        $this->addSql('DROP INDEX UNIQ_62534E211D4EC6B1 ON customers');
        $this->addSql('ALTER TABLE customers DROP testimonial_id');
        $this->addSql('ALTER TABLE testimonial ADD customers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF7C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6BDCDF7C3568B40 ON testimonial (customers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers ADD testimonial_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E211D4EC6B1 FOREIGN KEY (testimonial_id) REFERENCES testimonial (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62534E211D4EC6B1 ON customers (testimonial_id)');
        $this->addSql('ALTER TABLE testimonial DROP FOREIGN KEY FK_E6BDCDF7C3568B40');
        $this->addSql('DROP INDEX UNIQ_E6BDCDF7C3568B40 ON testimonial');
        $this->addSql('ALTER TABLE testimonial DROP customers_id');
    }
}
