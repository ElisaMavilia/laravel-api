<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'address' => 'required|email',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                // 'message' => $validator->errors(),
                // la funzione errors() della classe Validator resituisce un array
                // in cui la chiave è il campo soggetto a validazione
                // e il valore è un array di messaggi di errore
                'errors' => $validator->errors()
            ], 400);
        }

        $lead = new Lead();
        $lead->fill ($data);
        $lead->save();

        Mail::to('info@esercizi_boolean')->send(new NewContact($lead)); // serve per mandare l'email all'indirizzo fornito

        return response()->json([ // restituisce una risposta dal controller al client che ha effettuato la richiestas HTTP, l'array associativo passato come argomento a questo metodo viene convertito in JSON
            'status' => 'success',
            'message' => 'Ok',
        ], 200);
    }
}
