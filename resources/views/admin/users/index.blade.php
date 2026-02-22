@extends('admin.layouts')

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 fw-bold mb-1">Utilizatori</h1>
                <p class="text-muted mb-0">
                    <i class="bi bi-people me-1"></i>
                    {{ $items->total() }} {{ $items->total() == 1 ? 'utilizator' : 'utilizatori' }} în total
                </p>
            </div>
            <a href="#" class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#modal-window"
                data-url="{{ $link }}/create">
                <i class="bi bi-plus-lg me-1"></i> Utilizator nou
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="items">
                    @include($folder . '.items', ['items' => $items])
                </div>
            </div>
        </div>
    </div>
@endsection
