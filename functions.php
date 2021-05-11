<?php
function changeDate($date) :String {
    $date = explode("-", $date);
    return "$date[2].$date[1].$date[0]";
}