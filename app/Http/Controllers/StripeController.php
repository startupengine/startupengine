<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function storePaymentMethod(Request $request)
    {
        $data = $request->input();
        $token = $request->input('data')['token'];
        $userId = $request->input('data')['userId'];
        $user = \App\User::find($userId);
        $meta = [];
        $errors = [];
        if ($user != null) {
            try {
                \Stripe\Stripe::setApiKey(stripeKey('secret'));
                if ($user->stripe_id == null) {
                    $stripeCustomer = $user->stripeCustomer($token['id']);
                    //$response = $stripeCustomer->sources->create(["source" => $token['id']]);
                    $response = $stripeCustomer;
                } else {
                    $stripeCustomer = \Stripe\Customer::retrieve(
                        $user->stripe_id
                    );
                    $stripeCustomer->sources->create([
                        "source" => $token['id']
                    ]);
                    $response = $stripeCustomer;
                }

                $success = 1;
                $paymentProcessor = "Credit card (www.stripe.com)";
            } catch (Stripe_CardError $e) {
                $error1 = $e->getMessage();
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
                $error2 = $e->getMessage();
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                $error3 = $e->getMessage();
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
                $error4 = $e->getMessage();
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $error5 = $e->getMessage();
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $error6 = $e->getMessage();
            }

            if ($success != 1) {
                $errors['error1'] = $error1;
                $errors['error2'] = $error2;
                $errors['error3'] = $error3;
                $errors['error4'] = $error4;
                $errors['error5'] = $error5;
                $errors['error6'] = $error6;
                //header('Location: checkout.php');
                //exit();
            } else {
                $user->card_last_four = $token['card']['last4'];
                $user->save();
            }

            if (count($errors) > 0) {
                $meta['status'] = "error";
            } else {
                $meta['status'] = "success";
            }
        } else {
            $errors['User'] = "User does not exist.";
            $meta['status'] = "error";
        }

        return response()->json([
            "data" => [
                'response' => $response,
                'errors' => $errors,
                'meta' => $meta
            ]
        ]);
    }
}
