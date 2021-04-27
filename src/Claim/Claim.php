<?php

namespace BickyRaj\Ssf\Claim;

class Claim
{
    /**
     * @var int
     */
    public $patient_id;

    /**
     * @var datetime
     */
    public $billable_period_start;

    /**
     * @var datetime
     */
    public $billable_period_end;

    /**
     * @var datetime
     */
    public $created_at;

    public $items;

    public $total_amount;

    public function __construct(array $data = null)
    {
        $this->patient_id = $data['patient_id'];
        $this->billable_period_start = $data['billable_period_start'];
        $this->billable_period_end = $data['billable_period_end'];
        $this->created_at = $data['created_at'];
        $this->total_amount = $data['total_amount'];
        $this->items = $data['items'];
    }
}
