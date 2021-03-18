<?php

namespace Bickyraj\Ssf;

use Bickyraj\Ssf\Claim\Claim;

interface SsfInterface
{
    /**
     * class initialization.
     *
     * @param integer $patientId
     * @return json
     */
    public static function init();

    /**
     * Get patient details from identifier.
     *
     * @param integer $patientId
     * @return json
     */
    public static function getPatientDetailById(int $patientId);

    /**
     * get eligibility
     *
     * @param integer $patientId
     * @return json
     */
    public static function eligibilityRequest(int $patientId);

    /**
     * Claim submission
     *
     * @param integer $patientId
     * @return json
     */
    public static function claimSubmission(Claim $claim);
}
