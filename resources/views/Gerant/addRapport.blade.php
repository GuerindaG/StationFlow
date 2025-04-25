<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>StationFlow - Gestion</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('./assets/images/favicon/stationflow-favicon.svg')}}">

    @include('Gerant.css')

    @include('Gerant.js')

</head>


<body>
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-glass row">
                <div class="dashboard_bar col-lg-12 text-end">
                    <h2>Tableau de bord JNP 050506</h2>
                </div>
            </nav>
        </div>
    </div>
    <div class="main-wrapper">

        @include('Gerant.navbar')

        <main class="main-content-wrapper">
            <section class="container">

                <div class="row">
                    <div class="col-xl-12 col-12 mb-5">
                        <div class="card h-100 card-lg">
                            <div class="card-body p-6">
                                <div class="d-md-flex justify-content-between align-items-center mb-4">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h2 class="mb-0">Rapport du : Date</h2>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3 mt-md-0">
                                        <button class="btn btn-primary" onclick="genererPDF()">
                                            <i class="fas fa-download me-1"></i> Télécharger
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="section">
                                <div class="col-12">
                                    <div class="accordion" id="faqAccordion">
                                        <!-- Produits Blancs -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fas fa-gas-pump me-2"></i> Produits Blancs
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    <h6>Stock et Mouvements</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Produit</th>
                                                                    <th class="text-right">Stock Initial</th>
                                                                    <th class="text-right">Réceptions</th>
                                                                    <th class="text-right">Sorties</th>
                                                                    <th class="text-right">Stock Final</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Gasoil</td>
                                                                    <td class="text-right"> L</td>
                                                                    <td class="text-right"> L</td>
                                                                    <td class="text-right"> L</td>
                                                                    <td class="text-right"> L</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Essence</td>
                                                                    <td class="text-right"> L</td>
                                                                    <td class="text-right"> L</td>
                                                                    <td class="text-right"> L</td>
                                                                    <td class="text-right"> L</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <h6>Détail des Réceptions</h6>
                                                    <ul class="reception-list">
                                                        <li>31/01/2025: Gasoil 2000 L, Essence 1000 L</li>
                                                    </ul>
                                                    <h6>Ventes (FCFA)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Mode de paiement</th>
                                                                    <th class="text-right">Gasoil</th>
                                                                    <th class="text-right">Essence</th>
                                                                    <th class="text-right">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tickets Valeurs</td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>JNP Pass</td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comptant</td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                </tr>
                                                                <tr class="total-row">
                                                                    <td>TOTAL</td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Lubrifiants -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="fas fa-oil-can me-2"></i>Lubrifiants
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    <h6>Stock Initial (31/01/2025)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Produit</th>
                                                                    <th class="text-right">Quantité Initiale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Lubrifiant 1</td>
                                                                    <td class="text-right">38</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lubrifiant 2</td>
                                                                    <td class="text-right">30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <h6>Réceptions (31/01/2025)</h6>
                                                    <p>Aucune réception de lubrifiants</p>
                                                    <h6>Sorties (31/01/2025)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Produit</th>
                                                                    <th class="text-right">Quantité Vendue</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>VUL 660X 15w40</td>
                                                                    <td class="text-right">1</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <h6>Stock Final (01/02/2025)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Produit</th>
                                                                    <th class="text-right">Quantité Finale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Lubrifiant 1</td>
                                                                    <td class="text-right">37</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lubrifiant 2</td>
                                                                    <td class="text-right">30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <h6>Ventes (FCFA)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Mode de paiement</th>
                                                                    <th class="text-right">Montant</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tickets Valeurs</td>
                                                                    <td class="text-right">50000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>JNP Pass</td>
                                                                    <td class="text-right">25000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comptant</td>
                                                                    <td class="text-right">75000</td>
                                                                </tr>
                                                                <tr class="total-row">
                                                                    <td>TOTAL</td>
                                                                    <td class="text-right">150000</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Recharges Gaz et Accessoires -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    <i class="fas fa-fire-flame-simple me-2"></i> Gaz et Accessoires
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    <h6>Stock Initial (31/01/2025)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Produit</th>
                                                                    <th class="text-right">Quantité Initiale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Recharge 6kg</td>
                                                                    <td class="text-right">38</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Recharge 12kg</td>
                                                                    <td class="text-right">30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <h6>Réceptions (31/01/2025)</h6>
                                                    <p>Aucune réception de gaz et accessoires</p>
                                                    <h6>Sorties (31/01/2025)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Produit</th>
                                                                    <th class="text-right">Quantité Vendue</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Recharge 6kg</td>
                                                                    <td class="text-right">3</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Recharge 12kg</td>
                                                                    <td class="text-right">7</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <h6>Stock Final (01/02/2025)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Produit</th>
                                                                    <th class="text-right">Quantité Finale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Recharge 6kg</td>
                                                                    <td class="text-right">3</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Recharge 12kg</td>
                                                                    <td class="text-right">7</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <h6>Ventes (FCFA)</h6>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-centered">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Mode de paiement</th>
                                                                    <th class="text-right">Montant</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tickets Valeurs</td>
                                                                    <td class="text-right">30000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>JNP Pass</td>
                                                                    <td class="text-right">15000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comptant</td>
                                                                    <td class="text-right">55000</td>
                                                                </tr>
                                                                <tr class="total-row">
                                                                    <td>TOTAL</td>
                                                                    <td class="text-right">100000</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Informations Complémentaires -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">
                                                    Informations Complémentaires
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h6>Informations sur les Ventes</h6>
                                                            <div class="info-grid">
                                                                <div class="info-card">
                                                                    <div class="label">TV</div>
                                                                    <div class="value">50000 F</div>
                                                                </div>
                                                                <div class="info-card">
                                                                    <div class="label">Reste à Verser</div>
                                                                    <div class="value">20000 F</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h6>Livraisons en Attente (01/02/2025)</h6>
                                                            <div class="info-grid">
                                                                <div class="info-card blue-bg">
                                                                    <div class="label">Gasoil</div>
                                                                    <div class="value">3000 L</div>
                                                                </div>
                                                                <div class="info-card green-bg">
                                                                    <div class="label">Essence</div>
                                                                    <div class="value">2000 L</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-6">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-lg-6">
                                        Rapport généré le <span id="generated-date"></span> | Validé par: Nom du Gérant
                                    </div>
                                    <div class="col-md-6 col-lg-6 text-end">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </main>
    </div>

    @include('Gerant.js')

</body>

</html>