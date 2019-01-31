<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190131102713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task CHANGE TaskDate TaskDate DATETIME NOT NULL');
        $this->addSql('DROP INDEX IDX_FE2042328DB60186 ON task_user');
        $this->addSql('DROP INDEX IDX_FE204232A76ED395 ON task_user');
        $this->addSql('ALTER TABLE task_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE task_user ADD id_task INT NOT NULL, ADD id_user INT NOT NULL, DROP task_id, DROP user_id');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE204232D95EC727 FOREIGN KEY (id_task) REFERENCES task (id_task)');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE2042326B3CA4B FOREIGN KEY (id_user) REFERENCES User (id_user)');
        $this->addSql('CREATE INDEX IDX_FE204232D95EC727 ON task_user (id_task)');
        $this->addSql('CREATE INDEX IDX_FE2042326B3CA4B ON task_user (id_user)');
        $this->addSql('ALTER TABLE task_user ADD PRIMARY KEY (id_task, id_user)');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user CHANGE id id_user INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id_user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task CHANGE TaskDate TaskDate DATE NOT NULL');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE204232D95EC727');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE2042326B3CA4B');
        $this->addSql('DROP INDEX IDX_FE204232D95EC727 ON task_user');
        $this->addSql('DROP INDEX IDX_FE2042326B3CA4B ON task_user');
        $this->addSql('ALTER TABLE task_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE task_user ADD task_id INT NOT NULL, ADD user_id INT NOT NULL, DROP id_task, DROP id_user');
        $this->addSql('CREATE INDEX IDX_FE2042328DB60186 ON task_user (task_id)');
        $this->addSql('CREATE INDEX IDX_FE204232A76ED395 ON task_user (user_id)');
        $this->addSql('ALTER TABLE task_user ADD PRIMARY KEY (task_id, user_id)');
        $this->addSql('ALTER TABLE User MODIFY id_user INT NOT NULL');
        $this->addSql('ALTER TABLE User DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE User CHANGE id_user id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE User ADD PRIMARY KEY (id)');
    }
}
