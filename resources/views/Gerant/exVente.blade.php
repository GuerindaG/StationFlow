<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="StationFlow - Gestion" name="author">
    <title></title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon/stationflow-favicon.svg')}}">

    <!-- Libs CSS -->
    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>

    <style>
        .folder-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .folder-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .report-card {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-custom {
            background: linear-gradient(135deg, #c1c7c6 0%, #889397 100%);
            color: white;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .breadcrumb-custom a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

@include('Gerant.navbar')
<div class="main-wrapper">
    @include('Gerant.verticalNav')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        <div>
                            <h5>Historique des rapports</h5>
                        </div>
                        <div>
                            <button type="button" id="backBtn" class="btn btn-secondary" onclick="goBack()"
                                style="display: none;">
                                <i class="fa-solid fa-arrow-left"></i> Retour
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div id="breadcrumb" class="breadcrumb-custom" style="display: none;">
            <i class="fas fa-report me-2"></i>
            <span id="breadcrumb-text">Rapport</span>
        </div>

        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-header d-block d-sm-flex border-0">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-12 g-3 col-12">
                                    <form class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <input type="date" id="date_filter" class="form-control"
                                                onchange="filterByDate()">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary" onclick="filterByDate()">
                                                <i class="fa-solid fa-filter"></i>
                                            </button>
                                            <button type="button" class="btn btn-light" onclick="resetFilter()">
                                                <i class="fa-solid fa-power-off"></i>
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-6">
                            <div id="content-area"
                                class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                                <!-- Le contenu sera généré dynamiquement -->
                            </div>
                            <div class="row mt-8 text-center">
                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span id="items-count"></span>
                                    <nav class="mt-2 mt-md-0">
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#!">Précédent</a>
                                            </li>
                                            <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">Suivant</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    // Données simulées
    const rapportsData = {
        'Janvier 2025': generateReportsForMonth(2025, 0, 31),
        'Février 2025': generateReportsForMonth(2025, 1, 28),
        'Mars 2025': generateReportsForMonth(2025, 2, 31),
        'Avril 2025': generateReportsForMonth(2025, 3, 30),
        'Mai 2025': generateReportsForMonth(2025, 4, 23), // Jusqu'au 23 mai
        'Décembre 2024': generateReportsForMonth(2024, 11, 31),
    };

    let currentView = 'folders'; // 'folders' ou 'reports'
    let currentFolder = null;

    function generateReportsForMonth(year, month, days) {
        const reports = [];
        for (let day = 1; day <= days; day++) {
            const date = new Date(year, month, day);
            const dateStr = date.toLocaleDateString('fr-FR');
            reports.push({
                id: `R-${String(day).padStart(2, '0')}-${String(month + 1).padStart(2, '0')}-${year}`,
                title: `Rapport du ${dateStr}`,
                date: dateStr,
                type: Math.random() > 0.5 ? 'daily' : 'summary'
            });
        }
        return reports;
    }

    function displayFolders() {
        const contentArea = document.getElementById('content-area');
        const folders = Object.keys(rapportsData);

        contentArea.innerHTML = '';
        contentArea.className = 'row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2 fade-in';

        folders.forEach(folderName => {
            const reportsCount = rapportsData[folderName].length;
            const folderCard = `
                    <div class="col">
                        <div class="card card-product folder-card" ondblclick="openFolder('${folderName}')">
                            <div class="card-body">
                                <div class="text-center position-relative">
                                    <i class="fa-solid fa-folder fa-5x text-primary"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        ${reportsCount}
                                    </span>
                                </div>
                                <div class="text-small mb-1 p-4">
                                    <h2 class="fs-6 text-center">
                                        <span class="text-inherit">${folderName}</span>
                                    </h2>
                                    <p class="text-muted text-center small mb-0">${reportsCount} rapport(s)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            contentArea.innerHTML += folderCard;
        });

        // Mise à jour du compteur
        document.getElementById('items-count').textContent = `${folders.length} dossier(s) trouvé(s)`;
    }

    function displayReports(folderName) {
        const contentArea = document.getElementById('content-area');
        const reports = rapportsData[folderName];

        contentArea.innerHTML = '';
        contentArea.className = 'row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2 fade-in';

        reports.forEach(report => {
            const iconClass = report.type === 'daily' ? 'fa-file-lines' : 'fa-file-contract';
            const reportCard = `
                    <div class="col">
                        <div class="card card-product report-card" onclick="openReport('${report.id}')">
                            <div class="card-body">
                                <div class="text-center position-relative">
                                    <i class="fa-solid ${iconClass} fa-4x text-success"></i>
                                </div>
                                <div class="text-small mb-1 p-3">
                                    <h2 class="fs-6 text-center">
                                        <span class="text-inherit">${report.id}</span>
                                    </h2>
                                    <p class="text-muted text-center small mb-0">${report.date}</p>
                                    <div class="text-center mt-2">
                                        <span class="badge ${report.type === 'daily' ? 'bg-primary' : 'bg-info'}">
                                            ${report.type === 'daily' ? 'Quotidien' : 'Résumé'}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            contentArea.innerHTML += reportCard;
        });

        // Mise à jour du compteur
        document.getElementById('items-count').textContent = `${reports.length} rapport(s) trouvé(s)`;
    }

    function openFolder(folderName) {
        currentView = 'reports';
        currentFolder = folderName;

        // Afficher le breadcrumb
        const breadcrumb = document.getElementById('breadcrumb');
        const breadcrumbText = document.getElementById('breadcrumb-text');
        breadcrumb.style.display = 'block';
        breadcrumbText.innerHTML = `<a href="#" onclick="goBack()">Rapport</a> / ${folderName}`;

        // Afficher le bouton retour
        document.getElementById('backBtn').style.display = 'inline-block';

        // Afficher les rapports
        displayReports(folderName);
    }

    function openReport(reportId) {
        alert(`Ouverture du rapport: ${reportId}`);
        // Ici vous pouvez rediriger vers la page du rapport
        // window.location.href = `/rapport/${reportId}`;
    }

    function goBack() {
        if (currentView === 'reports') {
            currentView = 'folders';
            currentFolder = null;

            // Cacher le breadcrumb et le bouton retour
            document.getElementById('breadcrumb').style.display = 'none';
            document.getElementById('backBtn').style.display = 'none';

            // Afficher les dossiers
            displayFolders();
        }
    }

    function filterByDate() {
        const dateValue = document.getElementById('date_filter').value;
        if (!dateValue) return;

        const selectedDate = new Date(dateValue);
        const monthYear = selectedDate.toLocaleDateString('fr-FR', {
            month: 'long',
            year: 'numeric'
        });
        const monthYearCapitalized = monthYear.charAt(0).toUpperCase() + monthYear.slice(1);

        // Vérifier si le mois existe dans nos données
        if (rapportsData[monthYearCapitalized]) {
            openFolder(monthYearCapitalized);
        } else {
            alert(`Aucun rapport trouvé pour ${monthYearCapitalized}`);
        }
    }

    function resetFilter() {
        document.getElementById('date_filter').value = '';
        if (currentView === 'reports') {
            goBack();
        }
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function () {
        displayFolders();
    });

    // Gestion du double-clic pour éviter les conflits
    let clickTimeout;
    function handleCardClick(element, action) {
        clearTimeout(clickTimeout);
        clickTimeout = setTimeout(action, 200);
    }
</script>
<!-- Libs JS -->
<!-- <script src="../assets/libs/jquery/dist/jquery.min.js"></script> -->
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
<!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
<script src="../assets/js/vendors/chart.js"></script>
</body>

</html>