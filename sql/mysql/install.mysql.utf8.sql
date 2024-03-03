CREATE TABLE IF NOT EXISTS `#__nxd_themeswitcher`
(
    `id`       INT(11)    NOT NULL AUTO_INCREMENT,
    `user_id`  INT(11)    NOT NULL,
    `use_dark` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;