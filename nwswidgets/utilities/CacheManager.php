<?php

namespace nwswidgets\data\utilities;

class CacheManager
{
    public const CACHE = __DIR__ . "/../_cache/";
    /**
     * Determines if the file is due to be updated aka the cached version is expired.
     *
     * @param string $file - The path to the file relative to CacheManager::CACHE
     * @param int $maxAge - The max age of the file in seconds
     * @return bool - Returns true if the file is expired, does not exist, or is not accessible; Returns false otherwise.
     */
    public static function isExpired(string $file, int $maxAge) : bool {
        if(file_exists(CacheManager::CACHE . $file)) {
            $lastUpdatedTime = filemtime(CacheManager::CACHE . $file);
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
}