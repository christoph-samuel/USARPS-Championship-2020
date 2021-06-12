<?php
require_once __DIR__ . '/../vendor/autoload.php';

function changeDate($date): string
{
    $date = explode("-", $date);
    return "$date[2].$date[1].$date[0]";
}

function getConn()
{
    $connectionParams = array(
        "dbname" => "usarps_db",
        "user" => "root",
        "password" => "",
        "host" => "localhost",
        "driver" => "pdo_mysql",
    );
    return \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
}

function select($stmt)
{
    $sql = getConn()->prepare($stmt);
    $sql = $sql->executeQuery();

    try {
        return $sql->fetchAllAssociative();
    } catch (Exception $ex) {
        return $ex;
    }
}

function getSymbol($symbol)
{
    switch ($symbol) {
        case "Schere":
            return "images/scissors.png";
        case "Stein":
            return "images/rock.png";
        case "Papier":
            return "images/paper.png";
        default:
            echo "Symbol unknown!";
            return "";
    }
}

// Insert tournament
function insertTournament($year, $date)
{
    $queryBuilder = getConn()->createQueryBuilder();

    $queryBuilder
        ->insert('tournament')
        ->values(array(
                'pk_tournament_year' => '?',
                'date' => '?')
        )
        ->setParameter(0, $year)
        ->setParameter(1, $date);
    $queryBuilder->execute();
}

// Insert Game Round
function insertGameRound($roundNr, $tournament, $participant1, $participant2, $symbol1, $symbol2)
{
    // Insert new Round Nr in "game_round"
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('game_round')
        ->values(array(
            'round_nr' => '?',
            'fk_pk_tournament_year' => '?'
        ))
        ->setParameter(0, $roundNr)
        ->setParameter(1, $tournament);
    $queryBuilder->execute();

    // Get New Round ID (Auto Increment in database)
    $sql = select("SELECT * FROM game_round");
    $id = $sql[sizeof($sql) - 1]['pk_round_id'];

    // Insert first Participant of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('participant_takes_part_game_round')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_participant_id' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $participant1);
    $queryBuilder->execute();

    // Insert second Participant of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('participant_takes_part_game_round')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_participant_id' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $participant2);
    $queryBuilder->execute();

    // Insert first Symbol of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('game_round_selects_symbol')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_symbol' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $symbol1);
    $queryBuilder->execute();

    // Insert second Symbol of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('game_round_selects_symbol')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_symbol' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $symbol2);
    $queryBuilder->execute();
}

// Insert Participant
function insertParticipant($firstName, $lastName)
{
    $queryBuilder = getConn()->createQueryBuilder();

    $queryBuilder
        ->insert('participant')
        ->values(array(
                'first_name' => '?',
                'last_name' => '?')
        )
        ->setParameter(0, $firstName)
        ->setParameter(1, $lastName);
    $queryBuilder->execute();
}


// Delete tournament
function deleteTournament($year)
{
    $queryBuilder = getConn()->createQueryBuilder();

    $queryBuilder
        ->delete('tournament')
        ->where('pk_tournament_year = ?')
        ->setParameter(0, $year);
    $queryBuilder->execute();
}

// Delete Game Round
function deleteGameRound($roundID)
{
    $queryBuilder = getConn()->createQueryBuilder();

    $queryBuilder
        ->delete('game_round')
        ->where('pk_round_id = ?')
        ->setParameter(0, $roundID);
    $queryBuilder->execute();
}

// Delete Participant
function deleteParticipant($participantID)
{
    $queryBuilder = getConn()->createQueryBuilder();

    $queryBuilder
        ->delete('participant')
        ->where('pk_participant_id = ?')
        ->setParameter(0, $participantID);
    $queryBuilder->execute();
}