<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController
{

    public function create_payment_upgrade_account(string $for)
    {

        $amount = (int)setting('account.'.$for.'_amount');
        if(!!!$amount) return abort(404);
        // Create new invoice.
        $invoice = (new Invoice)->amount($amount);

        return Payment::callbackUrl(url('/verify'))->purchase(
            $invoice,
            function ($driver, $transactionId) use ($amount, $for) {
                Auth::user()->payments()->create(['transaction_id' => $transactionId, 'amount' => $amount, 'for' => 'upgrade_account_to_'.$for]);
            }
        )->pay()->render();
    }


    public function verify()
    {
        $payment = Auth::user()->payments()->latest('created_at')->first();
        try {

            $receipt = Payment::amount((int)$payment->amount)->transactionId($payment->transaction_id)->verify();
            $this->do_work($payment->for);

            $message = __("Purchase do successfully");
            $alert_class = 'success';
            return redirect()->route('home')->with(['message'=>$message,'alert-class'=>$alert_class]);

        } catch (InvalidPaymentException $exception) {
            /**
             * when payment is not verified, it will throw an exception.
             * We can catch the exception to handle invalid payments.
             * getMessage method, returns a suitable message that can be used in user interface.
             **/
           $message = __("Purchase failed");
           $alert_class = 'error';
            return redirect()->route('upgradeAccount')->with(['message'=>$message,'alert-class'=>$alert_class]);
        }
    }

    private function do_work($work)
    {
        $user = Auth::user();
        switch ($work) {
            case 'upgrade_account_to_basic':
                $user->upgrade_account('basic');
                break;
            case 'upgrade_account_to_general':
                $user->upgrade_account('general');
                break;
            case 'upgrade_account_to_advanced':
                $user->upgrade_account('advanced');
                break;

        }
    }
}
