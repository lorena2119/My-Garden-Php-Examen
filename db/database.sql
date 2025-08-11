
CREATE DATABASE IF NOT EXISTS `garden`;

USE `garden`;

DROP TABLE IF EXISTS `riegos`;

CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
);
CREATE TABLE `plantas` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre_comun` varchar(100) NOT NULL,
    `familia` varchar(100) NOT NULL,
    `categoria` ENUM('cactus', 'ornamental', 'frutal') NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `nombre_comun` (`nombre_comun`)
);

CREATE TABLE `riegos` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_planta` int NOT NULL,
    `frecuencia_riego` int NOT NULL,
    `fecha_riego` varchar(100) NOT NULL,
    `proximo_riego` TIMESTAMP,
    FOREIGN KEY fk_planta_riego (id_planta) REFERENCES `plantas`(id),
    PRIMARY KEY (`id`)
);
INSERT INTO
    `plantas` (`nombre_comun`, `familia`, `categoria`)
VALUES (
        'Aloe Vera',
        'Asphodelaceae',
        'cactus'
    );
INSERT INTO
    `riegos` (`id_planta`, `frecuencia_riego`, `fecha_riego`)
VALUES (
        '1',
        '10',
        '11-08-2025'
    );
INSERT INTO
    `users` (`name`, `email`, `password`)
VALUES (
        'adrian',
        'adrian@gmail.com',
        SHA2('h3ll0.', 512)
    );

INSERT INTO
    `users` (`name`, `email`, `password`)
VALUES (
        'ana',
        'ana@gmail.com',
        SHA2('h3ll0.', 512)
    );

