## About
a simple PHP library for connecting to https://fotmob.com website API . for using this library you need a SSL connection

## Install
you just need import `fotmobOpenAPI.php` into your PHP file like this:
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();
```
(!important) you need introduce your country and time zone to fotmob api . this methods are required !
```php
$fm->setTimeZone('Asia/Tehran');
$fm->setCountryCode('IRA');
```

## Matches
with this method you can access to all matches in a date . you can filter your request by one or more league or country
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();

// get all matches :
$all_matches = $fm->matches();
// get all matches of a date :
$all_matches = $fm->matches("2023/3/9");

// get multi countries matches:
$some_countries_matches = $fm->matches("today",["ENG","ESP"]);

// get multi leagues matches :
$some_leagues_matches = $fm->matches("today",["ENG","ESP"]);
```

## Get a match details
with this method an a match id you can access to it details
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();

// get a match data :
$match_data = $fm->match(99999);
```

## Search
whith this method you can search a string value into fotmob server
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();

// search a value :
$search_results = $fm->search('fcb');
```

## All leagues
access to all existed leagues on fotmob server
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();

// get all leagues :
$leagues = $fm->allLeagues();
```

## League
if you have a league ID you can access to it details
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();

// get a league data :
$league = $fm->league(999999);

// get a custom season data from a league :
$league_2017 = $fm->league(999999,'2017-2018');
```

## Team
if you have a team ID you can access to it details
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();

// get a team data :
$team = $fm->team(999999);
```

## League Table
if you have a league id you can access to it table details with this method
```php
include '/path/to/fotmobOpenAPI.php';
$fm = new fotmobOpenAPI();

// get a team data :
$table = $fm->table(999999);
```
