DROP DATABASE IF EXISTS usarps_db;

CREATE DATABASE IF NOT EXISTS usarps_db;

use usarps_db;


CREATE TABLE IF NOT EXISTS tournament (
    pk_tournament_year INT PRIMARY KEY,
    date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS game_round (
    pk_round_id INT PRIMARY KEY AUTO_INCREMENT,
    round_nr INT NOT NULL,
    fk_pk_tournament_year INT NOT NULL,

    CONSTRAINT fk_pk_tournament_year FOREIGN KEY(fk_pk_tournament_year) REFERENCES tournament(pk_tournament_year) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS symbol (
    pk_symbol VARCHAR(20) PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS participant (
    pk_participant_id INT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS game_round_selects_symbol (
    fk_pk_round_id INT,
    fk_pk_symbol VARCHAR(20),

    CONSTRAINT fk_pk_round_id_symbol FOREIGN KEY (fk_pk_round_id) REFERENCES game_round (pk_round_id) ON DELETE SET NULL,
    CONSTRAINT fk_pk_symbol FOREIGN KEY (fk_pk_symbol) REFERENCES symbol (pk_symbol) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS participant_takes_part_game_round (
    fk_pk_round_id INT,
    fk_pk_participant_id INT,

    CONSTRAINT fk_pk_round_nr_participant FOREIGN KEY (fk_pk_round_id) REFERENCES game_round (pk_round_id) ON DELETE SET NULL,
    CONSTRAINT fk_pk_participant_id FOREIGN KEY (fk_pk_participant_id) REFERENCES participant (pk_participant_id) ON DELETE SET NULL
);


INSERT INTO tournament (pk_tournament_year, date)
VALUES (2020, '2008-03-09'),
       (2021, '2010-01-06');

INSERT INTO game_round (pk_round_id, round_nr, fk_pk_tournament_year)
VALUES (1, 1, 2020),
       (2, 2, 2020),
       (3, 3, 2020),
       (4, 4, 2020),
       (5, 5, 2020);

INSERT INTO participant (pk_participant_id, first_name, last_name)
VALUES (1, 'Toni', 'Divkovic'),
       (2, 'Christoph', 'Samuel'),
       (3, 'Jeremiasz', 'Zrolka'),
       (4, 'Nico', 'Naumann');

INSERT INTO symbol (pk_symbol)
VALUES ('Stein'),
       ('Papier'),
       ('Schere');

INSERT INTO game_round_selects_symbol (fk_pk_round_id, fk_pk_symbol)
VALUES (1, 'Stein'),
       (1, 'Schere'),

       (2, 'Papier'),
       (2, 'Stein'),

       (3, 'Schere'),
       (3, 'Schere'),

       (4, 'Papier'),
       (4, 'Schere'),

       (5, 'Stein'),
       (5, 'Papier');

INSERT INTO participant_takes_part_game_round (fk_pk_round_id, fk_pk_participant_id)
VALUES (1, 2),
       (1, 1),

       (2, 3),
       (2, 4),

       (3, 4),
       (3, 1),

       (4, 2),
       (4, 1),

       (5, 2),
       (5, 3);