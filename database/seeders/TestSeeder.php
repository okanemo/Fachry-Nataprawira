<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Currency;
use App\Models\Transaction;

use Carbon;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // users
        $user_1 = User::create(array('name' => 'user',
            'email' => 'user'.'@gmail.com',
            'password' => Hash::make('password')
        ));

        // categories
        $category_1 = Category::create(array(
            'name' => 'primary'
        ));

        $category_2 = Category::create(array(
            'name' => 'food and beverages'
        ));

        // sub-categories
        $salary = SubCategory::create(array(
            'name' => 'Salary',
            'category_id' => $category_1->id
        ));
        $bonus = SubCategory::create(array(
            'name' => 'Bonus',
            'category_id' => $category_1->id
        ));
        $meals = SubCategory::create(array(
            'name' => 'Meals',
            'category_id' => $category_2->id
        ));
        $snack = SubCategory::create(array(
            'name' => 'Snack',
            'category_id' => $category_2->id
        ));

        // currencies
        $usd = Currency::create(array(
            'name' => 'US Dollar',
            'symbol' => 'USD',
            'to_dollar' => 1
        ));
        $jpy = Currency::create(array(
            'name' => 'Japanese Yen',
            'symbol' => 'JPY',
            'to_dollar' => 0.0096
        ));
        $idr = Currency::create(array(
            'name' => 'Indonesia Rupiah',
            'symbol' => 'IDR',
            'to_dollar' => 0.000071
        ));

        // accounts
        $account_1 = Account::create(array(
            'name' => 'saving',
            'currency_id' => $idr->id,
            'user_id' => $user_1->id
        ));

        // transactions
        Transaction::create(array(
            'description' => 'gaji pertamaku magang',
            'type' => 'income',
            'date' => Carbon\Carbon::now(),
            'amount' => 1000000,
            'account_id' => $account_1->id,
            'user_id' => $user_1->id,
            'sub_category_id' => $salary->id
        ));
        Transaction::create(array(
            'description' => 'gaji keduaku magang',
            'type' => 'income',
            'date' => Carbon\Carbon::now(),
            'amount' => 1000000,
            'account_id' => $account_1->id,
            'user_id' => $user_1->id,
            'sub_category_id' => $salary->id
        ));
        Transaction::create(array(
            'description' => 'makan bulanan',
            'type' => 'expense',
            'date' => Carbon\Carbon::now(),
            'amount' => 100000,
            'account_id' => $account_1->id,
            'user_id' => $user_1->id,
            'sub_category_id' => $meals->id
        ));
    }
}