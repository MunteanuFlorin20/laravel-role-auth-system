<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/css/swipebox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="admin.css">

    @yield('css')
</head>

<body>
    <div class="d-flex" id="wrapper">
        <aside id="sidebar-wrapper">
            <div class="sidebar-heading text-center fw-bold fs-2">
                Admin Panel
            </div>

            <div class="list-group rounded-0 sidebar">
                @include('admin.partials.sidebar')
            </div>
        </aside>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-light bg-light border-bottom px-3">
                <button class="btn btn-outline-secondary" id="menu-toggle">
                    <i class="bi bi-list"></i>
                </button>
            </nav>

            <main class="container-fluid p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <div class="modal fade" id="modal-window" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>

    <div class="modal" id="mini-modal-window" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/js/jquery.swipebox.min.js"></script>

    {{-- <script src="/admin/ckeditor/ckeditor.js"></script>
    <script src="/admin/js/bootstrap-treefy.min.js"></script>
    <script src="/admin/js/nestable.js"></script>
    <script src="/admin/js/perfect-scrollbar.jquery.min.js"></script> --}}
    <script src="admin.js"></script>

    @yield('scripts')

    <script>
        const modalEl = document.getElementById('modal-window');

        modalEl.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            if (!button) return;

            const url = button.getAttribute('data-url');
            if (!url) return;

            const content = modalEl.querySelector('.modal-content');
            content.innerHTML = '<div class="p-4 text-center">Loading...</div>';

            fetch(url)
                .then(res => res.text())
                .then(html => {
                    content.innerHTML = html;
                });
        });
    </script>

    <script>
        const miniModalEl = document.getElementById('mini-modal-window');

        miniModalEl.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            if (!button) return;

            const url = button.getAttribute('data-url');
            if (!url) return;

            const content = miniModalEl.querySelector('.modal-content');
            content.innerHTML = '<div class="p-3 text-center">Loading...</div>';

            fetch(url)
                .then(res => res.text())
                .then(html => {
                    content.innerHTML = html;
                });
        });
    </script>
</body>

</html>
