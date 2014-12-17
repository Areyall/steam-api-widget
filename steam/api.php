<?php

class Api {

    private $url;
    private $apiKey;
    private $steamId;
    private $data;

    function Api($key, $id) {
        $this->apiKey = $key;
        $this->steamId = $id;

        $this->url = array(
            'profile' => "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$this->apiKey}&steamids={$this->steamId}&format=json",
            'games' => "https://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key={$this->apiKey}&steamid={$this->steamId}&format=json&include_played_free_games=0&include_appinfo=1"
        );

        $this->data = null;
    }

    function GetData() {

        $this->data = $this->MultiRequest();

        if (!$this->data['profile'] || !$this->data['games'])
            return null;

        foreach ($this->data as $key => $val) {
            $this->data[$key] = json_decode($val);
        }

        $this->data['profile'] = $this->data['profile']->response->players[0];
        $this->data['games'] = $this->data['games']->response;

        return $this->data;
    }

    function MultiRequest() {


        $cmi = curl_multi_init();
        $curl = array();
        foreach ($this->url as $key => $val) {

            $curl[$key] = curl_init();

            curl_setopt($curl[$key], CURLOPT_URL, $val);
            curl_setopt($curl[$key], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl[$key], CURLOPT_FOLLOWLOCATION, false);
            curl_setopt($curl[$key], CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl[$key], CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl[$key], CURLOPT_HEADER, false);
            curl_setopt($curl[$key], CURLOPT_VERBOSE, false);

            curl_multi_add_handle($cmi, $curl[$key]);
        }

        do {

            $status = curl_multi_exec($cmi, $active);
        } while ($status === CURLM_CALL_MULTI_PERFORM || $active);

        $result = array();
        foreach ($curl as $id => $c) {

            $code = curl_getinfo($c, CURLINFO_HTTP_CODE);
            if ($code < 200 || $code > 206) {
                $result[$id] = null;
            } else {
                $result[$id] = curl_multi_getcontent($c);
            }
            curl_multi_remove_handle($cmi, $c);
        }

        curl_multi_close($cmi);
        return $result;
    }

}
