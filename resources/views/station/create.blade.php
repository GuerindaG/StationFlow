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
                        <h2>Créer la station</h2>
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
                    <form action="{{ route('station.store') }}" method="POST">
                        @csrf
                        <div class="card-body p-6">
                            <div class="row">
                                <!-- input -->
                                <div class="mb-3 col-lg-12">
                                    <label class="form-label">
                                        <h4 class=" h5">Nom de la station</h4>
                                    </label>
                                    <input type="text" class="form-control" name="nom_station" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">RCCM</h4>
                                    </label>
                                    <input type="text" name="rccm" class="form-control" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">IFU</h4>
                                    </label>
                                    <input type="text" name="ifu" class="form-control" placeholder="" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Adresse</h4>
                                    </label>
                                    <input type="text" class="form-control" name="adresse" placeholder="" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Longitude</h4>
                                    </label>
                                    <input type="text" class="form-control" name="longitude" placeholder="Ex: 2.370292" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Latitude</h4>
                                    </label>
                                    <input type="text" class="form-control" name="latitude" placeholder="Ex: 6.370292" required />
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Contact</h4>
                                    </label>
                                    <input type="text" name="contact" class="form-control" placeholder="" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Email</h4>
                                    </label>
                                    <input type="email" name="email_gerant" class="form-control" placeholder="" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">
                                        <h4 class="h5">Mot de passe</h4>
                                    </label>
                                    <div class="password-field position-relative">
                                        <input type="password" class="form-control fakePassword" name="password_gerant"
                                            required />
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-end">
                                    <button class="btn btn-primary w-100" type="submit">Créer la station</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection