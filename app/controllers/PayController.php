<?php


namespace Controllers;
use Core\Controller;
use Models\User;

use RedBeanPHP\R;
use Ticketpark\SaferpayJson\Request\Exception\SaferpayErrorException;
use Ticketpark\SaferpayJson\Request\PaymentPage\InitializeRequest;
use Ticketpark\SaferpayJson\Request\RequestConfig;
use Ticketpark\SaferpayJson\Request\Container;
use Ticketpark\SaferpayJson\Request\PaymentPage\AssertRequest;

class PayController extends  Controller
{
    public function do_pay()
    {
// Step 1:
// Initialize the required payment page data

        $requestConfig = new RequestConfig(
            env('API_KEY'),
            env('API_SECRET'),
            env('CUSTOMER_ID'),
            true
        );

        $_SESSION['sum']=rand(100,99900);
        $_SESSION['currency'] = 'USD';

        $amount = new Container\Amount(
            $_SESSION['sum'], // amount in cents
            $_SESSION['currency']
        );

        $order_id = rand(0,9999999999);

        $payment = new Container\Payment($amount);
        $payment->setDescription("Order No. {$order_id}");

        $returnUrls = new Container\ReturnUrls(
            "http://paypal/pay/success?orderId={$order_id}",
            'http://paypal/pay/fail'
        );

        $initializeRequest = new InitializeRequest(
            $requestConfig,
            env('TERMINAL'),
            $payment,
            $returnUrls
        );

        try {
            $response = $initializeRequest->execute();
        } catch (SaferpayErrorException $e) {
            die ($e->getErrorResponse()->getErrorMessage());
        }

// -----------------------------
// Step 4:
// Save the response token, you will need it later to verify the payment (see step 7)
        $_SESSION['Payment_token'] = $response->getToken();

// Step 5:
// Redirect to the payment page
        redirect($response->getRedirectUrl());
    }

    public function success(){
        //echo $_GET['orderId'];

        $token = $_SESSION['Payment_token'];

// Step 1:
// Prepare the assert request

        $requestConfig = new RequestConfig(
            env('API_KEY'),
            env('API_SECRET'),
            env('CUSTOMER_ID'),
            true
        );

        $assertRequest = new AssertRequest(
            $requestConfig,
            $token,
        );

// Step 3:
// Execute and check for successful response

        try {
            $response = $assertRequest->execute();



        } catch (SaferpayErrorException $e) {
            die ($e->getErrorResponse()->getErrorMessage());
        }

        $transaction_id = $response->getTransaction()->getId();


        $user = User::dispense('orders');
        $user->user_id = $_SESSION['auth']['id'];
        $user->order_id = $_GET['orderId'];
        $user->transaction_id = $transaction_id;
        $user->sum = $_SESSION['sum'];
        $user->currency = $_SESSION['currency'];

        if ($id = User::store($user)){
            echo 'Все прошло успешно, платеж сохранен. Сейчас Вы будете перенаправлены на страницу с заказами';
            echo "<script>setTimeout(()=>{
                    window.location.href='/pay/table'
            }, 1000)</script>";
        } else {
            echo 'Косяк при сохранении в БД .... ';
        }
        //echo "user_id = {$_SESSION['auth']['id']}, order_id = {$_GET['orderId']}, Transaction_id={$Transaction_id}, sum={$_SESSION['sum']}, currency = {$_SESSION['currency']}";
    }

    public function fail(){
        echo 'ошибка';
    }

    protected $defaultTemplate = 'default/admin_auth_layout';
    public function table()
    {
        $orders = R::findAll('orders', 'user_id = ?', [$_SESSION['auth']['id']]);



        $this->view('admin/table', ['obj' => $orders]);
    }
}