ALTER TABLE `documents` ADD `user_id` INT NOT NULL AFTER `id_document`;
ALTER TABLE `documents` ADD `nom` VARCHAR( 255 ) NOT NULL;
ALTER TABLE `documents` ADD `deleted` TINYINT NOT NULL;
ALTER TABLE `users` ADD `deleted` TINYINT NOT NULL;
ALTER TABLE `templates` ADD `template_image` VARCHAR( 255 ) NOT NULL;
ALTER TABLE `documents` DROP `path_template`;
ALTER TABLE `documents` ADD `template_id` INT NOT NULL;
ALTER TABLE `categories` ADD `avatar` VARCHAR( 255 ) NOT NULL;
ALTER TABLE `templates` ADD `categorie_id` INT NOT NULL;