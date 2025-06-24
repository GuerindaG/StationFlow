@extends('Admin.LayoutAdmin')
@section('content-body')
    <section class="col-lg-12 col-md-12">
        <div class="card mb-4 bg-light border-0">
            <div class="card-body p-4 ">
                <h2 class="mb-0 fs-1">Rapports du jour </h2>
            </div>
        </div>
        <div class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
            @foreach($rapports as $rapport)
                <div class="col">
                    <div class="card card-product"
                        ondblclick="window.open('{{ route('rapports.journalier.voir', ['station' => $rapport->station_id, 'date' => $rapport->date]) }}', '_blank')">
                        <div class="card-body">
                            <div class="text-center position-relative">
                                <i class="fa-solid fa-file-lines fa-5x text-grey"></i>
                            </div>
                            <div class="text-small mb-1 p-4">
                                <h2 class="fs-6 text-center">
                                    R-{{ $rapport->station->nom }}<br>
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::parse($rapport->date)->format('d/m/Y') }}</small>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection