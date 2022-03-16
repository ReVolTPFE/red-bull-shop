<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315080454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2246507B4584665A');
        $this->addSql('DROP INDEX IDX_2246507BA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__basket AS SELECT id, user_id, product_id, quantity, bought FROM basket');
        $this->addSql('DROP TABLE basket');
        $this->addSql('CREATE TABLE basket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, bought BOOLEAN NOT NULL, CONSTRAINT FK_2246507BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2246507B4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO basket (id, user_id, product_id, quantity, bought) SELECT id, user_id, product_id, quantity, bought FROM __temp__basket');
        $this->addSql('DROP TABLE __temp__basket');
        $this->addSql('CREATE INDEX IDX_2246507B4584665A ON basket (product_id)');
        $this->addSql('CREATE INDEX IDX_2246507BA76ED395 ON basket (user_id)');
        $this->addSql('DROP INDEX IDX_CDFC735612469DE2');
        $this->addSql('DROP INDEX IDX_CDFC73564584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_category AS SELECT product_id, category_id FROM product_category');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('CREATE TABLE product_category (product_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(product_id, category_id), CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product_category (product_id, category_id) SELECT product_id, category_id FROM __temp__product_category');
        $this->addSql('DROP TABLE __temp__product_category');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2246507BA76ED395');
        $this->addSql('DROP INDEX IDX_2246507B4584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__basket AS SELECT id, user_id, product_id, quantity, bought FROM basket');
        $this->addSql('DROP TABLE basket');
        $this->addSql('CREATE TABLE basket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, bought BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO basket (id, user_id, product_id, quantity, bought) SELECT id, user_id, product_id, quantity, bought FROM __temp__basket');
        $this->addSql('DROP TABLE __temp__basket');
        $this->addSql('CREATE INDEX IDX_2246507BA76ED395 ON basket (user_id)');
        $this->addSql('CREATE INDEX IDX_2246507B4584665A ON basket (product_id)');
        $this->addSql('DROP INDEX IDX_CDFC73564584665A');
        $this->addSql('DROP INDEX IDX_CDFC735612469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_category AS SELECT product_id, category_id FROM product_category');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('CREATE TABLE product_category (product_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('INSERT INTO product_category (product_id, category_id) SELECT product_id, category_id FROM __temp__product_category');
        $this->addSql('DROP TABLE __temp__product_category');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
    }
}
