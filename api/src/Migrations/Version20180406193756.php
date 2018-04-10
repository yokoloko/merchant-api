<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180406193756 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $commission = <<<'SQL'
CREATE TABLE IF NOT EXISTS `commission` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `cashback` DECIMAL(10,2) NOT NULL,
  `idMerchant` INT(11) NOT NULL,
  `idUser` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idMerchant` (`idMerchant`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;
SQL;

        $merchant = <<<'SQL'
CREATE TABLE IF NOT EXISTS `merchant` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
SQL;

        $user = <<<'SQL'
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `profileUrl` varchar(255) DEFAULT NULL,
  `lastLogin` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
SQL;

        $constraints = <<<'SQL'
ALTER TABLE `commission`
  ADD CONSTRAINT `commission_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `commission_ibfk_1` FOREIGN KEY (`idMerchant`) REFERENCES `merchant` (`id`);
SQL;

        $this->addSql('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
        $this->addSql('SET time_zone = "+00:00"');
        $this->addSql($commission);
        $this->addSql($merchant);
        $this->addSql($user);
        $this->addSql($constraints);
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE `user`");
        $this->addSql("DROP TABLE `merchant`");
        $this->addSql("DROP TABLE `commission`");
    }
}
