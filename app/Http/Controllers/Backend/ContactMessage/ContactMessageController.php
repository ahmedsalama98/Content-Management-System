<?php

namespace App\Http\Controllers\Backend\ContactMessage;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:contact-messages-read'])->only(['index']);
        $this->middleware(['permission:contact-messages-update'])->only(['read']);
        $this->middleware(['permission:contact-messages-delete'])->only(['destroy']);

    }

    public function index(Request $request){
        $search = $request->search?? null;
        $only = isset($request->only)&& ( $request->only ==0 || $request->only ==1)?$request->only:null;
        $sorted_by = isset($request-> sorted_by )&& ( $request-> sorted_by=='created_at'||$request-> sorted_by=='message'||$request-> sorted_by=='name' ||$request-> sorted_by=='subject' )?$request->sorted_by :'created_at';
        $order_by = isset($request->order_by )&& ( $request->order_by=='desc' ||$request->order_by=='asc' )?$request->order_by :'desc';
        $limit = isset($request->limit ) && filter_var($request->limit , FILTER_VALIDATE_INT)? $request->limit:5;

        if($limit> 500){
            $limit= 500;
        }

        $messages = Contact::where( function($q) use( $search){
                    return $q->when(  $search , function($q)use( $search){

                        return  $q->where('message' ,'like', '%'.$search .'%')
                                  ->orWhere('email' ,'like', '%'.$search .'%')
                                  ->orWhere('subject' ,'like', '%'.$search .'%')
                                  ->orWhere('name' ,'like', '%'.$search .'%');
                    });
                 })
                 ->where(function($q)use($only){
                     return $q->when($only, function($q)use($only){
                        return $q->whereStatus($only);
                     });
                 })
                 ->orderBy($sorted_by , $order_by)->paginate($limit);



        return view('backend.contact-message.index' , compact('messages'));
    }

    public function read(Request $request , $id){

        $message = Contact::findOrfail($id);

        $message->update([
            'status'=>1
        ]);
        return $this->sendResponse([],'Message Readed Succesfully');

    }

    public function destroy(Request $request , $id){

        $message = Contact::findOrfail($id);

        $message->delete();
        return $this->sendResponse([],'Message Deleted Succesfully');
    }
}
