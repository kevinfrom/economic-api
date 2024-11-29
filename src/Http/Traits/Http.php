<?php

namespace Kevinfrom\EconomicApi\Http\Traits;

use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Enums\HttpMethod;
use Kevinfrom\EconomicApi\Http\Response;

trait Http
{
    /**
     * Perform an HTTP request to the Economic REST API.
     *
     * @param HttpMethod $method The HTTP method to use
     * @param AuthConfig $authConfig The authentication configuration
     * @param string     $endpoint The endpoint to call
     * @param array      $queryOrData Query parameters or data to send
     *
     * @return Response
     */
    protected static function request(HttpMethod $method, AuthConfig $authConfig, string $endpoint, array $queryOrData = []): Response
    {
        if (str_starts_with($endpoint, '/')) {
            $endpoint = substr($endpoint, 1);
        }

        $ch = curl_init();

        $url = "https://restapi.e-conomic.com/$endpoint";

        switch ($method) {
            case HttpMethod::GET:
            case HttpMethod::DELETE:
                if ($queryOrData) {
                    $url .= '?' . http_build_query($queryOrData);
                }
            break;
            case HttpMethod::POST:
                curl_setopt($ch, CURLOPT_POST, true);
            break;
            case HttpMethod::PUT:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            break;
            case HttpMethod::PATCH:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            break;
        }

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            sprintf('X-AppSecretToken: %s', $authConfig->getAppSecretToken()),
            sprintf('X-AgreementGrantToken: %s', $authConfig->getAgreementGrantToken()),
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return new Response($statusCode >= 200 && $statusCode <= 299, $response);
    }
}
