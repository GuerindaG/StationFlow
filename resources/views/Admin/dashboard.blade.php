@extends('Admin.LayoutAdmin')
@section('content-body')
<!--AFFICHAGE DES RAPPORTS DU JOUR POUR TOUTES -->
    <section class="col-lg-12 col-md-12">
        <div class="card mb-4 bg-light border-0">
            <div class="card-body p-4 ">
                <h2 class="mb-0 fs-1">Rapports du jour </h2>
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
                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Quick View"></i>
                                </a>
                                <!-- Une seule action voir qui sera un target dans un nouvel onglet pour afficher le rapport sous 
                                      format pdf avec option de telechargement du navigateur. Du coté du gerant ce n'est qu'apres validation que le rapport
                                      apparaitra sur le dashbord admin avec la date d'envoie et une notification mail addressé à l'admin comme quoi vous avez recu votre rapport; connectez vous pour voir
                                      .Du coup je dois ajouter une section notification au dashboard de l'admin -->
                            </div>
                        </div>
                        <div class="text-small mb-1 p-4">
                            <h2 class="fs-6 text-center">R-Station</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection