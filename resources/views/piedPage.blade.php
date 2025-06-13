<style>
    /* Styles spécifiques pour le pied de page */
    .pdf-footer-content {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px; /* Taille de police plus petite pour le pied de page */
        color: #5c6c75;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0; /* Un peu de padding pour le contenu du pied de page */
        border-top: 1px solid #e9ecef; /* Une fine ligne de séparation */
    }
    .pdf-footer-right {
        text-align: right;
    }
</style>
<div class="pdf-footer-content">
    <div>&copy; {{ date('Y') }} StationFlow - Tous droits réservés</div>
    <div class="pdf-footer-right">
        <div>Rapport généré le : <strong>{{ date('d/m/Y à H:i') }}</strong></div>
        {{-- DomPDF remplacera {PAGE_NUM} et {PAGE_COUNT} automatiquement par les numéros de page --}}
        <div>Page {PAGE_NUM}/{PAGE_COUNT}</div>
    </div>
</div>
