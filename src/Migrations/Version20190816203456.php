<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816203456 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_tag (task_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_6C0B4F048DB60186 (task_id), INDEX IDX_6C0B4F04BAD26311 (tag_id), PRIMARY KEY(task_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT FK_6C0B4F048DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT FK_6C0B4F04BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE school ADD city_id INT NOT NULL, DROP city');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABB8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_F99EDABB8BAC62AF ON school (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school DROP FOREIGN KEY FK_F99EDABB8BAC62AF');
        $this->addSql('ALTER TABLE task_tag DROP FOREIGN KEY FK_6C0B4F04BAD26311');
        $this->addSql('ALTER TABLE task_tag DROP FOREIGN KEY FK_6C0B4F048DB60186');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_tag');
        $this->addSql('DROP INDEX IDX_F99EDABB8BAC62AF ON school');
        $this->addSql('ALTER TABLE school ADD city VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP city_id');
    }
}
