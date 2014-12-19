<?php

class Profile {

    private $data;

    function Profile($obj) {
        $this->data = $obj;
    }

	/* 
	 * Private Data
	 */
	function GetRealName() {
		return isset($this->data->realname) ? $this->data->realname : "";
	}
	
	function GetPrimaryClanId() {
		return isset($this->data->primaryclanid) ? $this->data->primaryclanid : -1;
	}
	
	function GetTimeCreated($format) {
        return isset($this->data->timecreated) ? date($format, $this->data->timecreated) : "";
    }

    function GetGameId() {
        return isset($this->data->gameid) ? $this->data->gameid : -1;
    }
	
	function IsInGame() {
        return isset($this->data->gameid) ? true : false;
    }
	
	function GetGameServerIp() {
        return isset($this->data->gameserverip) ? $this->data->gameserverip : "";
    }
	
	function GetGameExtraInfo() {
		return isset($this->data->gameextrainfo) ? $this->data->gameextrainfo : "";
	}
	
	function GetCountryCode() {
        return isset($this->data->loccountrycode) ? $this->data->loccountrycode : "";
    }


	/*
	 * Public Data
	 */
	function GetSteamId() {
		return $this->data->steamid;
	}
	
	function GetPersonaName() {
        return $this->data->personaname;
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
	
	function GetAvatarFull() {
        return $this->data->avatarfull;
    }
	
	function GetPersonaState() {

        if ($this->IsInGame())
            return "In-Game";

        switch ($this->data->personastate) {
            case 0:
                return "Offline";
                break;
            case 1:
                return "Online";
                break;
            case 2:
                return "Busy";
                break;
            case 3:
                return "Away";
                break;
            case 4:
                return "Snooze";
                break;
            case 5:
                return "Looking to Trade";
                break;
            case 6:
                return "Looking to Play";
                break;
            default:
                return "Offline";
                break;
        }
    }

    function GetPersonaStateColor() {

        if ($this->IsInGame())
            return "#83B359";

        switch ($this->data->personastate) {
            case 0:
                return "#808080";
                break;
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                return "#4787A0";
                break;
            default:
                return "#808080";
                break;
        }
    }

    function GetLastLogOff($format) {
        return isset($this->data->lastlogoff) ? date($format, $this->data->lastlogoff) : "";
    }


}
