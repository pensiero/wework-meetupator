<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180718141652 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE venue ADD meetup_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE venue ADD CONSTRAINT FK_91911B0D591E2316 FOREIGN KEY (meetup_id) REFERENCES meetup (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_91911B0D591E2316 ON venue (meetup_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE venue DROP FOREIGN KEY FK_91911B0D591E2316');
        $this->addSql('DROP INDEX UNIQ_91911B0D591E2316 ON venue');
        $this->addSql('ALTER TABLE venue DROP meetup_id');
    }
}
