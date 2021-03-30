<?php

namespace BickyRaj\Ssf;

use BickyRaj\Ssf\Claim\Claim;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class Ssf implements SsfInterface
{
    protected static $message;
    protected static $success = true;
    protected static $httpStatusCode;
    protected static $responseBody;

    private static $username;
    private static $password;
    private static $ssfClient;
    private static $clientOptions;

    /**
     *
     * @var Singleton
     */
    private static $instance;

    private function __construct()
    {
        self::$username = config('ssf_auth.username');
        self::$password = config('ssf_auth.password');
        self::$clientOptions = [
            'verify' => false,
            'auth' => [
                self::$username,
                self::$password
            ],
            'headers' => [
                'remote-user' => 'openimis'
            ]
        ];

        self::$ssfClient = new Client(self::$clientOptions);
    }

    public static function init()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getPatientDetailById(int $patientId)
    {
        \Log::info(config('ssf_api_url.patient'));
        try {
            self::init();
            $response = self::$ssfClient->get(
                config('ssf_api_url.patient') . "?identifier=" . $patientId
            );

            self::$httpStatusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents());
        } catch (\RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody()->getContents());
            }

            self::$httpStatusCode = 500;
            self::$success = false;
        }

        self::$responseBody = $responseBody;
        return self::apiResponse();
    }

    public static function eligibilityRequest(int $patientId)
    {
        try {
            self::init();
            $request_body = [
                "resourceType" =>  "EligibilityRequest",
                "patient" =>  [
                    "reference" =>  "Patient/" . $patientId
                ]
            ];

            $response = self::$ssfClient->post(
                config('ssf_api_url.eligibility_request'),
                [
                    'json' => $request_body
                ]
            );
            $responseBody = json_decode($response->getBody()->getContents());
            self::$httpStatusCode = 200;
            self::$message = "Request fetched successfully.";
        } catch (\RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody()->getContents());
            }

            self::$httpStatusCode = 500;
            self::$success = false;
        }

        self::$responseBody = $responseBody;
        return self::apiResponse();
    }

    public static function claimSubmission(Claim $claim)
    {
        try {
            self::init();
            $request_body = [
                "resourceType" => "Claim",
                "id" => $claim->claim_id,
                "identifier" => [
                    [
                        "use" => "usual",
                        "type" => [
                            "coding" => [
                                [
                                    "system" => "https://hl7.org/fhir/valueset-identifier-type.html",
                                    "code" => "MR"
                                ]
                            ]
                        ],
                        "value" => $claim->claim_id
                    ]
                ],
                "type" => [
                    "text" => "O"
                ],
                "patient" => [
                    "reference" => "Patient/" . $claim->patient_id
                ],
                "billablePeriod" => [
                    "start" => $claim->billable_period_start,
                    "end" => $claim->billable_period_end
                ],
                "created" => $claim->created_at,
                "enterer" => [
                    "reference" => "Practitioner/4a3f1a0a-e13c-451a-9511-a4d0fe35d20b"
                ],
                "facility" => [
                    "reference" => "Location/026E088A-FBD5-474E-8D42-069958A34127"
                ],
                "diagnosis" => [
                    [
                        "sequence" => 1,
                        "diagnosisCodeableConcept" => [
                            "coding" => [
                                [
                                    "code" => "A09"
                                ]
                            ]
                        ],
                        "type" => [
                            [
                                "text" => "icd_0"
                            ]
                        ]
                    ]
                ],
                "item" => [
                    [
                        "sequence" => 1,
                        "category" => [
                            "text" => "item"
                        ],
                        "service" => [
                            "text" => "0121"
                        ],
                        "quantity" => [
                            "value" => 1.0
                        ],
                        "unitPrice" => [
                            "value" => 200.0
                        ]

                    ]
                ],
                "total" => [
                    "value" => 200.0
                ]
            ];

            $response = self::$ssfClient->post(
                config('ssf_api_url.claim'),
                [
                    'json' => $request_body
                ]
            );
            $responseBody = json_decode($response->getBody()->getContents());
            self::$httpStatusCode = $responseBody->getStatusCode();
        } catch (RequestException $e) {
            // $responseBody = Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody()->getContents());
            }

            self::$httpStatusCode = 500;
            self::$success = false;
        }

        self::$responseBody = $responseBody;

        return self::apiResponse();
    }

    public static function apiResponse()
    {
        return response()->json([
            'data' => self::$responseBody,
            'message' => self::$message,
            'success' => self::$success
        ], self::$httpStatusCode);
    }
}
