<?php

require("game.php");

class Games {

    private $data;
    private $game;

    function Games($obj) {
        $this->data = $obj;

        $this->game = array();


        foreach ($this->data->games as $val) {
            $this->game[] = new Game($val);
        }
    }

    function GetGameCount() {
        return $this->data->game_count;
    }

    function GetGamesNotPlayedCount() {
        $count = 0;
        foreach ($this->game as $game) {
            if ($game->GetPlayTimeForever() <= 0)
                $count++;
        }
        return $count;
    }

    function GetRecentPlayedGamesCount() {
        $count = 0;
        foreach ($this->game as $game) {
            if ($game->GetPlayTimeForever() <= 0)
                continue;

            if ($game->GetPlayTimeTwoWeeks() <= 0)
                continue;

            $count++;
        }
        return $count;
    }

    function PlayTimeTwoWeeksSort($a, $b) {
        return ($a->GetPlayTimeTwoWeeks() == $b->GetPlayTimeTwoWeeks()) ? 0 : ($a->GetPlayTimeTwoWeeks() < $b->GetPlayTimeTwoWeeks()) ? 1 : -1;
    }

    function GetGameByAppId($app_id) {
        foreach ($this->game as $game) {
            if ($game->GetAppId() == $app_id) {
                return $game;
                break;
            }
        }
        return null;
    }

    function GetRecentPlayedGames($max) {

        $games = array();
        $count = 0;
        foreach ($this->game as $game) {
            if ($game->GetPlayTimeForever() <= 0)
                continue;

            if ($game->GetPlayTimeTwoWeeks() <= 0)
                continue;

            if (strlen($game->GetName()) > 32)
                $game->SetName(substr($game->GetName(), 0, 30) . '..');

            $games[] = $game;
            $count++;
        }
        usort($games, array('Games', 'PlayTimeTwoWeeksSort'));
        $max = ($count < $max) ? $count : $max;
        return array_slice($games, 0, $max);
    }

    function GetGamesNotPlayedPercentage() {
        return round(($this->GetGamesNotPlayedCount() / $this->GetGameCount()) * 100);
    }

}
