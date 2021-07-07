<?php

namespace BickyRaj\Ssf\Claim;

class ClaimItem
{
    public $category = "item";

    public $quantity;

    public $sequence = 1;

    public $item_code;

    public $unit_price;

    public function __construct($item)
    {
        $this->category = $item['category'];
        $this->item_code = $item['item_code'];
        $this->quantity = $item['quantity'];
        $this->unit_price = $item['unit_price'];
    }

    public function get()
    {
        return [
            "category" => [
                "text" => $this->category
            ],
            "quantity" => [
                "value" => number_format($this->quantity, 2, '.', '')
            ],
            "sequence" => 1,
            "productOrService" => [
                "text" => $this->item_code
            ],
            "unitPrice" => [
                "value" => number_format($this->unit_price, 2, '.', '')
            ]
        ];
    }
}
