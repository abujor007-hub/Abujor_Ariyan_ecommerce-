
@if ($errors->any())
    @foreach ($errors->all() as $error)

        <div class="toast-container position-fixed top-0 end-0 p-3">

            <div class="toast show text-bg-danger border-0" role="alert">

                <div class="d-flex">

                    <div class="toast-body">
                        <strong>Error!</strong> {{ $error }}
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>

                </div>

            </div>

        </div>

    @endforeach
@endif


@if (session('error'))

    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div class="toast show text-bg-danger border-0" role="alert">

            <div class="d-flex">

                <div class="toast-body">
                    <strong>Error!</strong> {{ session('error') }}
                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                </button>

            </div>

        </div>

    </div>

@endif


@if (session('success'))

    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div class="toast show text-bg-success border-0" role="alert">

            <div class="d-flex">

                <div class="toast-body">
                    <strong>Success!</strong> {{ session('success') }}
                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                </button>

            </div>

        </div>

    </div>

@endif