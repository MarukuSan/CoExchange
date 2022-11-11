CREATE TABLE users (
    id INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    last_name VARCHAR(64),
    first_name VARCHAR(64) NOT NULL,
    email VARCHAR(64),
    telephone VARCHAR(20),
    password VARCHAR(100)
);

CREATE TABLE groups (
    id INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    owner_id INT(4) NOT NULL, 
    name VARCHAR(64) NOT NULL,
    FOREIGN KEY (owner_id) REFERENCES users(id)
);

CREATE TABLE users_groups (
    id INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id` INT(4) NOT NULL,
    group_id INT(4) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES users(id),
    FOREIGN KEY (group_id) REFERENCES groups(id)
);

CREATE TABLE expenses (
    id INT(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    group_id INT(4) NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    total FLOAT,
    FOREIGN KEY (group_id) REFERENCES groups(id)
);

CREATE TABLE users_expenses (
    id INT(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id` INT(4) NOT NULL,
    expense_id INT(5) NOT NULL,
    participation FLOAT NOT NULL DEFAULT 0,
    FOREIGN KEY (`user_id`) REFERENCES users(id),
    FOREIGN KEY (expense_id) REFERENCES expenses(id)
);

-- Example of users

INSERT INTO users VALUES (NULL, "TSHIBUABUA", "Kenny Exauce", NULL, NULL, NULL);
INSERT INTO users VALUES (NULL, "RASANDISON", "Marc", NULL, NULL, "testingcheat");
INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `telephone`) VALUES (NULL, 'CARTMAN', 'Eric', NULL, NULL);
INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `telephone`) VALUES (NULL, 'JÄGER', 'Eren', NULL, NULL);
INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `telephone`) VALUES (NULL, 'ACKERMAN', 'Mikasa', NULL, NULL);
INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `telephone`) VALUES (NULL, 'ARLELT', 'Armin', NULL, NULL);
INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `telephone`) VALUES (NULL, 'BRAUN', 'Reiner', NULL, NULL);
INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `telephone`) VALUES (NULL, 'LEONHART', 'Annie', NULL, NULL);


-- Example of a group

INSERT INTO groups VALUES (
    NULL,
    (
        SELECT id 
        FROM users 
        WHERE last_name = "RASANDISON"
        AND first_name = "Marc"
    ),
    "CoExchange"
);

INSERT INTO `groups` (`id`, `owner_id`, `name`) VALUES (NULL, '6', "Bataillon d\'exploration");
INSERT INTO `groups` (`id`, `owner_id`, `name`) VALUES (NULL, '7', 'Guerriers Mahrs');
INSERT INTO `groups` (`id`, `owner_id`, `name`) VALUES (NULL, '4', 'Titans');



-- Assignment of users to a group (user --> group)

INSERT INTO users_groups VALUES (
    NULL,
    (
        SELECT id
        FROM users
        WHERE last_name = "RASANDISON"
        AND first_name = "Marc"
    ),
    (
        SELECT id
        FROM groups
        WHERE `name` = "CoExchange"
    )
);

INSERT INTO users_groups VALUES (
    NULL,
    (
        SELECT id
        FROM users
        WHERE last_name = "TSHIBUABUA"
        AND first_name = "Kenny Exauce"
    ),
    (
        SELECT id
        FROM groups
        WHERE `name` = "CoExchange"
    )
);

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '4', '4');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '6', '4');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '7', '4');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '8', '4');

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '6', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '4', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '5', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '7', '2');

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '7', '3');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (NULL, '8', '3');


-- Example of an expense

INSERT INTO expenses VALUES (
    NULL,
    (
        SELECT id 
        FROM groups 
        WHERE name = "CoExchange"
    ),
    "Loyer local",
    500
);

INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '2', 'Transport', '2600');
INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '2', 'Loyer local', '1200');
INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '2', 'Entretien local', '460');
INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '2', 'Matériels de combat', '3180');

INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '3', 'Transport', '2100');
INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '3', 'Armes', '1000');
INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '3', 'Accessoires', '200');

INSERT INTO `expenses` (`id`, `group_id`, `name`, `total`) VALUES (NULL, '4', 'Boissons énergisantes', '400');

-- Assignment of expense to a user (expense --> user)

INSERT INTO users_expenses VALUES (
    NULL,
    (
        SELECT id 
        FROM users
        WHERE last_name = "RASANDISON"
        AND first_name = "Marc"
    ),
    (
        SELECT id 
        FROM expenses
        WHERE `id` = 1
    ),
    250
);

INSERT INTO users_expenses VALUES (
    NULL,
    (
        SELECT id 
        FROM users
        WHERE last_name = "TSHIBUABUA"
        AND first_name = "Kenny Exauce"
    ),
    (
        SELECT id 
        FROM expenses
        WHERE `id` = 1
    ),
    250
);