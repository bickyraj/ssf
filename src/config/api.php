<?php

    return [
        "patient" => env("SSF_API_URL") . "/api_fhir/Patient/",
        "location" => env("SSF_API_URL") . "/api_fhir/Location/",
        "practitioner_role" => env("SSF_API_URL") . "/api_fhir/PractitionerRole/",
        "practitioner" => env("SSF_API_URL") . "/api_fhir/Practitioner/",
        "claim" => env("SSF_API_URL") . "/api_fhir/Claim/",
        "claim_response" => env("SSF_API_URL") . "/api_fhir/ClaimResponse/",
        "communication_request" => env("SSF_API_URL") . "/api_fhir/CommunicationRequest/",
        "eligibility_request" => env("SSF_API_URL") . "/api_fhir/EligibilityRequest/",
        "coverage" => env("SSF_API_URL") . "/api_fhir/Coverage/"
    ];
