<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mensaje' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file->store('contacts');
        }

        Mail::to('test@example.com')->send(new ContactMailable($data));

        // session()->flash('swal', [
        //     'toast' => true,
        //     'position' => 'top-end',
        //     'icon' => 'success',
        //     'title' => '¡Mensaje enviado!',
        //     'showConfirmButton' => false,
        //     'timer' => 3000,
        //     'timerProgressBar' => true,
        // ]);

        session()->flash('flash.banner', 'El correo se envio exitosamente');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('contacts.index');
    }
}
