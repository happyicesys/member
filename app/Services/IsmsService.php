<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IsmsService
{
    const API_URL = 'https://www.isms.com.my/isms_send.php';

    const ERROR_UNKNOWN = 'UNKNOWN ERROR';
    const ERROR_AUTHENTICATION_FAILED = 'AUTHENTICATION FAILED';
    const ERROR_ACCOUNT_SUSPENDED = 'ACCOUNT SUSPENDED';
    const ERROR_IP_NOT_ALLOWED = 'IP NOT ALLOWED';
    const ERROR_INSUFFICIENT_CREDITS = 'INSUFFICIENT CREDITS';
    const ERROR_INVALID_SMS_TYPE = 'INVALID SMS TYPE';
    const ERROR_INVALID_BODY_LENGTH = 'INVALID BODY LENGTH';
    const ERROR_INVALID_HEX_NUMBER = 'INVALID HEX NUMBER';
    const ERROR_MISSING_PARAMETER = 'MISSING PARAMETER';
    const ERROR_INVALID_DESTINATION_NUMBER = 'INVALID DESTINATION NUMBER';
    const ERROR_INVALID_MESSAGE_TYPE = 'INVALID MESSAGE TYPE';
    const ERROR_INVALID_TERM_AND_AGREEMENT = 'INVALID TERM AND AGREEMENT';
    const SUCCESS = 'SUCCESS';

    const ERROR_MAPPINGS = [
        -1000 => self::ERROR_UNKNOWN,
        -1001 => self::ERROR_AUTHENTICATION_FAILED,
        -1002 => self::ERROR_ACCOUNT_SUSPENDED,
        -1003 => self::ERROR_IP_NOT_ALLOWED,
        -1004 => self::ERROR_INSUFFICIENT_CREDITS,
        -1005 => self::ERROR_INVALID_SMS_TYPE,
        -1006 => self::ERROR_INVALID_BODY_LENGTH,
        -1007 => self::ERROR_INVALID_HEX_NUMBER,
        -1008 => self::ERROR_MISSING_PARAMETER,
        -1009 => self::ERROR_INVALID_DESTINATION_NUMBER,
        -1012 => self::ERROR_INVALID_MESSAGE_TYPE,
        -1013 => self::ERROR_INVALID_TERM_AND_AGREEMENT,
        2000 => self::SUCCESS,
    ];

    protected $username;
    protected $password;
    protected $senderId;

    public function __construct(string $username, string $password, string $senderId)
    {
        $this->username = $username;
        $this->password = $password;
        $this->senderId = $senderId;
    }

    /**
     * Send an SMS message
     *
     * @param array $phoneNumbers
     * @param string $message
     * @param string|null $senderId Custom sender ID (optional)
     * @param string|null $agreedTerm Agreed term (optional)
     * @return array
     */
    public function sendSms(array $phoneNumbers, string $message, string $senderId = null, string $agreedTerm = 'YES')
    {
        // Default sender ID is from config if not provided
        $senderId = $senderId ?? $this->senderId;

        // Detect the message type (1 for SMS, 2 for Unicode)
        $type = strlen($message) != strlen(utf8_decode($message)) ? 2 : 1;

        // Send the SMS request
        $response = Http::get(self::API_URL, [
            'un' => $this->username,
            'pwd' => $this->password,
            'dstno' => implode(';', $phoneNumbers),
            'msg' => urlencode($message),
            'type' => $type,
            'sendid' => $senderId,
            'agreedterm' => $agreedTerm
        ]);

        // Parse the response and return
        return $this->parseResponse($response->json());
    }

    /**
     * Parse the response from Isms API and map error codes
     *
     * @param array $response
     * @return array
     */
    private function parseResponse(array $response)
    {
        $status = $response['status'] ?? null;
        $message = $response['message'] ?? self::ERROR_UNKNOWN;

        // Map error codes to more readable error messages
        $statusMessage = self::ERROR_MAPPINGS[$status] ?? $message;

        return [
            'status' => $status,
            'message' => $statusMessage,
            'raw_response' => $response,
        ];
    }
}
