<?php

class Profile {

    private $data;

    function Profile($obj) {
        $this->data = $obj;
    }

    function GetPersonaName() {
        return $this->data->personaname;
    }

    function GetPersonaState() {

        if ($this->IsInGame())
            return 'In-Game';

        switch ($this->data->personastate) {
            case 0:
                return 'Offline';
                break;
            case 1:
                return 'Online';
                break;
            case 2:
                return 'Busy';
                break;
            case 3:
                return 'Away';
                break;
            case 4:
                return 'Snooze';
                break;
            case 5:
                return 'Looking to Trade';
                break;
            case 6:
                return 'Looking to Play';
                break;
            default:
                return 'Offline';
                break;
        }
    }

    function GetPersonaStateColor() {

        if ($this->IsInGame())
            return '#83B359';

        switch ($this->data->personastate) {
            case 0:
                return '#808080';
                break;
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                return '#4787A0';
                break;
            default:
                return '#808080';
                break;
        }
    }

    function IsInGame() {
        return isset($this->data->gameid) ? true : false;
    }

    function GetGameId() {
        return $this->data->gameid;
    }

    function GetProfileUrl() {
        return $this->data->profileurl;
    }

    function GetAvatar() {
        return $this->data->avatar;
    }

    function GetAvatarMedium() {
        return $this->data->avatarmedium;
    }

    function GetCountryCode() {
        return isset($this->data->loccountrycode) ? $this->data->loccountrycode : '';
    }

    function GetPrimaryClanId() {
        return isset($this->data->primaryclanid) ? $this->data->primaryclanid : 0;
    }

    function GetTimeCreated($format) {
        return isset($this->data->timecreated) ? date($format, $this->data->timecreated) : '';
    }

    function GetLastLogOff() {
        return isset($this->data->lastlogoff) ? $this->data->lastlogoff : null;
    }

}
