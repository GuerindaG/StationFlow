<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Station</title>
    @viteReactRefresh
    @vite(['resources/js/RapportStationService.jsx'])
</head>
<body>
    <div id="rapport-root" data-station-data="{{ $stationData }}"></div>

    <script type="text/javascript">
        const rapportRoot = document.getElementById('rapport-root');
        const stationData = JSON.parse(rapportRoot.dataset.stationData);

        import('./js/RapportStationService').then((module) => {
            const RapportStationService = module.default;
            const root = ReactDOM.createRoot(document.getElementById('rapport-root'));
            root.render(<RapportStationService stationData={stationData} />);
        });
    </script>
</body>
</html>