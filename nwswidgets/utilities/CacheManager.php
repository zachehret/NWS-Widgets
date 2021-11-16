<?php

namespace nwswidgets\data\utilities;

class CacheManager
{
    /**
     * @var CACHE The local cache directory
     */
    public const CACHE = __DIR__ . "/../_cache/";


    /**
     * Determines if the cached file is expired.
     *
     * @param string $path - The path to the file relative to CacheManager::CACHE
     * @param int $maxAge - The max age of the file in seconds
     * @return bool - Returns true if the file is expired, does not exist, or is not accessible; Returns false otherwise.
     */
    public static function isExpired(string $path, int $maxAge) : bool {
        if(file_exists(CacheManager::CACHE . $path)) {
            $lastUpdatedTime = filemtime(CacheManager::CACHE . $path);
            if($lastUpdatedTime === false) {
                // Failure to read
                return true;
            }
            if(time() - $lastUpdatedTime > $maxAge) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public static function updateFile(string $path, string $content, int $maxAge = 0, bool $forceUpdate = false) : bool {
        if(! $forceUpdate || $maxAge !== 0) {
            // Not force updating.
            if(! self::isExpired($path, $maxAge)) {
                // File is not expired - don't update
                return false;
            }
        }

        return self::writeFile($path, $content);
    }

    protected static function writeFile(string $path, string $content) : bool {
        $path = str_replace("\\", "/", $path);
        $standardizedCache = self::getStandardizedCachePath();
        $directorySplits = explode("/", $standardizedCache . $path);
        $directories = implode(array_chunk($directorySplits, sizeof($directorySplits) - 1));
        $filename = $directorySplits[sizeof($directorySplits) - 1];
        if( !is_dir($directories)) {
            if (mkdir($directories) === false) {
                return false;
            }
        }
        $resource = fopen($directories . "/" . $filename, "w");
        if($resource === false) {
            return false;
        }

        $writeResults = fwrite($resource, $content);

        fclose($resource);

        return !(($writeResults === false));
    }

    protected static function getStandardizedCachePath() : string {
        return str_replace("\\", "/", self::CACHE);
    }
}