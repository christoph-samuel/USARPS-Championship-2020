DROP DATABASE IF EXISTS usarps_db;

CREATE DATABASE IF NOT EXISTS usarps_db;

use usarps_db;


CREATE TABLE IF NOT EXISTS tournament (
    pk_tournament_year INT PRIMARY KEY,
    date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS game_round (
    pk_round_nr INT PRIMARY KEY
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
    fk_pk_round_nr INT,
    fk_pk_symbol VARCHAR(20),

    CONSTRAINT fk_pk_round_nr_symbol FOREIGN KEY (fk_pk_round_nr) REFERENCES game_round (pk_round_nr) ON DELETE SET NULL,
    CONSTRAINT fk_pk_symbol FOREIGN KEY (fk_pk_symbol) REFERENCES symbol (pk_symbol) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS participant_takes_part_game_round (
    fk_pk_round_nr INT,
    fk_pk_participant_id INT,

    CONSTRAINT fk_pk_round_nr_participant FOREIGN KEY (fk_pk_round_nr) REFERENCES game_round (pk_round_nr) ON DELETE SET NULL,
    CONSTRAINT fk_pk_participant_id FOREIGN KEY (fk_pk_participant_id) REFERENCES participant (pk_participant_id) ON DELETE SET NULL
);


INSERT INTO tournament (pk_tournament_year, date)
VALUES (2020, '2008-03-09');

INSERT INTO game_round (pk_round_nr)
VALUES (1),
       (2),
       (3),
       (4),
       (5);

INSERT INTO participant (pk_participant_id, first_name, last_name)
VALUES (1, 'Toni', 'Divkovic'),
       (2, 'Christoph', 'Samuel'),
       (3, 'Jeremiasz', 'Zrolka'),
       (4, 'Nico', 'Naumann');

INSERT INTO symbol (pk_symbol)
VALUES ('Stein'),
       ('Papier'),
       ('Schere');

INSERT INTO game_round_selects_symbol (fk_pk_round_nr, fk_pk_symbol)
VALUES (1, 'Stein'),
       (1, 'Schere'),

       (2, 'Papier'),
       (2, 'Stein'),

       (3, 'Schere'),
       (3, 'Papier'),

       (4, 'Papier'),
       (4, 'Schere'),

       (5, 'Stein'),
       (5, 'Papier');

INSERT INTO participant_takes_part_game_round (fk_pk_round_nr, fk_pk_participant_id)
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