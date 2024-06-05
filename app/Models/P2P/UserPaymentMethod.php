<?php

namespace App\Models\P2P;

use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{

    protected $casts = [
        'user_data' => 'object'
    ];

    protected $table = "p2p_user_payment_methods";

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
