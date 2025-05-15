@extends('Admin.LayoutAdmin')
@section('content-body')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <!-- row -->
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Modifier la station</h2>
                    </div>
                    <div>
                        <a href="{{route('station.index')}}" class="btn btn-light">Retour</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- card -->
                <div class="card mb-6 shadow border-0">
                    <!-- card body -->
                    <form action="{{ route('station.update', $station->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-6">
                            <div class="row">
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class=" h5">Nom de la station</h4>
                                    </label>
                                    <input type="text" class="form-control" name="nom_station" value="{{ old('nom_station', $station->nom) }}" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">RCCM</h4>
                                    </label>
                                    <input type="text" name="rccm" class="form-control" value="{{ old('rccm', $station->rccm) }}" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">IFU</h4>
                                    </label>
                                    <input type="text" name="ifu"  value="{{ old('ifu', $station->ifu) }}" class="form-control" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Adresse</h4>
                                    </label>
                                    <input type="text" class="form-control"  name="adresse" value="{{ old('adresse', $station->adresse) }}" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Longitude</h4>
                                    </label>
                                    <input type="text" class="form-control"  name="longitude" value="{{ old('longitude', $station->longitude) }}" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Latitude</h4>
                                    </label>
                                    <input type="text" class="form-control"  name="latitude" value="{{ old('latitude', $station->latitude) }}" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Contact</h4>
                                    </label>
                                    <input type="text" name="contact" class="form-control" value="{{ old('contact', $station->contact) }}" placeholder="" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="formSignuplname" class="form-label">
                                        <h4 class="h5">Statut</h4>
                                    </label>
                                    <select class="default-select form-control wide" name="statut" required>
                                        <option value="active" {{ $station->statut == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $station->statut == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 text-end">
                                    <button class="btn btn-primary w-100" type="submit">Mettre à jour</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection