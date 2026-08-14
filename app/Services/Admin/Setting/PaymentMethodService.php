<?php

namespace App\Services\Admin\Setting;

use App\Repositories\PaymentMethodRepository;
use App\Services\BaseService;

class PaymentMethodService extends BaseService
{
    public function __construct(
        protected PaymentMethodRepository $paymentMethodRepository
    )
    {
        parent::__construct($paymentMethodRepository);
    }
}
