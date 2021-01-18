<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Category;

use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $accounts = Account::where('id', $user->id)->get();
        $transactions = Transaction::where('user_id', $user->id)->get();
        $categories = Category::all();

        return view('home')
            ->with(array('accounts'=>$accounts, 
                        'user_id'=>$user->id, 
                        'categories'=>$categories, 
                        'transactions'=>$transactions));
    }
}
