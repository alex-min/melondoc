ALTER TABLE `documents` ADD `user_id` INT NOT NULL AFTER `id_document`;
ALTER TABLE `documents` ADD `nom` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `documents` ADD `deleted` TINYINT NOT NULL;
ALTER TABLE `users` ADD `deleted` TINYINT NOT NULL ;