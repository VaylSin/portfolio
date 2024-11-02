<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031141114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers_image (customers_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_F6DD677AC3568B40 (customers_id), INDEX IDX_F6DD677A3DA5256D (image_id), PRIMARY KEY(customers_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_customers (image_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_BAD195753DA5256D (image_id), INDEX IDX_BAD19575C3568B40 (customers_id), PRIMARY KEY(image_id, customers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customers_image ADD CONSTRAINT FK_F6DD677AC3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customers_image ADD CONSTRAINT FK_F6DD677A3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_customers ADD CONSTRAINT FK_BAD195753DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_customers ADD CONSTRAINT FK_BAD19575C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F9395C3F3');
        $this->addSql('DROP INDEX IDX_C53D045F9395C3F3 ON image');
        $this->addSql('ALTER TABLE image DROP customer_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_image DROP FOREIGN KEY FK_F6DD677AC3568B40');
        $this->addSql('ALTER TABLE customers_image DROP FOREIGN KEY FK_F6DD677A3DA5256D');
        $this->addSql('ALTER TABLE image_customers DROP FOREIGN KEY FK_BAD195753DA5256D');
        $this->addSql('ALTER TABLE image_customers DROP FOREIGN KEY FK_BAD19575C3568B40');
        $this->addSql('DROP TABLE customers_image');
        $this->addSql('DROP TABLE image_customers');
        $this->addSql('ALTER TABLE image ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C53D045F9395C3F3 ON image (customer_id)');
    }
}
