<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Tampilkan semua pesan masuk untuk admin
    public function index()
    {
        // Ambil semua pesan terbaru, 10 per halaman
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contact.index', compact('contacts'));
    }

    // Lihat detail pesan
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.contact.show', compact('contact'));
    }

    // Balas pesan ke email pengirim
    public function reply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $data = $request->validate([
            'reply' => 'required|string',
        ]);

        // Kirim email balasan ke pengirim
        Mail::raw($data['reply'], function ($mail) use ($contact) {
            $mail->to($contact->email)
                ->subject('Balasan dari Toko Brodeh Oi');
        });

        // Simpan balasan di database
        $contact->reply = $data['reply'];
        $contact->replied_at = now();
        $contact->save();

        return back()->with('success', 'Balasan berhasil dikirim ke ' . $contact->email);
    }

    // Method untuk form publik
public function send(Request $request)
{
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'message' => 'required|string',
    ]);

    // Simpan ke database
    Contact::create($data);

    // Kirim email ke toko
    Mail::to('brodehoi@gmail.com')->send(new ContactMail($data));

    // ✅ PENTING: pakai redirect, bukan back()
    return redirect()->route('contact') // sesuaikan dengan route form kamu
        ->with('success', 'Pesan Anda berhasil dikirim!');
}
}
