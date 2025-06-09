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
    protected ?string $bearerToken;

    /**
     * Create a new SysApiService instance.
     */
    public function __construct()
    {
        $this->baseUrl = rtrim(env('SYS_API_BASE_URL', 'https://sys.happyice.com.sg'), '/');
        $this->bearerToken = env('SYS_API_BEARER_TOKEN', '');
    }

    /**
     * Fetch all DC Vends from the external system.
     *
     * @param string $operatorCode
     * @return array|null
     */
    public function getAllDCVends(string $operatorCode): ?array
    {
        $endpoint = "/api/client/dcvends";
        return $this->postRequest($endpoint, ['operatorCode' => $operatorCode]);
    }

    /**
     * Update vend countries via the external system.
     *
     * @return array|null
     */
    public function updateVendCountries(): ?array
    {
        $endpoint = "/api/vends/operators/" . env('SYS_OPERATOR_CODE') . "/update-dcvends-countries";
        return $this->getRequest($endpoint);
    }

    /**
     * Perform a GET request to the external system.
     *
     * @param string $endpoint
     * @param array $queryParams
     * @return array|null
     */
    public function getRequest(string $endpoint, array $queryParams = []): ?array
    {
        $response = Http::withToken($this->bearerToken)
            ->withHeaders(['Accept' => 'application/json'])
            ->get($this->baseUrl . $endpoint, $queryParams);

        if ($response->successful()) {
            return $response->json();
        }

        $this->logError('GET', $endpoint, $response);
        return null;
    }

    /**
     * Perform a POST request to the external system.
     *
     * @param string $endpoint
     * @param array $data
     * @return array|null
     */
    public function postRequest(string $endpoint, array $data = []): ?array
    {
        $response = Http::withToken($this->bearerToken)
            ->withHeaders(['Accept' => 'application/json'])
            ->post($this->baseUrl . $endpoint, $data);

        if ($response->successful()) {
            return $response->json();
        }

        $this->logError('POST', $endpoint, $response, $data);
        return null;
    }

    /**
     * Perform a DELETE request to the external system.
     *
     * @param string $endpoint
     * @return bool
     */
    public function deleteRequest(string $endpoint): bool
    {
        $response = Http::withToken($this->bearerToken)
            ->withHeaders(['Accept' => 'application/json'])
            ->delete($this->baseUrl . $endpoint);

        if ($response->successful()) {
            return true;
        }

        $this->logError('DELETE', $endpoint, $response);
        return false;
    }

    public function getVouchersDetails(array $voucherCodesArray, $vendCode = null, $userID = null)
    {
        $vouchersEndpoint = "/api/vouchers/details";

        // dd($voucherCodesArray, $vendCode, $userID);
        $response = Http::withToken($this->bearerToken)
            ->withHeaders(['Accept' => 'application/json'])
            ->post($this->baseUrl . $vouchersEndpoint, [
                'codes' => $voucherCodesArray,
                'vend_code' => $vendCode,
                'dcvend_user_id' => $userID,
            ]);

        return $response->json();
    }

    /**
     * Perform a PUT request to the external system.
     *
     * @param string $endpoint
     * @param array $data
     * @return array|null
     */
    public function putRequest(string $endpoint, array $data = []): ?array
    {
        $response = Http::withToken($this->bearerToken)
            ->withHeaders(['Accept' => 'application/json'])
            ->put($this->baseUrl . $endpoint, $data);

        if ($response->successful()) {
            return $response->json();
        }

        $this->logError('PUT', $endpoint, $response, $data);
        return null;
    }

    /**
     * Log an error for failed requests.
     *
     * @param string $method
     * @param string $endpoint
     * @param \Illuminate\Http\Client\Response $response
     * @param array|null $data
     * @return void
     */
    protected function logError(string $method, string $endpoint, $response, array $data = null): void
    {
        $logData = [
            'method' => $method,
            'endpoint' => $this->baseUrl . $endpoint,
            'status' => $response->status(),
            'body' => $response->body(),
        ];

        if ($data) {
            $logData['data'] = $data;
        }

        Log::error('SysApiService request failed.', $logData);
    }
}
