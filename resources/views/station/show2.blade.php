@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="row mb-12">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h2>{{ $station->nom }} : Historique rapports Février </h2>
                </div>
                <div>
                    <form method="GET" class="row g-3 align-items-center">
                        <div class="col-auto">
                            <input type="date" id="date_filter" name="date_filter" class="form-control" value="">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-filter"></i></button>
                            <a href="{{ route('vente.index') }}" class="btn btn-light"><i
                                    class="fa-solid fa-power-off"></i></a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
        <div class="col">
            <div class="card card-product">
                <div class="card-body">
                    <div class="text-center position-relative">
                        <i class="fa-solid fa-file-lines fa-5x text-muted"></i>
                        <div class="card-product-action">
                            <a href="#!" class="btn-action" target="_blank">
                                <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                            </a>
                        </div>
                    </div>
                    <div class="text-small mb-1 p-4">
                        <h2 class="fs-6 text-center">Date</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection