@extends('Admin.LayoutAdmin')
@section('content-body')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-8 col-12">
            <div class="py-6 p-md-6 p-lg-10">
                <div class="row mb-6">
                    <h2 class="col-lg-10 mb-0">Mettre à jour mon profil</h2>
                </div>

                <div class="row mb-8 g-5">
                    <div class="col-lg-8 col-12">
                        <div class="card card-lg border-0">
                            <div class="card-body d-flex flex-column gap-8 p-7">
                                <div class="d-flex flex-column gap-4">
                                    <h4 class="mb-0 h5">Vos Informations</h4>
                                    <form class="row g-3 needs-validation" action="{{ route('profile.update') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <div class="col-lg-6 col-12">
                                            <div>
                                                <!-- input -->
                                                <label for="customerEditName" class="form-label">
                                                    Nom
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="customerEditName" name="name" value="" 
                                                    required />
                                                <div class="invalid-feedback">svp entrez votre nom</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div>
                                                <!-- input -->
                                                <label for="customerEditEmail" class="form-label">
                                                    Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" id="customerEditEmail" name="email"
                                                    required />
                                                <div class="invalid-feedback">Svp entrer votre email</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div>
                                                <!-- input -->
                                                <label for="customerEditPhone" class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" id="customerEditPhone"
                                                    name="telephone" required />
                                                <div class="invalid-feedback">Svp entrer votre numéro</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <label class="form-label" for="customerEditBirthdate">Naissance</label>
                                            <input type="text" class="form-control flatpickr" placeholder="Select Date" />
                                            <div class="invalid-feedback">Svp entrer votre date de naissance</div>
                                        </div>
                                        <div>
                                            <div class="row mt-3">
                                                <div class="d-flex flex-column flex-md-row gap-2">
                                                    <button class="btn btn-primary col-lg-6" type="submit">Mettre à
                                                        jour</button>
                                                    <button class="btn btn-secondary col-lg-6" type="reset">Annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card card-lg border-0">
                            <div class="card-body p-6 d-flex flex-column gap-6">
                                <div>
                                    <h4 class="mb-0 h5">Résumé</h4>
                                </div>
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex flex-row justify-content-between">
                                        <span class="fw-medium text-dark">Nom</span>
                                        <span class="fw-medium">2 month ago</span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <span class="fw-medium text-dark">Email</span>
                                        <span class="fw-medium">2 month ago</span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <span class="fw-medium text-dark">Téléphone</span>
                                        <span class="fw-medium">2 month ago</span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <span class="fw-medium text-dark">Anniversaire</span>
                                        <span class="fw-medium">2 month ago</span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <span class="fw-medium text-dark">Date de création </span>
                                        <span class="fw-medium">8 month ago</span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <span class="fw-medium text-dark">Dernière modification</span>
                                        <span class="fw-medium">2 month ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-8 g-5">
                    <div class="col-lg-4 col-12">
                        <div class="card card-lg border-0">
                            <div class="card-body p-6 d-flex flex-column gap-6">
                                <div>
                                    <h5 class="mb-4">Delete Account</h5>
                                    <p class="mb-2">Would you like to delete your account?</p>
                                </div>
                                <p class="mb-5">This account contain 12 orders, Deleting your account will remove all the
                                    order details associated with it.</p>
                                <a href="#" class="btn btn-outline-danger">Suprimer mon compte</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="card card-lg border-0">
                            <div class="card-body d-flex flex-column gap-8 p-7">
                                <div class="d-flex flex-column gap-4">
                                    <h4 class="mb-0 h5">Mot de passe </h4>
                                    <form class="row g-3 needs-validation" novalidate>
                                        <!-- input -->
                                        <div class="mb-3 col">
                                            <label for="customerEditName" class="form-label">
                                                Nouveau mot de passe
                                                <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="**********" />
                                        </div>
                                        <!-- input -->
                                        <div class="mb-3 col">
                                            <label for="customerEditName" class="form-label">
                                                Ancien Mot de passe
                                                <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="**********" />
                                        </div>
                                        <!-- input -->
                                        <div class="col-12">
                                            <p class="mb-4 ">
                                                Can’t remember your current password?
                                                <a href="#">Reset your password.</a>
                                            </p>
                                            <button class="w-100 btn btn-primary">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection