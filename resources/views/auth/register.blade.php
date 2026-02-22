@extends('auth.app')

@section('content')
    <div class="min-vh-100 d-flex align-items-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-6 col-lg-4">

                    <div class="text-center mb-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 64px; height: 64px;">
                            <i class="bi bi-person-plus-fill text-success fs-2"></i>
                        </div>
                        <h2 class="fw-bold mb-1">Creează cont</h2>
                        <p class="text-muted">Completează datele pentru a te înregistra</p>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf

                                {{-- Nume --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold small">Nume</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-person text-muted"></i>
                                        </span>
                                        <input type="text" id="name" name="name"
                                            class="form-control border-start-0 bg-light @error('name') is-invalid @enderror"
                                            placeholder="Numele tău complet" value="{{ old('name') }}" required>
                                    </div>
                                    @error('name')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold small">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input type="email" id="email" name="email"
                                            class="form-control border-start-0 bg-light @error('email') is-invalid @enderror"
                                            placeholder="nume@exemplu.com" value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Parolă --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold small">Parolă</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-lock text-muted"></i>
                                        </span>
                                        <input type="password" id="password" name="password"
                                            class="form-control border-start-0 border-end-0 bg-light @error('password') is-invalid @enderror"
                                            placeholder="••••••••" required>
                                        <span class="input-group-text bg-light border-start-0 btn-password" role="button">
                                            <i class="bi bi-eye-slash text-muted"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Confirmă parola --}}
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold small">Confirmă
                                        parola</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-lock-fill text-muted"></i>
                                        </span>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control border-start-0 border-end-0 bg-light @error('password_confirmation') is-invalid @enderror"
                                            placeholder="••••••••" required>
                                        <span class="input-group-text bg-light border-start-0 btn-password" role="button">
                                            <i class="bi bi-eye-slash text-muted"></i>
                                        </span>
                                    </div>
                                    @error('password_confirmation')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Submit --}}
                                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold rounded-3">
                                    <i class="bi bi-check-circle me-1"></i> Înregistrare
                                </button>
                            </form>
                        </div>
                    </div>

                    <p class="text-center text-muted small mt-4">
                        Ai deja cont? <a href="{{ route('login') }}"
                            class="fw-semibold text-decoration-none">Conectează-te</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.btn-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                }
            });
        });
    </script>
@endsection
