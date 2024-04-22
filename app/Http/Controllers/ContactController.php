<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRequestFronContactUs;
use App\Mail\SendReplyFronContactUs;

class ContactController extends Controller
{
    //
    public function index()
    {
        $contacts = Contact::all(); // Fetch all contacts

        return response()->json(['contacts' => $contacts]);
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'subject' => 'nullable',
            'last_name' => 'nullable', // Include lastname validation if needed
            'message' => 'nullable',  // Include message validation if needed
        ]);
        $contact = Contact::create($validatedData);
        Mail::to('info@cryptowizguy.com')->send(new SendRequestFronContactUs($contact));
        return response()->json(['message' => 'Contact information saved!', 'contact' => $contact]);
    }

    public function ReplyUser(Request $request)
    {

        $contact = Contact::find($request->contact_id); // Fetch the contact details from $request or database
        // Adjust the below line to your mailable and recipient
        Mail::to($contact->email)->send(new SendReplyFronContactUs($contact, $request->message));

        return response()->json(['message' => 'Reply sent successfully', 'status' => 'success']);

    }
    public function ContactUpdateStatus(Request $request)
    {
// dd( $request->status);
        try {
            $contact = Contact::where('email',$request->email)->first();

            // Update the status
            $contact->update(['status' => $request->status]);

            return response()->json(['message' => 'Status updated successfully', 'data' => $contact,'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating status', 'message' => $e->getMessage()], 500);
        }
    }

}
