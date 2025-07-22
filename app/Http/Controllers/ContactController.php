<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //

    public function addcontact()
    {
        return view("contacts.add");
    }

    public function savecontact(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $contact = Contact::create([
            'user_id' => Auth::id(),
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
        ]);

        return redirect()->back()->with("success", 'Contact ajouté avec succès.');

    }

    public function contacts(Request $request)
    {

        $query = Contact::where("user_id", Auth::id());

        if($request->filled('search')){
            $query->where('name',"like",'%'.$request->search.'%');
        }

        $contacts = $query->paginate(5);
        return view('contacts.index', compact('contacts'));

    }
}
