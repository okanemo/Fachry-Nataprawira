@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="accounts">
                        <h3>Accounts Information</h3>
                        <table style="width:100%" class="table">
                            <tr>
                                <th>name</th>
                                <th>currency</th>
                                <th>income</th>
                                <th>expense</th>
                                <th>total</th>
                            </tr>
                            @foreach($accounts as $account) 
                            <tr>
                                <td>{{$account->name}}</td>
                                <td>{{$account->currency->name}}</td>
                                <td>{{$account->get_total_income()}}</td>
                                <td>{{$account->get_total_expense()}}</td>
                                <td>{{$account->get_total_balance()}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    
                    <div class="transactions">
                        <h3>Transactions Information</h3>
                        <table style="width:100%" class="table">
                            <tr>
                                <th>description</th>
                                <th>type</th>
                                <th>account</th>
                                <th>date</th>
                                <th>amount</th>
                            </tr>
                            @foreach($transactions as $transaction) 
                            <tr>
                                <td>{{$transaction->description}}</td>
                                <td>{{$transaction->type}}</td>
                                <td>{{$transaction->account->name}}</td>
                                <td>{{$transaction->date}}</td>
                                <td>{{$transaction->amount}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    
                    <h3>Add new transaction</h3>
                    <form method="POST" action="/transaction">
                        @csrf

                        <div class="form-group">
                            <strong><label for="description">Description</label></strong>
                            <input id="description" type="text" class="form-control" placeholder="Income this month" name="description">
                            <small id="description_help" class="form-text text-muted">put description for new transaction.</small>
                        </div>

                        <div class="form-group">
                            <strong><label for="amount">Amount</label></strong>
                            <input id="amount" type="number" class="form-control" placeholder="100000" name="amount">
                            <small id="amount_help" class="form-text text-muted">put amount for new transaction.</small>
                        </div>
                        
                        <div class="form-group">
                            <strong><label for="amount">Transaction Type:</label></strong>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="transaction_type_1" value="income">
                                <label class="form-check-label" for="transaction_type_1">income</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="transaction_type_2" value="expense">
                                <label class="form-check-label" for="transaction_type_2">expense</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong><label for="amount">Which Account: </label></strong>
                            <br>
                            @foreach($accounts as $account) 
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="account_id" id={{'account'.$account->id}} value={{$account->id}}>
                                <label class="form-check-label" for={{'account'.$account->id}}>{{$account->name}}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <strong><label for="amount">Category: </label></strong>
                            <br>
                            @foreach($categories as $category) 
                                 <p>{{$category->name}}:
                                 @foreach($category->sub_categories as $sub_category) 
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sub_category_id" id={{'sub_category'.$category->id}} value={{$sub_category->id}}>
                                            <label class="form-check-label" for={{'category'.$sub_category->id}}>{{$sub_category->name}}</label>
                                    </div>
                                @endforeach
                                </p>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <br>

                    <h3>Add new account</h3>
                    <form method="POST" action="/account">
                        @csrf

                        <div class="form-group">
                            <strong><label for="name">Name</label></strong>
                            <input id="name" type="text" class="form-control" placeholder="Saving" name="name">
                            <small id="name_help" class="form-text text-muted">put name for new account.</small>
                        </div>

                        <div class="form-group">
                            <strong><label for="amount">Currency used: </label></strong>
                            <br>
                            @foreach($currencies as $currency) 
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="currency_id" id={{'currency'.$currency->id}} value={{$currency->id}}>
                                <label class="form-check-label" for={{'currency'.$currency->id}}>{{$currency->symbol}} ({{$currency->name}})</label>
                            </div>
                            @endforeach
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
