<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the ActiveQuery class for [[Roles]].
 *
 * @see Roles
 */
class WarcraftLogs extends Model
{
    private $base_url = 'https://www.warcraftlogs.com:443/v1';
    private $key_ident = '?api_key=';
    private $public_key = "966d115e65e8758778e2a5a2ef54f16e";
    /* For full description see: https://www.warcraftlogs.com/v1/docs/ */
    private $urls = [
        'classes' => ['url' => '/classes', 'options' => []],
        'rankings_encounter' => ['url' => '/rankings/encounter/%d', 'options' => ['encounterId', 'metric', 'size', 'difficulty', 'partitition', 'class', 'spec', 'bracket', 'limit', 'guild', 'server', 'region', 'page', 'filter']],
        'rankings_char' => ['url' => '/rankings/character/%s/%s/%s', 'options' => ['characterName', 'serverName', 'serverRegion', 'zone', 'encounter', 'metric', 'bracket', 'partition']],
        'parses_char' => ['url' => '/parses/character/%s/%s/%s', 'options' => ['characterName', 'serverName', 'serverRegion', 'zone', 'encounter', 'metric', 'bracket', 'compare', 'partition']],
        'reports_guild' => ['url' => '/reports/guild/%s/%s/%s', 'options' => ['guildName', 'serverName', 'serverRegion', 'start', 'end']],
        'reports_user' => ['url' => '/reports/user/%s', 'options' => ['userName', 'start', 'end']],
        'report_fight' => ['url' => '/report/fights/%s', 'options' => ['code', 'translate']],
        'report_events' => ['url' => '/report/events/%s', 'options' => ['code', 'start', 'end', 'actorid', 'actorinstance', 'actorclass', 'cutoff', 'encounter', 'wipes', 'difficulty', 'filter', 'translate']],
        'report_tables' => ['url' => '/report/tables/%s/%s', 'options' => ['view', 'code', 'start', 'end', 'hostility', 'by', 'sourceid', 'sourceinstance', 'targetclass', 'abilityid', 'options', 'cutoff', 'encounter', 'wipes', 'difficulty', 'filter', 'translate']]
    ];

    public function fetchGuildReports()
    {
        $built_url = "";

        $built_url = $this->base_url.$this->urls['reports_guild']['url'].$this->key_ident.$this->public_key."&start=".(strtotime('-1 month')*1000);
        $built_url = sprintf($built_url, urlencode("The Devil's Backbone"), urlencode("Turalyon"), urlencode("EU"));

        $logData = $this->getDataFromWarcraftLogs($built_url);

        return json_decode($logData);
    }

    private function getDataFromWarcraftLogs($url)
    {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HEADER, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $head = curl_exec($ch); 
        curl_close($ch);

        return $head;
    }
}