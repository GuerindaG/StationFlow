<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Gestion des Ventes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-header-tabs .nav-link {
            color: #6c757d;
            font-weight: 500;
        }

        .card-header-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }

        .btn-filter {
            min-width: 100px;
        }

        .table th {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .badge-clickable {
            cursor: pointer;
        }

        .pagination {
            margin-bottom: 0;
        }

        .search-container {
            position: relative;
        }

        .search-container .fa-search {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #6c757d;
        }

        .search-input {
            padding-left: 30px;
        }

        .card-stats {
            transition: all 0.3s;
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .export-btn {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gestion des Ventes</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2">Ventes Total</h6>
                                <h2 class="font-weight-bold mb-0">2,356,789 XOF</h2>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle p-2">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-xs">
                            <span class="text-success me-2"><i class="fa fa-arrow-up"></i> 12.48%</span>
                            <span>Depuis le mois dernier</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2">Tickets Valeurs</h6>
                                <h2 class="font-weight-bold mb-0">1,235,600 XOF</h2>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-success text-white rounded-circle p-2">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-xs">
                            <span class="text-success me-2"><i class="fa fa-arrow-up"></i> 8.3%</span>
                            <span>Depuis le mois dernier</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2">JNP Pass</h6>
                                <h2 class="font-weight-bold mb-0">765,430 XOF</h2>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-warning text-white rounded-circle p-2">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-xs">
                            <span class="text-danger me-2"><i class="fa fa-arrow-down"></i> 1.10%</span>
                            <span>Depuis le mois dernier</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2">Comptant</h6>
                                <h2 class="font-weight-bold mb-0">355,759 XOF</h2>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle p-2">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-xs">
                            <span class="text-success me-2"><i class="fa fa-arrow-up"></i> 5.28%</span>
                            <span>Depuis le mois dernier</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date Filter -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <h6 class="mb-0">Filtrer par date</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="endDate">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-filter" id="filterDate">
                                    <i class="fas fa-filter me-2"></i>Filtrer
                                </button>
                                <button class="btn btn-outline-secondary export-btn" id="exportData">
                                    <i class="fas fa-download me-2"></i>Exporter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Sales Management -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
                <div class="card h-100 card-lg mb-5 border-0 shadow-sm">
                    <div class="card-header d-block d-sm-flex align-items-center border-0 bg-white">
                        <div class="mb-3 mb-sm-0">
                            <h3 class="mb-0 fs-5">Historique des bilans de vente</h3>
                        </div>
                        <div class="ms-auto">
                            <ul class="nav nav-tabs card-header-tabs" id="salesTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                        data-bs-target="#all-tab-pane" role="tab">
                                        Toutes les ventes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tv-tab" data-bs-toggle="tab" data-bs-target="#tv-tab-pane"
                                        role="tab">
                                        TV
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="jnp-tab" data-bs-toggle="tab" data-bs-target="#jnp-tab-pane"
                                        role="tab">
                                        JNP Pass
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cash-tab" data-bs-toggle="tab"
                                        data-bs-target="#cash-tab-pane" role="tab">
                                        Comptant
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content" id="salesTabContent">
                            <!-- All Sales Tab -->
                            <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel"
                                aria-labelledby="all-tab" tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;">#</th>
                                                <th>Catégorie</th>
                                                <th>Vente en TV</th>
                                                <th>Vente en JNP PASS</th>
                                                <th>Vente au Comptant</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Produits Blancs</td>
                                                <td>165,000 XOF</td>
                                                <td>125,000 XOF</td>
                                                <td>50,000 XOF</td>
                                                <td>340,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="produits-blancs">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Lubrifiants</td>
                                                <td>425,000 XOF</td>
                                                <td>280,000 XOF</td>
                                                <td>85,000 XOF</td>
                                                <td>790,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="lubrifiants">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Gaz</td>
                                                <td>210,000 XOF</td>
                                                <td>180,000 XOF</td>
                                                <td>95,000 XOF</td>
                                                <td>485,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="gaz">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Accessoires</td>
                                                <td>75,000 XOF</td>
                                                <td>62,000 XOF</td>
                                                <td>48,000 XOF</td>
                                                <td>185,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="accessoires">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- TV Tab -->
                            <div class="tab-pane fade" id="tv-tab-pane" role="tabpanel" aria-labelledby="tv-tab"
                                tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;">#</th>
                                                <th>Catégorie</th>
                                                <th>Quantité</th>
                                                <th>Prix Unitaire</th>
                                                <th>Prix Total</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Produits Blancs</td>
                                                <td>15</td>
                                                <td>11,000 XOF</td>
                                                <td>165,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="produits-blancs">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Lubrifiants</td>
                                                <td>85</td>
                                                <td>5,000 XOF</td>
                                                <td>425,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="lubrifiants">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Gaz</td>
                                                <td>35</td>
                                                <td>6,000 XOF</td>
                                                <td>210,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="gaz">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Accessoires</td>
                                                <td>25</td>
                                                <td>3,000 XOF</td>
                                                <td>75,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="accessoires">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- JNP Pass Tab -->
                            <div class="tab-pane fade" id="jnp-tab-pane" role="tabpanel" aria-labelledby="jnp-tab"
                                tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;">#</th>
                                                <th>Catégorie</th>
                                                <th>Quantité</th>
                                                <th>Prix Unitaire</th>
                                                <th>Prix Total</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Produits Blancs</td>
                                                <td>12</td>
                                                <td>10,416 XOF</td>
                                                <td>125,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="produits-blancs">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Lubrifiants</td>
                                                <td>56</td>
                                                <td>5,000 XOF</td>
                                                <td>280,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="lubrifiants">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Gaz</td>
                                                <td>30</td>
                                                <td>6,000 XOF</td>
                                                <td>180,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="gaz">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Accessoires</td>
                                                <td>22</td>
                                                <td>2,818 XOF</td>
                                                <td>62,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="accessoires">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Cash Tab -->
                            <div class="tab-pane fade" id="cash-tab-pane" role="tabpanel" aria-labelledby="cash-tab"
                                tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;">#</th>
                                                <th>Catégorie</th>
                                                <th>Quantité</th>
                                                <th>Prix Unitaire</th>
                                                <th>Prix Total</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Produits Blancs</td>
                                                <td>5</td>
                                                <td>10,000 XOF</td>
                                                <td>50,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="produits-blancs">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Lubrifiants</td>
                                                <td>17</td>
                                                <td>5,000 XOF</td>
                                                <td>85,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="lubrifiants">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Gaz</td>
                                                <td>16</td>
                                                <td>5,937 XOF</td>
                                                <td>95,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="gaz">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Accessoires</td>
                                                <td>16</td>
                                                <td>3,000 XOF</td>
                                                <td>48,000 XOF</td>
                                                <td>28/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="accessoires">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Détails de la catégorie: <span
                            id="categoryName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tabs navigation for details -->
                    <ul class="nav nav-tabs" id="detailsTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="details-tv-tab" data-bs-toggle="tab"
                                data-bs-target="#details-tv-pane" type="button" role="tab">TV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="details-jnp-tab" data-bs-toggle="tab"
                                data-bs-target="#details-jnp-pane" type="button" role="tab">JNP Pass</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="details-cash-tab" data-bs-toggle="tab"
                                data-bs-target="#details-cash-pane" type="button" role="tab">Comptant</a>
                        </li>
                    </ul>

                    <!-- Search and filter for lubricants only -->
                    <div id="lubricants-filters" class="d-none mt-3">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="search-container">
                                    <i class="fas fa-search"></i>
                                    <input type="text" class="form-control search-input" id="searchLubricants"
                                        placeholder="Rechercher un lubrifiant...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <select class="form-select" id="lubricantFilterType" style="max-width: 200px;">
                                        <option value="">Tous les types</option>
                                        <option value="huile-moteur">Huile moteur</option>
                                        <option value="huile-transmission">Huile de transmission</option>
                                        <option value="liquide-frein">Liquide de frein</option>
                                        <option value="huile-hydraulique">Huile hydraulique</option>
                                        <option value="graisse">Graisse</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details tabs content -->
                    <div class="tab-content mt-3" id="detailsTabContent">
                        <!-- TV details -->
                        <div class="tab-pane fade show active" id="details-tv-pane" role="tabpanel"
                            aria-labelledby="details-tv-tab">
                            <div class="table-responsive">
                                <table class="table table-sm" id="details-tv-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produit</th>
                                            <th>Quantité</th>
                                            <th>Prix Unitaire</th>
                                            <th>Prix Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details-tv-body">
                                        <!-- Les données seront chargées dynamiquement via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-muted">Affichage de <span id="tv-showing">1-5</span> sur <span
                                            id="tv-total">10</span> produits</span>
                                </div>
                                <nav aria-label="Pagination TV">
                                    <ul class="pagination pagination-sm" id="tv-pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Suivant</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- JNP Pass details -->
                        <div class="tab-pane fade" id="details-jnp-pane" role="tabpanel"
                            aria-labelledby="details-jnp-tab">
                            <div class="table-responsive">
                                <table class="table table-sm" id="details-jnp-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produit</th>
                                            <th>Quantité</th>
                                            <th>Prix Unitaire</th>
                                            <th>Prix Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details-jnp-body">
                                        <!-- Les données seront chargées dynamiquement via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-muted">Affichage de <span id="jnp-showing">1-5</span> sur <span
                                            id="jnp-total">10</span> produits</span>
                                </div>
                                <nav aria-label="Pagination JNP">
                                    <ul class="pagination pagination-sm" id="jnp-pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Suivant</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- Cash details -->
                        <div class="tab-pane fade" id="details-cash-pane" role="tabpanel"
                            aria-labelledby="details-cash-tab">
                            <div class="table-responsive">
                                <table class="table table-sm" id="details-cash-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produit</th>
                                            <th>Quantité</th>
                                            <th>Prix Unitaire</th>
                                            <th>Prix Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details-cash-body">
                                        <!-- Les données seront chargées dynamiquement via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-muted">Affichage de <span id="cash-showing">1-5</span> sur <span
                                            id="cash-total">10</span> produits</span>
                                </div>
                                <nav aria-label="Pagination Cash">
                                    <ul class="pagination pagination-sm" id="cash-pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Suivant</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" id="exportDetails">
                        <i class="fas fa-download me-1"></i> Exporter les détails
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- New Sale Modal -->
    <div class="modal fade" id="newSaleModal" tabindex="-1" aria-labelledby="newSaleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSaleModalLabel">Ajouter une nouvelle vente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newSaleForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="saleCategory" class="form-label">Catégorie</label>
                                <select class="form-select" id="saleCategory" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    <option value="produits-blancs">Produits Blancs</option>
                                    <option value="lubrifiants">Lubrifiants</option>
                                    <option value="gaz">Gaz</option>
                                    <option value="accessoires">Accessoires</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="saleProduct" class="form-label">Produit</label>
                                <select class="form-select" id="saleProduct" required disabled>
                                    <option value="">Sélectionnez d'abord une catégorie</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="saleQuantity" class="form-label">Quantité</label>
                                <input type="number" class="form-control" id="saleQuantity" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label for="salePrice" class="form-label">Prix Unitaire (XOF)</label>
                                <input type="number" class="form-control" id="salePrice" min="0" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="salePaymentMethod" class="form-label">Mode de paiement</label>
                                <select class="form-select" id="salePaymentMethod" required>
                                    <option value="">Sélectionnez un mode de paiement</option>
                                    <option value="tv">Tickets Valeurs</option>
                                    <option value="jnp">JNP Pass</option>
                                    <option value="cash">Comptant</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="saleDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="saleDate" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="saleNotes" class="form-label">Notes (optionnel)</label>
                            <textarea class="form-control" id="saleNotes" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="saveSale">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating action button for adding new sales -->
    <div class="position-fixed bottom-0 end-0 p-4">
        <button class="btn btn-primary rounded-circle p-3 shadow" data-bs-toggle="modal" data-bs-target="#newSaleModal">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Données de démonstration pour les produits par catégorie
        const productData = {
            'produits-blancs': [
                { id: 1, name: 'Gasoil', unit_price: 10000, date: '28/04/2025' },
                { id: 2, name: 'Essence', unit_price: 11000, date: '28/04/2025' },
                { id: 3, name: 'Super', unit_price: 12000, date: '28/04/2025' }
            ],
            'lubrifiants': [
                { id: 1, name: 'Huile Moteur 5W30', type: 'huile-moteur', unit_price: 5000, date: '28/04/2025' },
                { id: 2, name: 'Huile Moteur 10W40', type: 'huile-moteur', unit_price: 4500, date: '28/04/2025' },
                { id: 3, name: 'Huile Transmission AT-3', type: 'huile-transmission', unit_price: 6000, date: '28/04/2025' },
                { id: 4, name: 'Liquide Frein DOT4', type: 'liquide-frein', unit_price: 3000, date: '28/04/2025' },
                { id: 5, name: 'Huile Hydraulique HF2', type: 'huile-hydraulique', unit_price: 4000, date: '28/04/2025' },
                { id: 6, name: 'Graisse Multifonction', type: 'graisse', unit_price: 2500, date: '28/04/2025' },
                { id: 7, name: 'Huile Moteur 0W20', type: 'huile-moteur', unit_price: 7000, date: '28/04/2025' },
                { id: 8, name: 'Huile Moteur 5W40', type: 'huile-moteur', unit_price: 5500, date: '28/04/2025' },
                { id: 9, name: 'Huile Transmission MT-1', type: 'huile-transmission', unit_price: 5500, date: '28/04/2025' },
                { id: 10, name: 'Huile Moteur Diesel', type: 'huile-moteur', unit_price: 6500, date: '28/04/2025' },
                { id: 11, name: 'Graisse Lithium', type: 'graisse', unit_price: 3000, date: '28/04/2025' },
                { id: 12, name: 'Liquide Frein DOT5', type: 'liquide-frein', unit_price: 3500, date: '28/04/2025' }
            ],
            'gaz': [
                { id: 1, name: 'Bouteille 6kg', unit_price: 6000, date: '28/04/2025' },
                { id: 2, name: 'Bouteille 12.5kg', unit_price: 12500, date: '28/04/2025' },
                { id: 3, name: 'Bouteille 25kg', unit_price: 25000, date: '28/04/2025' },
                { id: 4, name: 'Bouteille 38kg', unit_price: 38000, date: '28/04/2025' }
            ],
            'accessoires': [
                { id: 1, name: 'Filtre à huile', unit_price: 3000, date: '28/04/2025' },
                { id: 2, name: 'Filtre à air', unit_price: 2500, date: '28/04/2025' },
                { id: 3, name: 'Filtre à carburant', unit_price: 4000, date: '28/04/2025' },
                { id: 4, name: 'Bougies d\'allumage', unit_price: 1500, date: '28/04/2025' },
                { id: 5, name: 'Liquide de refroidissement', unit_price: 2000, date: '28/04/2025' }
            ]
        };

        // Données de vente pour la démo par mode de paiement
        const salesData = {
            'produits-blancs': {
                'tv': [
                    { id: 1, product: 'Gasoil', quantity: 10, unit_price: 10000, total_price: 100000, date: '28/04/2025' },
                    { id: 2, product: 'Essence', quantity: 5, unit_price: 11000, total_price: 55000, date: '28/04/2025' },
                    { id: 3, product: 'Super', quantity: 1, unit_price: 10000, total_price: 10000, date: '28/04/2025' }
                ],
                'jnp': [
                    { id: 1, product: 'Gasoil', quantity: 8, unit_price: 10000, total_price: 80000, date: '28/04/2025' },
                    { id: 2, product: 'Essence', quantity: 4, unit_price: 11250, total_price: 45000, date: '28/04/2025' }
                ],
                'cash': [
                    { id: 1, product: 'Gasoil', quantity: 3, unit_price: 10000, total_price: 30000, date: '28/04/2025' },
                    { id: 2, product: 'Essence', quantity: 2, unit_price: 10000, total_price: 20000, date: '28/04/2025' }
                ]
            },
            'lubrifiants': {
                'tv': [
                    { id: 1, product: 'Huile Moteur 5W30', quantity: 30, unit_price: 5000, total_price: 150000, date: '28/04/2025' },
                    { id: 2, product: 'Huile Moteur 10W40', quantity: 25, unit_price: 4500, total_price: 112500, date: '28/04/2025' },
                    { id: 3, product: 'Huile Transmission AT-3', quantity: 15, unit_price: 6000, total_price: 90000, date: '28/04/2025' },
                    { id: 4, product: 'Liquide Frein DOT4', quantity: 10, unit_price: 3000, total_price: 30000, date: '28/04/2025' },
                    { id: 5, product: 'Huile Hydraulique HF2', quantity: 5, unit_price: 4000, total_price: 20000, date: '28/04/2025' },
                    { id: 6, product: 'Graisse Multifonction', quantity: 9, unit_price: 2500, total_price: 22500, date: '28/04/2025' }
                ],
                'jnp': [
                    { id: 1, product: 'Huile Moteur 5W30', quantity: 20, unit_price: 5000, total_price: 100000, date: '28/04/2025' },
                    { id: 2, product: 'Huile Moteur 10W40', quantity: 15, unit_price: 4500, total_price: 67500, date: '28/04/2025' },
                    { id: 3, product: 'Huile Transmission AT-3', quantity: 10, unit_price: 6000, total_price: 60000, date: '28/04/2025' },
                    { id: 4, product: 'Huile Moteur 0W20', quantity: 5, unit_price: 7000, total_price: 35000, date: '28/04/2025' },
                    { id: 5, product: 'Huile Moteur 5W40', quantity: 3, unit_price: 5500, total_price: 16500, date: '28/04/2025' },
                    { id: 6, product: 'Graisse Lithium', quantity: 1, unit_price: 3000, total_price: 3000, date: '28/04/2025' }
                ],
                'cash': [
                    { id: 1, product: 'Huile Moteur 5W30', quantity: 5, unit_price: 5000, total_price: 25000, date: '28/04/2025' },
                    { id: 2, product: 'Huile Moteur 10W40', quantity: 3, unit_price: 4500, total_price: 13500, date: '28/04/2025' },
                    { id: 3, product: 'Liquide Frein DOT4', quantity: 8, unit_price: 3000, total_price: 24000, date: '28/04/2025' },
                    { id: 4, product: 'Liquide Frein DOT5', quantity: 1, unit_price: 3500, total_price: 3500, date: '28/04/2025' },
                    { id: 5, product: 'Graisse Multifonction', quantity: 8, unit_price: 2500, total_price: 20000, date: '28/04/2025' }
                ]
            },
            'gaz': {
                'tv': [
                    { id: 1, product: 'Bouteille 6kg', quantity: 15, unit_price: 6000, total_price: 90000, date: '28/04/2025' },
                    { id: 2, product: 'Bouteille 12.5kg', quantity: 5, unit_price: 12500, total_price: 62500, date: '28/04/2025' },
                    { id: 3, product: 'Bouteille 25kg', quantity: 2, unit_price: 25000, total_price: 50000, date: '28/04/2025' },
                    { id: 4, product: 'Bouteille 38kg', quantity: 2, unit_price: 3800, total_price: 7600, date: '28/04/2025' }
                ],
                'jnp': [
                    { id: 1, product: 'Bouteille 6kg', quantity: 10, unit_price: 6000, total_price: 60000, date: '28/04/2025' },
                    { id: 2, product: 'Bouteille 12.5kg', quantity: 6, unit_price: 12500, total_price: 75000, date: '28/04/2025' },
                    { id: 3, product: 'Bouteille 25kg', quantity: 1, unit_price: 25000, total_price: 25000, date: '28/04/2025' },
                    { id: 4, product: 'Bouteille 38kg', quantity: 0.5, unit_price: 40000, total_price: 20000, date: '28/04/2025' }
                ],
                'cash': [
                    { id: 1, product: 'Bouteille 6kg', quantity: 5, unit_price: 6000, total_price: 30000, date: '28/04/2025' },
                    { id: 2, product: 'Bouteille 12.5kg', quantity: 3, unit_price: 12500, total_price: 37500, date: '28/04/2025' },
                    { id: 3, product: 'Bouteille 25kg', quantity: 1, unit_price: 25000, total_price: 25000, date: '28/04/2025' },
                    { id: 4, product: 'Bouteille 38kg', quantity: 0.05, unit_price: 50000, total_price: 2500, date: '28/04/2025' }
                ]
            },
            'accessoires': {
                'tv': [
                    { id: 1, product: 'Filtre à huile', quantity: 10, unit_price: 3000, total_price: 30000, date: '28/04/2025' },
                    { id: 2, product: 'Filtre à air', quantity: 8, unit_price: 2500, total_price: 20000, date: '28/04/2025' },
                    { id: 3, product: 'Filtre à carburant', quantity: 5, unit_price: 4000, total_price: 20000, date: '28/04/2025' },
                    { id: 4, product: 'Bougies d\'allumage', quantity: 3, unit_price: 1500, total_price: 4500, date: '28/04/2025' },
                    { id: 5, product: 'Liquide de refroidissement', quantity: 2, unit_price: 2000, total_price: 4000, date: '28/04/2025' }
                ],
                'jnp': [
                    { id: 1, product: 'Filtre à huile', quantity: 8, unit_price: 3000, total_price: 24000, date: '28/04/2025' },
                    { id: 2, product: 'Filtre à air', quantity: 6, unit_price: 2500, total_price: 15000, date: '28/04/2025' },
                    { id: 3, product: 'Filtre à carburant', quantity: 4, unit_price: 4000, total_price: 16000, date: '28/04/2025' },
                    { id: 4, product: 'Bougies d\'allumage', quantity: 2, unit_price: 1500, total_price: 3000, date: '28/04/2025' },
                    { id: 5, product: 'Liquide de refroidissement', quantity: 2, unit_price: 2000, total_price: 4000, date: '28/04/2025' }
                ],
                'cash': [
                    { id: 1, product: 'Filtre à huile', quantity: 6, unit_price: 3000, total_price: 18000, date: '28/04/2025' },
                    { id: 2, product: 'Filtre à air', quantity: 4, unit_price: 2500, total_price: 10000, date: '28/04/2025' },
                    { id: 3, product: 'Filtre à carburant', quantity: 3, unit_price: 4000, total_price: 12000, date: '28/04/2025' },
                    { id: 4, product: 'Bougies d\'allumage', quantity: 4, unit_price: 1500, total_price: 6000, date: '28/04/2025' },
                    { id: 5, product: 'Liquide de refroidissement', quantity: 1, unit_price: 2000, total_price: 2000, date: '28/04/2025' }
                ]
            }
        };

        // Initialiser la date du jour
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date();
            const formattedDate = today.toISOString().substr(0, 10);

            if (document.getElementById('saleDate')) {
                document.getElementById('saleDate').value = formattedDate;
            }

            if (document.getElementById('startDate')) {
                document.getElementById('startDate').value = formattedDate;
            }

            if (document.getElementById('endDate')) {
                document.getElementById('endDate').value = formattedDate;
            }

            // Gestion de la modal de détails
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function () {
                    const category = this.getAttribute('data-category');
                    showCategoryDetails(category);
                });
            });

            // Gestion du formulaire d'ajout de vente
            if (document.getElementById('saleCategory')) {
                document.getElementById('saleCategory').addEventListener('change', function () {
                    loadProductsByCategory(this.value);
                });
            }

            if (document.getElementById('saveSale')) {
                document.getElementById('saveSale').addEventListener('click', saveSale);
            }

            // Gestion de la recherche pour les lubrifiants
            if (document.getElementById('searchLubricants')) {
                document.getElementById('searchLubricants').addEventListener('input', filterLubricants);
            }

            if (document.getElementById('lubricantFilterType')) {
                document.getElementById('lubricantFilterType').addEventListener('change', filterLubricants);
            }

            // Gestion de l'export
            if (document.getElementById('exportData')) {
                document.getElementById('exportData').addEventListener('click', exportData);
            }

            if (document.getElementById('exportDetails')) {
                document.getElementById('exportDetails').addEventListener('click', exportDetailsData);
            }

            // Gestion du filtre par date
            if (document.getElementById('filterDate')) {
                document.getElementById('filterDate').addEventListener('click', filterByDate);
            }
        });

        // Afficher les détails d'une catégorie
        function showCategoryDetails(category) {
            const categoryNameElement = document.getElementById('categoryName');
            const lubricantsFilters = document.getElementById('lubricants-filters');

            // Définir le nom de la catégorie
            switch (category) {
                case 'produits-blancs':
                    categoryNameElement.textContent = 'Produits Blancs';
                    lubricantsFilters.classList.add('d-none');
                    break;
                case 'lubrifiants':
                    categoryNameElement.textContent = 'Lubrifiants';
                    lubricantsFilters.classList.remove('d-none');
                    break;
                case 'gaz':
                    categoryNameElement.textContent = 'Gaz';
                    lubricantsFilters.classList.add('d-none');
                    break;
                case 'accessoires':
                    categoryNameElement.textContent = 'Accessoires';
                    lubricantsFilters.classList.add('d-none');
                    break;
            }

            // Charger les données pour chaque mode de paiement
            loadPaymentMethodDetails('tv', category);
            loadPaymentMethodDetails('jnp', category);
            loadPaymentMethodDetails('cash', category);
        }

        // Charger les détails par mode de paiement
        function loadPaymentMethodDetails(paymentMethod, category) {
            const tableBody = document.getElementById(`details-${paymentMethod}-body`);
            tableBody.innerHTML = '';

            if (salesData[category] && salesData[category][paymentMethod]) {
                const sales = salesData[category][paymentMethod];

                sales.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${item.product}</td>
                        <td>${item.quantity}</td>
                        <td>${item.unit_price.toLocaleString()} XOF</td>
                        <td>${item.total_price.toLocaleString()} XOF</td>
                        <td>${item.date}</td>
                    `;
                    tableBody.appendChild(row);
                });

                // Mettre à jour les informations de pagination
                document.getElementById(`${paymentMethod}-showing`).textContent = `1-${sales.length}`;
                document.getElementById(`${paymentMethod}-total`).textContent = sales.length;
            }
        }

        // Charger les produits en fonction de la catégorie sélectionnée
        function loadProductsByCategory(category) {
            const productSelect = document.getElementById('saleProduct');
            productSelect.innerHTML = '<option value="">Sélectionnez un produit</option>';

            if (!category) {
                productSelect.disabled = true;
                return;
            }

            if (productData[category]) {
                product