<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Reservation;
use Stripe\StripeClient;
use Exception;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function handlePayment(Request $request)
    {
        try {
            if ($request->has('payment_intent_id')) {
                return $this->updatePaymentStatus($request);
            }

            $validated = $request->validate([
                'amount' => 'required|numeric|min:1',
                'id' => 'required|exists:reservations,id', // Ensure reservation exists
            ]);

            $reservation = Reservation::findOrFail($validated['id']);

            $amountInCents = (int) ($validated['amount'] * 100); // Convert EGP to cents (piastres)

            $paymentIntent =PaymentIntent::create([
                'amount' => $amountInCents, // Stripe requires the amount in the smallest currency unit
                'currency' => 'egp', // Set currency to Egyptian Pounds (EGP)
                'payment_method_types' => ['card'],
            ]);

            // Update reservation with payment details
            $reservation->update([
                'payment_intent_id' => $paymentIntent->id,
                'currency' => 'usd',
                'payment_status' => 'pending',
            ]);

            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (ApiErrorException $e) {
            return $this->handleError('Stripe error: ' . $e->getMessage(), 500);
        } catch (Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'payment_intent_id' => 'required|string'
            ]);

            $reservation = Reservation::where('payment_intent_id', $validated['payment_intent_id'])->firstOrFail();

            $paymentIntent = $this->stripe->paymentIntents->retrieve($validated['payment_intent_id']);

            if ($paymentIntent->status === 'succeeded') {
                $reservation->update([
                    'payment_status' => 'succeeded'
                ]);
                return response()->json(['message' => 'Payment status updated successfully']);
            }

            return response()->json(['error' => 'Payment status from Stripe is not succeeded'], 400);
        } catch (ApiErrorException $e) {
            return $this->handleError('Stripe error: ' . $e->getMessage(), 500);
        } catch (Exception $e) {
            return $this->handleError($e->getMessage(), 404);
        }
    }

    private function handleError(string $message, int $statusCode)
    {
        return response()->json(['error' => $message], $statusCode);
    }
}
