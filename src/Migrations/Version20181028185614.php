<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181028185614 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE share (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, toern_id INT NOT NULL, INDEX IDX_EF069D5AA76ED395 (user_id), INDEX IDX_EF069D5AA914CD5B (toern_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5AA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5AA914CD5B FOREIGN KEY (toern_id) REFERENCES toern (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE share');
    }
}
