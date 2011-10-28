ALTER TABLE `radios_comunitarias` ADD licenca ENUM('definitiva', 'provisoria', 'sem');
UPDATE `radios_comunitarias` SET `licenca` = 'definitiva' WHERE `licenciado` = 1;
UPDATE `radios_comunitarias` SET `licenca` = 'provisoria' WHERE `licenciado` IS NULL;
UPDATE `radios_comunitarias` SET `licenca` = 'sem' WHERE `licenciado` = 0;
ALTER TABLE `radios_comunitarias` DROP licenciado;
