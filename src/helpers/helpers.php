<?php

/**
* converts a user timestamp to UTC to be stored on db
*/

if (!function_exists('toUTC')) {

    function toUTC($time)
    {
        return Carbon::parse($time, Session::get('user-tz', 'UTC'))->setTimezone('UTC');
    }
}

/**
* converts a UTC time to user tz
*/

if (!function_exists('toUserTz')) {

    function toUserTz($time)
    {
        return Carbon::parse($time, 'UTC')->setTimezone(Session::get('user-tz', 'UTC'));
    }
}

/**
* converts a carbon date to date string
*/

if (!function_exists('formatDate')) {

	function formatDate(Carbon $time)
    {
    	return $time->toDateString();
    }
}

/**
* converts a carbon date to time string
*/

if (!function_exists('formatTime')) {

	function formatTime(Carbon $time)
    {
    	return $time->format('H:i');
    }
}