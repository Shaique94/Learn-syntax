<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        $data = $request->only('email', 'subject', 'message');
        // try {
        //     Mail::send([], [], function ($message) use ($data) {
        //         $message->to('shaiqueaijaz.9434@gmail.com')
        //                 ->subject($data['subject'])
        //                 ->setBody(
        //                     "Message from: {$data['email']}\n\n{$data['message']}",
        //                     'text/plain'
        //                 );
        //     });
    
        //     return response()->json(['message' => 'Your message has been sent successfully!'], 200);
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'Failed to send email.'], 500);
        // }

        // try {
        //     Mail::raw('Test email', function ($message) {
        //         $message->to('shaiqueaijaz.9434@gmail.com')
        //                 ->subject('SMTP Test');
        //     });
        //     return response()->json(['message' => 'Test email sent successfully.'], 200);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }

        try {
            // Mail::raw(
            //     "Message from: {$data['email']}\n\n{$data['message']}",
            //     function ($message) use ($data) {
            //         $message->to('shaiqueaijaz.9434@gmail.com') // Recipient email
            //                 ->subject($data['subject']);        // Subject of the email
            //     }
            // );

            SendEmailJob::dispatch($data);

        
            return response()->json(['message' => 'Your message has been sent successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
