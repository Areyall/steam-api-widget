<?php

class Game {

    private $data;

    function Game($obj) {
        $this->data = $obj;
    }

    function GetAppId() {
        return $this->data->appid;
    }

    function GetName() {
        return $this->data->name;
    }

    function GetPlayTimeTwoWeeks() {
        return isset($this->data->playtime_2weeks) ? $this->data->playtime_2weeks : 0;
    }

    function GetPlayTimeForever() {
        return $this->data->playtime_forever;
    }

    function GetImgIconUrl() {
        return isset($this->data->img_icon_url) ? $this->data->img_icon_url : "";
    }

    function GetImgLogoUrl() {
        return isset($this->data->img_logo_url) ? $this->data->img_logo_url : "";
    }

    function HasCommunityVisibleStats() {
        return isset($this->data->has_community_visible_stats) ? $this->data->has_community_visible_stats : false;
    }

    function GetLink() {
        return "http://steamcommunity.com/app/{$this->GetAppId()}";
    }

    function GetHeader() {
        return "http://cdn.akamai.steamstatic.com/steam/apps/{$this->GetAppId()}/header.jpg";
    }

    function GetImage() {
        return "http://media.steampowered.com/steamcommunity/public/images/apps/{$this->GetAppId()}/{$this->GetImgIconUrl()}.jpg";
    }

    function SetName($name) {
        $this->data->name = $name;
    }

}
