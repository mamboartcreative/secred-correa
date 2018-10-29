<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    //General Route and index view

    // Dashboard view
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // User management
    Route::resource('user', 'RegisterUserController');

    // Sending verification code
    Route::resource('verification', 'VerificationController');

    // Role management
    Route::resource('role', 'RoleController');

    // Item management
    Route::resource('item', 'ItemController');

    // Rank and team
    Route::get('team', 'RankTeamController@index')->name('team');

    // Get product to purchased
    Route::get('product/listing', 'PurchaseController@index')->name('products');

    /*********************/
    // Add to cart
    Route::get('add/{id}', 'PurchaseController@addToCart')->name('add_cart');

    // List all item in cart
    Route::get('cart/list', 'PurchaseController@listItemsInCart')->name('all_item');

    // Clear cart
    Route::get('clear_cart', 'PurchaseController@clearCart')->name('clear_cart');

    // Remove Item
    Route::get('remove/{id}', 'PurchaseController@removeItem')->name('remove_item');

    // Add Quantity
    Route::post('add_quantity', 'PurchaseController@addQuantity')->name('add_quantity');

    // Checking out purchase
    Route::get('checkout', 'PurchaseController@checkout')->name('checkout');
    Route::post('do/checkout', 'PurchaseController@doCheckout')->name('do.checkout');

    /*********************/

    // Get purchase history by user
    Route::get('purchase-history', 'PurchaseController@getPurchaseHistory')->name('history');

    //List of all type of orders
    Route::get('orders', 'OrderController@index')->name('order.index');

    // Show order details
    Route::get('order/details/{id}', 'OrderController@show')->name('order.details');

    // Show order details for user
    Route::get('order/details/user/{id}', 'OrderController@showUser')->name('order.details.user');

    // Update order status
    Route::post('order/update/status', 'OrderController@updateStatus')->name('order.update.status');

    // List of all transactions
    Route::get('transactions', 'TransactionController@index')->name('transactions');

    // User change password form
    Route::get('change/password/{id}', 'RegisterUserController@changePassword')->name('change.password');

    // User change password update
    Route::patch('change/password/{id}', 'RegisterUserController@updatePassword')->name('password.update');

    // create payment
    Route::get('create/payment{id}', 'PurchaseController@createPayment')->name('create.payment');

    // make payment
    Route::post('make/payment', 'PurchaseController@makePayment')->name('make.payment');

    // get user sale
    Route::get('user/orders/{id}', 'RegisterUserController@userOrders')->name('user.orders');
});
