@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        {{-- Header --}}
        <h3 class="fw-bold mb-3 text-dark">
            <i class="bi bi-envelope-paper text-primary me-2"></i> Detail Pesan
        </h3>
        <p class="text-muted mb-4">Lihat detail pesan dan kirim balasan</p>

        <div class="row g-4">
            {{-- Detail Pesan --}}
            <div class="col-lg-5">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <p><strong>Nama:</strong> {{ $contact->name }}</p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                        <p><strong>Dikirim:</strong> {{ $contact->created_at->format('d M Y, H:i') }}</p>
                        <hr>
                        <p><strong>Pesan:</strong></p>
                        <div class="bg-light p-3 rounded">{{ $contact->message }}</div>

                        @if($contact->reply)
                            <hr>
                            <p><strong>Balasan Sebelumnya:</strong></p>
                            <div class="bg-success bg-opacity-10 p-3 rounded">{{ $contact->reply }}</div>
                            <small class="text-muted">Dibalas: {{ $contact->updated_at->format('d M Y, H:i') }}</small>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Form Balasan --}}
            <div class="col-lg-7">
                <div class="card shadow">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="reply" class="form-label fw-semibold">Balas Pesan</label>
                                <textarea id="reply" name="reply" rows="6" required
                                    class="form-control @error('reply') is-invalid @enderror"
                                    placeholder="Tulis balasan Anda">{{ old('reply') }}</textarea>
                                @error('reply')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="bi bi-send-fill me-1"></i> Kirim Balasan
                                </button>
                                <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary flex-fill">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </div>
@endsection