<!-- Javascript -->
<script src="{{ asset('assets/libs/nouislider/dist/nouislider.min.js') }}"></script>
<script src="{{ asset('assets/libs/wnumb/wNumb.min.js') }}"></script>

<!-- Libs JS -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>

<!-- Autres bibliothèques JS -->
<script src="{{ asset('assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/vendors/tns-slider.js') }}"></script>
<script src="{{ asset('assets/js/vendors/zoom.js') }}"></script>
<script src="{{ asset('.assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/chart.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Repeater -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<!-- Affichage de la date et de l'heure actuelles dans le pied de page -->
<script>
    document.getElementById('generated-date').innerText = new Date().toLocaleString();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Erreur(s) de validation',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
        });
    @endif
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-M8S4MT3EYG");
</script>


<script type="text/javascript">
    (function (c, l, a, r, i, t, y) {
        c[a] =
            c[a] ||
            function () {
                (c[a].q = c[a].q || []).push(arguments);
            };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "kuc8w5o9nt");
</script>


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
        breadcrumbText.innerHTML = `<a href="#" onclick="goBack()">Accueil</a> / ${folderName}`;

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