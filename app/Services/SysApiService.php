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
     * The bearer token for authentication.
     */
    protected string $bearerToken;

    /**
     * Create a new SysApiService instance.
     */
    public function __construct()
    {
        $this->baseUrl = rtrim(env('SYS_API_BASE_URL', 'https://sys.happyice.com.sg'), '/');
        $this->bearerToken = env('SYS_API_BEARER_TOKEN');
    }

    /**
     * Fetch all DC Vends from the external system.
     *
     * @param string $operatorCode
     * @return array|null
     */
    public function getAllDCVends(string $operatorCode): ?array
    {
        $response = Http::withToken($this->bearerToken)
            ->post("{$this->baseUrl}/api/vends/dcvends", [
                'operatorCode' => $operatorCode,
            ]);

        dd($response);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('SysApiService getAllDCVends request failed.', [
            'operatorCode' => $operatorCode,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return null;
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
        $response = Http::withToken($this->bearerToken)
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
        $response = Http::withToken($this->bearerToken)
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
    }

    /**
     * Perform a DELETE request to the external system.
     *
     * @param string $endpoint
     * @return bool
     */
    public function delete(string $endpoint): bool
    {
        $response = Http::withToken($this->bearerToken)
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
        $response = Http::withToken($this->bearerToken)
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
    }
}
