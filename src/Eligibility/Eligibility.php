<?php

namespace BickyRaj\Ssf\Eligibility;

use BickyRaj\Ssf\Ssf;

class Eligibility
{
    protected $eligiblity;

    public function __construct(int $patientId)
    {
        $result = Ssf::eligibilityRequest($patientId);
        $result = json_decode($result->getContent(), true);
        $this->eligiblity = $result;
    }

    public function getEligibilityStatus(): bool
    {
        $data = $this->eligiblity;
        $allowed_money = $data['data']['insurance'][0]['item'][0]['benefit'][0]['allowedMoney']['value'];
        return $allowed_money > 0 ? true : false;
    }

    public function getFinance(): array
    {
        return [
            'allowedMoney'  => $this->eligiblity['data']['insurance'][0]['item'][0]['benefit'][0]['allowedMoney']['value']??0,
            'usedMoney'     => $this->eligiblity['data']['insurance'][0]['item'][0]['benefit'][0]['usedMoney']['value']??0
        ];
    }
}
