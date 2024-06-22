<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240622110607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE newsletter_subscription (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection_game CHANGE personal_note personal_note LONGTEXT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_695C1D62A76ED395 ON collection_game (user_id)');
        $this->addSql('CREATE INDEX IDX_695C1D62E48FD905 ON collection_game (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_game DROP FOREIGN KEY FK_695C1D62A76ED395');
        $this->addSql('DROP TABLE newsletter_subscription');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE collection_game DROP FOREIGN KEY FK_695C1D62E48FD905');
        $this->addSql('DROP INDEX IDX_695C1D62A76ED395 ON collection_game');
        $this->addSql('DROP INDEX IDX_695C1D62E48FD905 ON collection_game');
        $this->addSql('ALTER TABLE collection_game CHANGE personal_note personal_note LONGTEXT NOT NULL');
    }
}
