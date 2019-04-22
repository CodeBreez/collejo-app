<?php

/**
 * Present an object to the view.
 */
if (!function_exists('present')) {
    function present($object, $presenter)
    {
        if ($object instanceof Illuminate\Database\Eloquent\Model) {
            $presenter = new Collejo\Foundation\Presenter\ModelPresenter($object, $presenter);
        } elseif ($object instanceof Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            $presenter = new Collejo\Foundation\Presenter\PaginatedPresenter($object, $presenter);
        } elseif ($object instanceof Illuminate\Support\Collection) {
            $presenter = new Collejo\Foundation\Presenter\CollectionPresenter($object, $presenter);
        } else {
            throw Exception('Cannot present object of type'.get_class($object));
        }

        return $presenter->present();
    }
}

/*
 * Converts a user timestamp to UTC to be stored on db.
 */
if (!function_exists('toUTC')) {
    function toUTC($time)
    {
        return Carbon::parse($time, Cookie::get('collejo_tz', 'UTC'))->setTimezone('UTC');
    }
}

/*
 * Converts a UTC time to user tz
 */
if (!function_exists('toUserTz')) {
    function toUserTz($time)
    {
        return Carbon::parse($time, 'UTC')->setTimezone(Cookie::get('collejo_tz', 'UTC'));
    }
}

/*
 * Converts a carbon date to date string
 */
if (!function_exists('formatDate')) {
    function formatDate(Carbon $time)
    {
        return $time->toDateString();
    }
}

/*
 * Converts a carbon date to time string
 */
if (!function_exists('formatTime')) {
    function formatTime(Carbon $time)
    {
        return $time->format('H:i');
    }
}

/*
 * List files and folders in a given directory
 * Hidden files are not included
 *
 * @param $path
 * @return array
 */
if (!function_exists('listDir')) {
    function listDir($path)
    {
        return array_filter(scandir($path), function ($item) {
            return !in_array($item, ['.', '..']) && substr($item, 0, 1) != '.';
        });
    }
}
