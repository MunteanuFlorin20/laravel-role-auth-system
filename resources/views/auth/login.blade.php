@extends('auth.app')

@section('content')
    <div class="min-vh-100 d-flex align-items-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-6 col-lg-4">

                    <div class="text-center mb-4">
                        {{-- Logo sau icon --}}
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 64px; height: 64px;">
                            <i class="bi bi-shield-lock-fill text-primary fs-2"></i>
                        </div>
                        <h2 class="fw-bold mb-1">Bine ai revenit!</h2>
                        <p class="text-muted">Conectează-te pentru a continua</p>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf

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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="password" class="form-label fw-semibold small mb-0">Parolă</label>
                                        <a href="#" class="small text-decoration-none">Ai uitat parola?</a>
                                    </div>
                                    <div class="input-group mt-1">
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

                                {{-- Remember me --}}
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small" for="remember">Ține-mă minte</label>
                                </div>

                                {{-- Submit --}}
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold rounded-3">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Conectare
                                </button>
                            </form>
                        </div>
                    </div>

                    <p class="text-center text-muted small mt-4">
                        Nu ai cont? <a href="/register" class="fw-semibold text-decoration-none">Creează unul</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelector('.btn-password').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        });
    </script>
@endsection
