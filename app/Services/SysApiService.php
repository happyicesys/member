<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SysApiService
{
    /**
     * The base URL of the external Laravel API system.
     */
    protected string $baseUrl;

    /**
     * The access key and secret for authentication.
     */
    protected string $clientId;
    protected string $clientSecret;
    protected ?string $accessToken = null;

    /**
     * Create a new SysApiService instance.
     */
    public function __construct()
    {
        $this->baseUrl = rtrim(env('SYS_API_BASE_URL', 'https://sys.happyice.com.sg'), '/');
        $this->clientId = env('SYS_API_CLIENT_ID');
        $this->clientSecret = env('SYS_API_CLIENT_SECRET');
    }

    /**
     * Retrieve an access token for authenticated requests.
     *
     * @return string|null
     */
    protected function getAccessToken(): ?string
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }

        $response = Http::post("{$this->baseUrl}/oauth/token", [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);
        // dd($response->body());

        if ($response->successful()) {
            $this->accessToken = $response->json()['access_token'];
            return $this->accessToken;
        }

        Log::error('Failed to retrieve access token.', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return null;
    }

    /**
     * Fetch all DC Vends from the external system.
     *
     * @param string $operatorCode
     * @return array|null
     */
    public function getAllDCVends(string $operatorCode): ?array
    {
        // try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('Access token is not available.');
            }

            $response = Http::withToken($accessToken)
                ->post("{$this->baseUrl}/api/vends/dcvends", [
                    'operatorCode' => $operatorCode,
                ]);


            if ($response->successful()) {
                return $response->json();
            }

            Log::error('SysApiService getAllDCVends request failed.', [
                'operatorCode' => $operatorCode,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

        // } catch (\Exception $e) {
        //     Log::error('SysApiService getAllDCVends encountered an exception.', [
        //         'operatorCode' => $operatorCode,
        //         'error' => $e->getMessage(),
        //     ]);

        //     return null;
        // }
    }

    /**
     * Perform a GET request to the external system.
     *
     * @param string $endpoint
     * @param array $queryParams
     * @return array|null
     */
    public function get(string $endpoint, array $queryParams = []): ?array
    {
        try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('Access token is not available.');
            }

            $response = Http::withToken($accessToken)
                ->get("{$this->baseUrl}/{$endpoint}", $queryParams);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('SysApiService GET request failed.', [
                'endpoint' => $endpoint,
                'queryParams' => $queryParams,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('SysApiService GET request encountered an exception.', [
                'endpoint' => $endpoint,
                'queryParams' => $queryParams,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Perform a POST request to the external system.
     *
     * @param string $endpoint
     * @param array $data
     * @return array|null
     */
    public function post(string $endpoint, array $data = []): ?array
    {
        try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('Access token is not available.');
            }

            $response = Http::withToken($accessToken)
                ->post("{$this->baseUrl}/{$endpoint}", $data);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('SysApiService POST request failed.', [
                'endpoint' => $endpoint,
                'data' => $data,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('SysApiService POST request encountered an exception.', [
                'endpoint' => $endpoint,
                'data' => $data,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Perform a DELETE request to the external system.
     *
     * @param string $endpoint
     *
     * @return bool
     */
    public function delete(string $endpoint): bool
    {
        try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('Access token is not available.');
            }

            $response = Http::withToken($accessToken)
                ->delete("{$this->baseUrl}/{$endpoint}");

            if ($response->successful()) {
                return true;
            }

            Log::error('SysApiService DELETE request failed.', [
                'endpoint' => $endpoint,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('SysApiService DELETE request encountered an exception.', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Perform a PUT request to the external system.
     *
     * @param string $endpoint
     * @param array $data
     * @return array|null
     */
    public function put(string $endpoint, array $data = []): ?array
    {
        try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('Access token is not available.');
            }

            $response = Http::withToken($accessToken)
                ->put("{$this->baseUrl}/{$endpoint}", $data);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('SysApiService PUT request failed.', [
                'endpoint' => $endpoint,
                'data' => $data,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('SysApiService PUT request encountered an exception.', [
                'endpoint' => $endpoint,
                'data' => $data,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
