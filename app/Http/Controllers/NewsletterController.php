<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use GuzzleHttp\Exception\ClientException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(
                removePlussesEmail(request('email'))
            );
        }
        // If email could not be subscribed, show errors and keep the email entered
        catch (ClientException $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Failed to subscribe. Please try again later.'
                ]);
        } catch (\Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter.'
            ]);
        }

        return redirect('/')
            ->with('success', "You've just subscribed to the newsletter!");
    }
}
