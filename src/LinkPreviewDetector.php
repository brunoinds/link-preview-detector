<?php

namespace Brunoinds\LinkPreviewDetector;

use Brunoinds\LinkPreviewDetector\Providers\UserAgentBot;
use Brunoinds\LinkPreviewDetector\Providers\HeaderUserAgentBot;

class LinkPreviewDetector
{
    /**
     * Checks if the current request is for a link preview.
     *
     * @return bool Returns true if the request is for a link preview, false otherwise.
     */
    public static function isForLinkPreview():bool
    {
        $userAgent = self::fetchCurrentUserAgentName();
        if (empty($userAgent)){
            return false;
        }
        
        return self::checkIfIsForLinkPreviewAgainstUserAgent($userAgent);
    }

    /**
     * Checks if the current request is for a link preview based on the user agent name.
     *
     * @param string $userAgentName The name of the user agent.
     * @return bool Returns true if the request is for a link preview, false otherwise.
     */
    public static function isForLinkPreviewUserAgent(string $userAgentName):bool
    {
        return LinkPreviewDetector::checkIfIsForLinkPreviewAgainstUserAgent($userAgentName);
    }



    /**
     * Checks if the current request is for a link preview based on the user agent name.
     *
     * @param string $userAgentName The name of the user agent.
     * @return bool Returns true if the user agent name matches any bot user agent, false otherwise.
     */
    private static function checkIfIsForLinkPreviewAgainstUserAgent(string $userAgentName):bool
    {
        $userAgents = (new UserAgentBot())->getAll();

        foreach ($userAgents as $userAgentBot) {
            if (preg_match('/'.$userAgentBot.'/', $userAgentName)){
                return true;
            }
        }

        return false;
    }
    /**
     * Fetches headers that contain user agent bot information.
     *
     * @return array Returns an associative array where the keys are the header names and the values are the corresponding header values.
     */
    private static function fetchHeadersWithUserAgentBot():array
    {
        $headersUserAgentBot = (new HeaderUserAgentBot)->getAll();

        $headers = [];

        foreach ($headersUserAgentBot as $headerUserAgentBot) {
            if (isset($_SERVER[$headerUserAgentBot])){
                $headers[$headerUserAgentBot] = $_SERVER[$headerUserAgentBot];
            }
        }

        return $headers;
    }
    /**
     * Fetches the current user agent name from headers.
     *
     * @return string|null Returns the user agent name if found, null otherwise.
     */
    private static function fetchCurrentUserAgentName():string|null
    {
        $userAgentHeaders = self::fetchHeadersWithUserAgentBot();

        $userAgent = '';

        foreach ($userAgentHeaders as $userAgentHeader) {
            $userAgent .= $userAgentHeader . ' ';
        }

        if (empty($userAgent)){
            return null;
        }

        return $userAgent;
    }
}