<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class PriceBreakdown extends Data
{
    public function __construct(
        #[Min(0)]
        public float $accommodation,

        #[Min(0)]
        public float $services,

        #[Min(0)]
        public float $total,

        public array $serviceDetails = []
    ) {}
}
