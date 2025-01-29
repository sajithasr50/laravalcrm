Task 1:
# laravalcrm
CRM larvel
Database: laravel_vot

Step 1: pull the files 
Step 2: php artisan migrate // migrate tables
Step 3: php artisan serve // for run the project
Step 4: For unit testing
php artisan test


Task 2:

Query optimisation 

Step 1: Add index

ALTER TABLE `leads` ADD INDEX idx_account_id_deleted_at (`account_id`, `deleted_at`), ADD INDEX idx_id (`id` DESC), ADD INDEX idx_organisation_id (`organisation_id`), ADD INDEX idx_team_id (`team_id`), ADD INDEX idx_planned_user_id (`planned_user_id`);

index idx_account_id_deleted_at is to increase speed of where condition
index idx_id to speed up ordering
index idx_organisation_id,idx_team_id,idx_planned_user_id for speed up join query

Step 2: Create new column for date_format 

ALTER TABLE `leads` ADD COLUMN `updated_created_at` VARCHAR(50), ADD COLUMN `updated_updated_at` VARCHAR(50), ADD COLUMN `updated_planned_date` VARCHAR(50), ADD COLUMN `updated_planned_from` VARCHAR(50), ADD COLUMN `updated_planned_to` VARCHAR(50);

Step3: Add trigger for insert and update to avoid date_format() in query

--
-- Triggers `leads`
--
DELIMITER $$
CREATE TRIGGER `on_insert_leads` BEFORE INSERT ON `leads` FOR EACH ROW BEGIN
    SET new.updated_created_at = DATE_FORMAT(new.created_at, "%d-%c-%Y %H:%i");
    SET new.updated_updated_at = DATE_FORMAT(new.updated_at, "%d-%c-%Y %H:%i");
    SET new.updated_planned_date = DATE_FORMAT(new.planned_date, "%d-%c-%Y");
    SET new.updated_planned_from = DATE_FORMAT(new.planned_from, "%H:%i");
    SET new.updated_planned_to = DATE_FORMAT(new.planned_to, "%H:%i");
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `on_update_leads` BEFORE UPDATE ON `leads` FOR EACH ROW BEGIN
    SET new.updated_created_at = DATE_FORMAT(new.created_at, "%d-%c-%Y %H:%i");
    SET new.updated_updated_at = DATE_FORMAT(new.updated_at, "%d-%c-%Y %H:%i");
    SET new.updated_planned_date = DATE_FORMAT(new.planned_date, "%d-%c-%Y");
    SET new.updated_planned_from = DATE_FORMAT(new.planned_from, "%H:%i");
    SET new.updated_planned_to = DATE_FORMAT(new.planned_to, "%H:%i");
END
$$
DELIMITER ;


and the Optimised Query will be

SELECT `leads`.`id`, `leads`.`firstname`, `leads`.`lastname`, `leads`.`gender`, `leads`.`company_name`, `leads`.`business`, `leads`.`streetname`, `leads`.`housenumber`, `leads`.`suffix`, `leads`.`postcode`, `leads`.`city`, `leads`.`status`, `leads`.`organisation_id`, `leads`.`team_id`, `leads`.`planned_user_id`, `leads`.`created_by`, `leads`.`updated_created_at` AS `created_datetime`, `leads`.`updated_updated_at` AS `updated_datetime`, `leads`.`updated_planned_date` AS `planned_date_formatted`, `leads`.`updated_planned_from` AS `planned_from_time`, `leads`.`updated_planned_to` AS `planned_to_time` FROM `leads` WHERE `leads`.`account_id` = 1 AND `leads`.`deleted_at` IS NULL ORDER BY `leads`.`id` DESC LIMIT 100;


