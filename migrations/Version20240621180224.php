<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621180224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE collection_game CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE personal_note personal_note LONGTEXT NOT NULL, CHANGE added_date added_date DATE NOT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE game_id game_id INT NOT NULL');
        $this->addSql('ALTER TABLE game DROP user, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE genre genre VARCHAR(255) NOT NULL, CHANGE developer developer VARCHAR(255) NOT NULL, CHANGE release_date release_date DATE NOT NULL, CHANGE platform platform VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL COMMENT \'Primary Key\', username VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE collection_game CHANGE id id INT AUTO_INCREMENT NOT NULL COMMENT \'Primary Key\', CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE personal_note personal_note TEXT DEFAULT NULL, CHANGE added_date added_date DATE DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE game_id game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD user VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL COMMENT \'Primary Key\', CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE genre genre VARCHAR(255) DEFAULT NULL, CHANGE developer developer VARCHAR(255) DEFAULT NULL, CHANGE release_date release_date DATE DEFAULT NULL, CHANGE platform platform VARCHAR(255) DEFAULT NULL');
    }
}
