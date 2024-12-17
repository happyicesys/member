<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OneWaySmsService
{
    const API_URL = 'https://gateway.onewaysms.sg/api.aspx';

    const ERROR_APIPASSNAME_APIPASSWORD_INVALID = 'APIPASSNAME OR APIPASSWORD IS INVALID';
    const ERROR_SENDERID_PARAMETER_INVALID = 'SENDERID PARAMETER IS INVALID';
    const ERROR_MOBILENO = 'MOBILENO PARAMETER IS INVALID';
    const ERROR_LANGUAGETYPE_INVALID = 'LANGUAGETYPE IS INVALID';
    const ERROR_CHARACTERS_INVALID = 'INVALID CHARACTERS IN MESSAGE';
    const ERROR_INSUFFICIENT_CREDIT = 'INSUFFICIENT CREDIT BALANCE';

    const ERROR_MAPPINGS = [
        -100 => self::ERROR_APIPASSNAME_APIPASSWORD_INVALID,
        -200 => self::ERROR_SENDERID_PARAMETER_INVALID,
        -300 => self::ERROR_MOBILENO,
        -400 => self::ERROR_LANGUAGETYPE_INVALID,
        -500 => self::ERROR_CHARACTERS_INVALID,
        -600 => self::ERROR_INSUFFICIENT_CREDIT,
    ];

    /**
     * Send an SMS message
     *
     * @param array $phoneNumbers
     * @param string $message
     * @param string|null $senderId Custom sender ID (optional)
     * @param string|null $agreedTerm Agreed term (optional)
     * @return array
     */
    public function sendSms(array $phoneNumbers, string $message)
    {
        // Detect the message type (1 for SMS, 2 for Unicode)
        $type = strlen($message) != strlen(utf8_decode($message)) ? 2 : 1;

        // Send the SMS request
        $response = Http::get(self::API_URL, [
            'apiusername' => config('onewaysms.username'),
            'apipassword' => config('onewaysms.password'),
            'mobileno' => implode(',', $phoneNumbers),
            'message' => $message,
            'languagetype' => $type,
            'senderid' => config('onewaysms.sender_id'),
        ]);

        // Parse the response and return
        return $response;
    }
}
