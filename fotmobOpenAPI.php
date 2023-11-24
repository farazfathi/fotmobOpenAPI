<?php
class fotmobOpenAPI
{
        public function setTimeZone(string $timezone =  'Asia/Tehran')
        {
                $this->timeZone = $timezone;
        }
        public function setCountryCode(string $country_code =  'IRA')
        {
                $this->countryCode = $country_code;
        }
        private function req(string $url, array $params = []): array
        {
                $param_string = (count($params) == 0) ? "" : "?";
                $param_value = [];
                foreach ($params as $k => $p) $param_value[] = "{$k}={$p}";
                $param_string .= join("&", $param_value);
                return json_decode(file_get_contents($url . $param_string), true, 2147483647);
        }
        public function matches(string $date = 'today', array $countries = []): array
        {
                $check_country = (count($countries) == 0) ? false : true;
                if ($date == 'today') {
                        $datex = explode("-", date("Y-m-d"));
                        foreach ($datex as $k => $d) if (strlen($d) == 1) $datex[$k] = "0{$d}";
                        $date = join("", array_values($datex));
                }
                $p = ['date' => $date];
                if (isset($this->timeZone)) $p['timezone'] = $this->timeZone;
                if (isset($this->countryCode)) $p['ccode3'] = $this->countryCode;
                $matches = $this->req("https://www.fotmob.com/api/matches", $p)['leagues'];
                if ($check_country) {
                        $c_ids = [];
                        $l_ids = [];
                        foreach ($countries as $c) if (is_string($c)) $c_ids[] = $c;
                        else $l_ids[] = $c;
                        foreach ($matches as $k => $m) if (!in_array($m['ccode'], $c_ids) && !in_array($m['primaryId'], $l_ids)) unset($matches[$k]);
                }
                return $matches;
        }
        public function match(string $id): array
        {
                $p = ['matchId' => $id];
                if (isset($this->timeZone)) $p['timezone'] = $this->timeZone;
                if (isset($this->countryCode)) $p['ccode3'] = $this->countryCode;
                return $this->req("https://www.fotmob.com/api/matchDetails", $p);
        }
        public function allLeagues(): array
        {
                return $this->req("https://www.fotmob.com/api/allLeagues");
        }
        public function league(string $id, string $season = 'x'): array
        {
                if ($season != 'x') $id .= "&season=" . urlencode($season);
                return $this->req("https://www.fotmob.com/api/leagues?id={$id}");
        }
        public function table(string $id): array
        {
                return $this->req("https://www.fotmob.com/api/tltable?leagueId={$id}");
        }
        public function team(string $id): array
        {
                return $this->req("https://www.fotmob.com/api/teams?id={$id}");
        }
        public function search(string $id): array
        {
                return $this->req("https://apigw.fotmob.com/searchapi/suggest?term=" . urlencode($id) . "&lang=en,fa");
        }
}
