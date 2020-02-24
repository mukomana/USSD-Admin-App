<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213095026 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY subject_ibfk_1');
        $this->addSql('ALTER TABLE subject CHANGE name name VARCHAR(64) NOT NULL, CHANGE exam_mark exam_mark INT NOT NULL, CHANGE final_mark final_mark INT NOT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7ACB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE subject RENAME INDEX student_id TO IDX_FBCE3E7ACB944F1A');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7ACB944F1A');
        $this->addSql('ALTER TABLE subject CHANGE name name VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE exam_mark exam_mark INT DEFAULT NULL, CHANGE final_mark final_mark INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT subject_ibfk_1 FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE CASCADE');
        $this->addSql('ALTER TABLE subject RENAME INDEX idx_fbce3e7acb944f1a TO student_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
