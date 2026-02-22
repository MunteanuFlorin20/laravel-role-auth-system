<div class="modal-header border-0 pb-0">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-success bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center"
            style="width: 48px; height: 48px;">
            <i class="bi bi-pencil-square text-success fs-4"></i>
        </div>
        <div>
            <h5 class="modal-title fw-bold mb-0">Editează utilizator</h5>
            <small class="text-muted">{{ $item->name }} {{ $item->forename }} · {{ $item->email }}</small>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form method="POST" action="{{ url($link . '/' . $item->id . '/update') }}" class="dev-form">
    @csrf
    @method('PUT')

    <div class="modal-body pt-4">
        <div class="row g-4">
            <div class="col-md-6">
                <h6 class="fw-semibold text-muted text-uppercase small mb-3">
                    <i class="bi bi-person me-1"></i> Date personale
                </h6>

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small">Prenume</label>
                    <input type="text" class="form-control bg-light" name="name"
                        value="{{ old('name', $item->name) }}" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="forename" class="form-label fw-semibold small">Nume</label>
                    <input type="text" class="form-control bg-light" name="forename"
                        value="{{ old('forename', $item->forename) }}" id="forename" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold small">
                        Parolă nouă
                        <span class="fw-normal text-muted">· opțional</span>
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control bg-light border-end-0" name="password" id="password"
                            placeholder="Lasă gol pentru a păstra actuala">
                        <span class="input-group-text bg-light border-start-0 btn-password" role="button">
                            <i class="bi bi-eye-slash text-muted"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-0">
                    <label for="repassword" class="form-label fw-semibold small">Confirmă parola nouă</label>
                    <div class="input-group">
                        <input type="password" class="form-control bg-light border-end-0" name="repassword"
                            id="repassword" placeholder="Lasă gol pentru a păstra actuala">
                        <span class="input-group-text bg-light border-start-0 btn-password" role="button">
                            <i class="bi bi-eye-slash text-muted"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h6 class="fw-semibold text-muted text-uppercase small mb-3">
                    <i class="bi bi-gear me-1"></i> Cont & Acces
                </h6>

                <div class="mb-3">
                    <label for="edit-email" class="form-label fw-semibold small">Email</label>
                    <input type="email" class="form-control bg-light" name="email"
                        value="{{ old('email', $item->email) }}" id="edit-email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold small">Telefon</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <small class="text-muted">+40</small>
                        </span>
                        <input type="text" class="form-control bg-light" name="phone"
                            value="{{ old('phone', $item->phone) }}" id="phone" placeholder="7XX XXX XXX" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="access_level" class="form-label fw-semibold small">Nivel de acces</label>
                    <select name="access_level" id="access_level" class="form-select bg-light select2" required>
                        @foreach (App\Models\Page::access() as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('access_level', $item->access_level) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-0">
                    <label class="form-label fw-semibold small d-block">Status cont</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="activ" value="1"
                            id="editActivSwitch" {{ old('activ', $item->activ) ? 'checked' : '' }}>
                        <label class="form-check-label small" for="editActivSwitch" id="editActivLabel">
                            @if (old('activ', $item->activ))
                                <span
                                    class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1">Activ</span>
                            @else
                                <span
                                    class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-2 py-1">Inactiv</span>
                            @endif
                        </label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer border-0 pt-0 d-flex justify-content-between">
        <small class="text-muted">
            <i class="bi bi-clock-history me-1"></i>
            Creat {{ $item->created_at->diffForHumans() }}
        </small>
        <div>
            <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Anulează</button>
            <button type="submit" class="btn btn-success rounded-3 px-4">
                <i class="bi bi-check-lg me-1"></i> Actualizează
            </button>
        </div>
    </div>
</form>

@include('admin/partials/ajax-form', ['form' => '.dev-form'])

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

    document.getElementById('editActivSwitch')?.addEventListener('change', function() {
        const label = document.getElementById('editActivLabel');
        if (this.checked) {
            label.innerHTML =
                '<span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1">Activ</span>';
        } else {
            label.innerHTML =
                '<span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-2 py-1">Inactiv</span>';
        }
    });
</script>
