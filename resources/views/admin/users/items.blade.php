@if ($items->total() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 text-muted small fw-semibold text-uppercase" style="width: 60px;">#</th>
                    <th class="text-muted small fw-semibold text-uppercase">Utilizator</th>
                    <th class="text-muted small fw-semibold text-uppercase">Rol</th>
                    <th class="text-muted small fw-semibold text-uppercase text-end pe-4">Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr id="{{ $item->id }}">
                        <td class="ps-4 text-muted small">{{ $item->id }}</td>

                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width: 42px; height: 42px;">
                                    <span class="text-primary fw-bold">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}{{ strtoupper(substr($item->forename ?? '', 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $item->name }} {{ $item->forename }}</div>
                                    <small class="text-muted">{{ $item->email }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            @switch($item->access_level)
                                @case('10')
                                    <span class="badge bg-success text-white rounded-pill px-3 py-2">
                                        <i class="bi bi-shield-check me-1"></i>Admin
                                    </span>
                                @break

                                @case('5')
                                    <span class="badge bg-danger text-white rounded-pill px-3 py-2">
                                        <i class="bi bi-star me-1"></i>Owner
                                    </span>
                                @break

                                @case('1')
                                    <span class="badge bg-info text-white rounded-pill px-3 py-2">
                                        <i class="bi bi-person me-1"></i>Client
                                    </span>
                                @break

                                @default
                                    <span class="badge bg-secondary text-white rounded-pill px-3 py-2">
                                        <i class="bi bi-person-slash me-1"></i>Fără cont
                                    </span>
                            @endswitch
                        </td>

                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-outline-secondary toggle-active"
                                    data-url="{{ route('admin.users.visibility', $item->id) }}"
                                    title="{{ $item->activ ? 'Dezactivează' : 'Activează' }}">
                                    <i class="bi {{ $item->activ ? 'bi-eye' : 'bi-eye-slash' }}"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#modal-window"
                                    data-url="{{ route('admin.users.edit', $item->id) }}" title="Editează">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#mini-modal-window"
                                    data-url="{{ $link }}/{{ $item->id }}/delete" title="Șterge">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-center px-4 py-3 border-top">
        <small class="text-muted">
            Afișare {{ $items->firstItem() }}–{{ $items->lastItem() }} din {{ $items->total() }}
        </small>
        <div>
            {!! $items->links() !!}
        </div>
    </div>
@else
    <div class="text-center py-5">
        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
            style="width: 80px; height: 80px;">
            <i class="bi bi-people text-muted fs-1"></i>
        </div>
        <h5 class="text-muted">Niciun utilizator</h5>
        <p class="text-muted mb-0">Lista utilizatorilor este momentan goală.</p>
    </div>
@endif

<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.toggle-active');
        if (!btn) return;
        e.preventDefault();

        fetch(btn.dataset.url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                const icon = btn.querySelector('i');
                const row = btn.closest('tr');
                const statusCell = row.querySelector('td:nth-child(4)');

                // Toggle icon
                icon.classList.toggle('bi-eye', data.activ);
                icon.classList.toggle('bi-eye-slash', !data.activ);
                btn.title = data.activ ? 'Dezactivează' : 'Activează';

                // Toggle status indicator
                if (data.activ) {
                    statusCell.innerHTML = `
                    <span class="d-inline-flex align-items-center gap-1">
                        <span class="bg-success rounded-circle d-inline-block" style="width: 8px; height: 8px;"></span>
                        <small class="text-success fw-semibold">Activ</small>
                    </span>`;
                } else {
                    statusCell.innerHTML = `
                    <span class="d-inline-flex align-items-center gap-1">
                        <span class="bg-secondary rounded-circle d-inline-block" style="width: 8px; height: 8px;"></span>
                        <small class="text-muted fw-semibold">Inactiv</small>
                    </span>`;
                }
            });
    });
</script>
