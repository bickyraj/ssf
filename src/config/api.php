<?php

    return [
        "patient" => env("SSF_API_URL") . "/api_fhir_r4/Patient/",
        "location" => env("SSF_API_URL") . "/api_fhir_r4/Location/",
        "practitioner_role" => env("SSF_API_URL") . "/api_fhir_r4/PractitionerRole/",
        "practitioner" => env("SSF_API_URL") . "/api_fhir_r4/Practitioner/",
        "claim" => env("SSF_API_URL") . "/api_fhir_r4/claim/",
        "claim_response" => env("SSF_API_URL") . "/api_fhir_r4/ClaimResponse/",
        "communication_request" => env("SSF_API_URL") . "/api_fhir_r4/CommunicationRequest/",
        "eligibility_request" => env("SSF_API_URL") . "/api_fhir_r4/CoverageEligibilityRequest/",
        "coverage" => env("SSF_API_URL") . "/api_fhir_r4/Coverage/"
    ];
