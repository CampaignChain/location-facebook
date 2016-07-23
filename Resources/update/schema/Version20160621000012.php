<?php
/*
 * Copyright 2016 CampaignChain, Inc. <info@campaignchain.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160621000012 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE campaignchain_location_facebook (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, identifier VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, displayName VARCHAR(255) DEFAULT NULL, firstName VARCHAR(255) DEFAULT NULL, lastName VARCHAR(255) DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, age SMALLINT DEFAULT NULL, birthday DATE DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, emailVerified VARCHAR(255) DEFAULT NULL, websiteUrl VARCHAR(255) DEFAULT NULL, profileUrl VARCHAR(255) DEFAULT NULL, profileImageUrl VARCHAR(255) DEFAULT NULL, coverInfoUrl VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, scope LONGTEXT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, about VARCHAR(255) DEFAULT NULL, coverId VARCHAR(255) DEFAULT NULL, coverSource VARCHAR(255) DEFAULT NULL, coverOffsetX SMALLINT DEFAULT NULL, coverOffsetY SMALLINT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, pictureUrl VARCHAR(255) DEFAULT NULL, isPublished TINYINT(1) DEFAULT NULL, canPost TINYINT(1) DEFAULT NULL, permissions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_745E1EFF772E836A (identifier), INDEX IDX_745E1EFF64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaignchain_location_facebook_user_page (page_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FED900CFC4663E4 (page_id), INDEX IDX_FED900CFA76ED395 (user_id), PRIMARY KEY(page_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campaignchain_location_facebook ADD CONSTRAINT FK_745E1EFF64D218E FOREIGN KEY (location_id) REFERENCES campaignchain_location (id)');
        $this->addSql('ALTER TABLE campaignchain_location_facebook_user_page ADD CONSTRAINT FK_FED900CFC4663E4 FOREIGN KEY (page_id) REFERENCES campaignchain_location_facebook (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaignchain_location_facebook_user_page ADD CONSTRAINT FK_FED900CFA76ED395 FOREIGN KEY (user_id) REFERENCES campaignchain_location_facebook (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaignchain_location_facebook_user_page DROP FOREIGN KEY FK_FED900CFC4663E4');
        $this->addSql('ALTER TABLE campaignchain_location_facebook_user_page DROP FOREIGN KEY FK_FED900CFA76ED395');
        $this->addSql('DROP TABLE campaignchain_location_facebook');
        $this->addSql('DROP TABLE campaignchain_location_facebook_user_page');
    }
}
