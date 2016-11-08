ALTER TABLE `Newsletter` DROP `shippingDate`;
ALTER TABLE `Newsletter` DROP `dateToSend`;

ALTER TABLE `Newsletter` ADD `dateToSend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `Newsletter` ADD `shippingDate` timestamp NOT NULL;