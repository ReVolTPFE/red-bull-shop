<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308143356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2246507BA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__basket AS SELECT id, user_id, quantity, bought FROM basket');
        $this->addSql('DROP TABLE basket');
        $this->addSql('CREATE TABLE basket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, quantity INTEGER NOT NULL, bought BOOLEAN NOT NULL, CONSTRAINT FK_2246507BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO basket (id, user_id, quantity, bought) SELECT id, user_id, quantity, bought FROM __temp__basket');
        $this->addSql('DROP TABLE __temp__basket');
        $this->addSql('CREATE INDEX IDX_2246507BA76ED395 ON basket (user_id)');
        $this->addSql('DROP INDEX IDX_17ED14B44584665A');
        $this->addSql('DROP INDEX IDX_17ED14B41BE1FB52');
        $this->addSql('CREATE TEMPORARY TABLE __temp__basket_product AS SELECT basket_id, product_id FROM basket_product');
        $this->addSql('DROP TABLE basket_product');
        $this->addSql('CREATE TABLE basket_product (basket_id INTEGER NOT NULL, product_id INTEGER NOT NULL, PRIMARY KEY(basket_id, product_id), CONSTRAINT FK_17ED14B41BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_17ED14B44584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO basket_product (basket_id, product_id) SELECT basket_id, product_id FROM __temp__basket_product');
        $this->addSql('DROP TABLE __temp__basket_product');
        $this->addSql('CREATE INDEX IDX_17ED14B44584665A ON basket_product (product_id)');
        $this->addSql('CREATE INDEX IDX_17ED14B41BE1FB52 ON basket_product (basket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2246507BA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__basket AS SELECT id, user_id, quantity, bought FROM basket');
        $this->addSql('DROP TABLE basket');
        $this->addSql('CREATE TABLE basket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, quantity INTEGER NOT NULL, bought BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO basket (id, user_id, quantity, bought) SELECT id, user_id, quantity, bought FROM __temp__basket');
        $this->addSql('DROP TABLE __temp__basket');
        $this->addSql('CREATE INDEX IDX_2246507BA76ED395 ON basket (user_id)');
        $this->addSql('DROP INDEX IDX_17ED14B41BE1FB52');
        $this->addSql('DROP INDEX IDX_17ED14B44584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__basket_product AS SELECT basket_id, product_id FROM basket_product');
        $this->addSql('DROP TABLE basket_product');
        $this->addSql('CREATE TABLE basket_product (basket_id INTEGER NOT NULL, product_id INTEGER NOT NULL, PRIMARY KEY(basket_id, product_id))');
        $this->addSql('INSERT INTO basket_product (basket_id, product_id) SELECT basket_id, product_id FROM __temp__basket_product');
        $this->addSql('DROP TABLE __temp__basket_product');
        $this->addSql('CREATE INDEX IDX_17ED14B41BE1FB52 ON basket_product (basket_id)');
        $this->addSql('CREATE INDEX IDX_17ED14B44584665A ON basket_product (product_id)');
    }
}
