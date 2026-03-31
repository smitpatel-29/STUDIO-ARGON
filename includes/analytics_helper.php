<?php
/**
 * Google Analytics 4 (GA4) API Helper
 * Light-weight implementation using JWT (no external library required)
 */

function getGA4AnalyticsData($dateRange = '7daysAgo') {
    $credentials_file = __DIR__ . '/service-account.json';
    if (!file_exists($credentials_file)) return false;
    
    $json = json_decode(file_get_contents($credentials_file), true);
    if (!isset($json['private_key']) || !isset($json['client_email'])) return false;

    if (!defined('GA_PROPERTY_ID') || GA_PROPERTY_ID === 'YOUR_PROPERTY_ID_HERE') return false;
    $property_id = GA_PROPERTY_ID;

    // 1. Get Access Token (JWT Flow)
    $token = getGoogleAccessToken($json);
    if (!$token) return false;

    // 2. Fetch Data from Analytics Data API (runReport)
    $url = "https://analyticsdata.googleapis.com/v1beta/properties/$property_id:runReport";
    
    $post_data = [
        "dateRanges" => [["startDate" => $dateRange, "endDate" => "today"]],
        "dimensions" => [["name" => "date"]],
        "metrics" => [
            ["name" => "sessions"],
            ["name" => "totalUsers"],
            ["name" => "activeUsers"]
        ],
        "orderBys" => [["dimension" => ["dimensionName" => "date"]]]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Local compatibility
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

/**
 * Generates an OAuth2 access token for Google API using a Service Account Key
 */
function getGoogleAccessToken($json) {
    // Check Session Cache
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (isset($_SESSION['ga_access_token']) && $_SESSION['ga_token_expiry'] > time()) {
        return $_SESSION['ga_access_token'];
    }

    $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
    $iat = time();
    $exp = $iat + 3600;
    
    $payload = json_encode([
        'iss' => $json['client_email'],
        'scope' => 'https://www.googleapis.com/auth/analytics.readonly',
        'aud' => 'https://oauth2.googleapis.com/token',
        'iat' => $iat,
        'exp' => $exp
    ]);

    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    
    $signature = '';
    if (!openssl_sign($base64UrlHeader . "." . $base64UrlPayload, $signature, $json['private_key'], 'SHA256')) {
        return false;
    }
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    // Exchange JWT for Access Token
    $ch = curl_init('https://oauth2.googleapis.com/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion' => $jwt
    ]));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $res = json_decode($response, true);
    if (isset($res['access_token'])) {
        $_SESSION['ga_access_token'] = $res['access_token'];
        $_SESSION['ga_token_expiry'] = time() + 3500;
        return $res['access_token'];
    }
    
    return false;
}
?>
