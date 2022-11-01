<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $search = $request->search;

        if($search != ""){
            $emails = Email::where(function ($query) use ($search, $user){
                $query->where('user_id', $user->id)
                    ->where('subject', 'like', '%'.$search.'%')
                    ->orWhere('recipient', 'like', '%'.$search.'%');
            })
            ->sortable()
            ->paginate(env('PAGINATION_MAX'));
            $emails->appends(['q' => $search]);
        } else{
            $emails = Email::where('user_id', $user->id)->sortable()->paginate(env('PAGINATION_MAX'));
        }

        return view('emails.index', ['emails' => $emails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:50'],
            'recipient' => ['required', 'max:100', 'email'],
            'message' => ['required', 'max:200'],
        ]);

        $user = Email::create([
            'subject' => $request->subject,
            'recipient' => $request->recipient,
            'message' => $request->message,
            'user_id' => Auth::user()->id
        ]);

        return redirect('emails/'.Auth::user()->id)
            ->with('success', 'Email Created Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Email $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();

        return redirect('/emails/'.Auth::user()->id)
            ->with('success', 'Email Deleted Successfully.');
    }
}
