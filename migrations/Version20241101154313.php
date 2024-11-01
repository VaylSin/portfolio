<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241101154313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_customers DROP FOREIGN KEY FK_BAD195753DA5256D');
        $this->addSql('ALTER TABLE image_customers DROP FOREIGN KEY FK_BAD19575C3568B40');
        $this->addSql('ALTER TABLE image_project DROP FOREIGN KEY FK_BAA38732166D1F9C');
        $this->addSql('ALTER TABLE image_project DROP FOREIGN KEY FK_BAA387323DA5256D');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC1166D1F9C');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC13DA5256D');
        $this->addSql('DROP TABLE image_customers');
        $this->addSql('DROP TABLE image_project');
        $this->addSql('DROP TABLE project_image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_customers (image_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_BAD195753DA5256D (image_id), INDEX IDX_BAD19575C3568B40 (customers_id), PRIMARY KEY(image_id, customers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image_project (image_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_BAA38732166D1F9C (project_id), INDEX IDX_BAA387323DA5256D (image_id), PRIMARY KEY(image_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE project_image (project_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_D6680DC1166D1F9C (project_id), INDEX IDX_D6680DC13DA5256D (image_id), PRIMARY KEY(project_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image_customers ADD CONSTRAINT FK_BAD195753DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_customers ADD CONSTRAINT FK_BAD19575C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_project ADD CONSTRAINT FK_BAA38732166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_project ADD CONSTRAINT FK_BAA387323DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC1166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC13DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
