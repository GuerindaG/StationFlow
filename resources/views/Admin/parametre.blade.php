@extends('Admin.LayoutAdmin')

@section('content-body')
    <div class="row">
        <div class="col-lg-12 col-md-8 col-12">
            <div class="py-6 p-md-6 p-lg-10">

                {{-- Message Flash --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card card-lg border-0 mb-5">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fa fa-user-edit"></i> Modifier mon profil</h2>
                    </div>
                    <div class="card-body d-flex flex-column gap-4 p-6">
                        <form id="profile-form" class="row g-3 needs-validation" action="{{ route('profile.update') }}"
                            method="POST" novalidate>
                            @csrf
                            <div class="form-legend">Champs marqués d'un <span class="text-danger">*</span> obligatoires
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" name="name"
                                    value="{{ old('name', Auth::user()->name) }}" required>
                                <div class="invalid-feedback">Veuillez entrer votre nom</div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="prenom" class="form-label">Prénoms <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                    value="{{ old('prenom', Auth::user()->prenom) }}" required>
                                <div class="invalid-feedback">Veuillez entrer vos prénoms</div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}" required>
                                <div class="invalid-feedback">Veuillez entrer un email valide</div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="telephone" class="form-label">Téléphone <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="telephone" name="telephone"
                                    value="{{ old('telephone', Auth::user()->telephone) }}" required>
                                <div class="invalid-feedback">Veuillez entrer votre numéro</div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <label for="date_naissance" class="form-label">Date de naissance <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance"
                                    value="{{ old('date_naissance', Auth::user()->date_naissance) }}" required>
                                <div class="invalid-feedback">Veuillez entrer votre date de naissance</div>
                            </div>

                            <div class="col-12 d-flex gap-3 mt-3">
                                <button class="btn btn-primary" type="submit">Mettre à jour</button>
                                <button class="btn btn-secondary" type="reset">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Suppression compte --}}
                <div class="card card-lg border-0">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fa fa-trash"></i> Supprimer mon compte</h2>
                    </div>
                    <div class="card-body p-6 d-flex flex-column gap-4">
                        <div class="alert alert-warning">
                            <strong>Attention !</strong> Cette action est irréversible.<br>
                            Ce compte contient <strong>12 commandes</strong>. Leur suppression est définitive.
                        </div>

                        <div>
                            <input type="checkbox" id="confirm-delete">
                            <label for="confirm-delete">Je comprends que cette action est irréversible</label>
                        </div>

                        <button type="button" class="btn btn-danger" id="delete-account" disabled>Supprimer mon
                            compte</button>

                        <form id="delete-form" action="{{ route('profile.destroy') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>

                {{-- Modal --}}
                <div class="modal" id="confirmation-modal" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-5">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirmation</h5>
                                <button type="button" class="btn-close close-modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Vous êtes sur le point de supprimer définitivement votre compte.</p>
                                <p>Tapez <strong>"SUPPRIMER"</strong> pour confirmer :</p>
                                <input type="text" id="confirmation-text" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-modal">Annuler</button>
                                <button type="button" class="btn btn-danger" id="confirm-final-delete" disabled>Supprimer
                                    définitivement</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmCheckbox = document.getElementById('confirm-delete');
            const deleteBtn = document.getElementById('delete-account');
            const modal = document.getElementById('confirmation-modal');
            const modalInput = document.getElementById('confirmation-text');
            const confirmFinalDelete = document.getElementById('confirm-final-delete');
            const deleteForm = document.getElementById('delete-form');

            confirmCheckbox.addEventListener('change', () => {
                deleteBtn.disabled = !confirmCheckbox.checked;
            });

            deleteBtn.addEventListener('click', () => {
                modal.style.display = 'block';
            });

            modalInput.addEventListener('input', () => {
                confirmFinalDelete.disabled = modalInput.value !== 'SUPPRIMER';
            });

            document.querySelectorAll('.close-modal, .btn-close').forEach(btn => {
                btn.addEventListener('click', () => {
                    modal.style.display = 'none';
                    modalInput.value = '';
                    confirmFinalDelete.disabled = true;
                });
            });

            confirmFinalDelete.addEventListener('click', () => {
                deleteForm.submit();
            });

            // Validation HTML5
            const form = document.getElementById('profile-form');
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    </script>
@endsection