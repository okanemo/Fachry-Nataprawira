<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Account extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'currency_id',
        'user_id'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }

    public function get_total_income()
    {
        $transactions = $this
                            ->transactions()
                            ->where('type', 'income')
                            ->get();

        return $transactions->sum(function ($transaction) {
            return $transaction->amount;
        });
 
    }

    public function get_total_expense()
    {
        $transactions = $this
                            ->transactions()
                            ->where('type', 'expense')
                            ->get();

        return $transactions->sum(function ($transaction) {
            return $transaction->amount;
        });
    }

    public function get_total_balance()
    {
        return $this->get_total_income() - $this->get_total_expense();
    }
}
