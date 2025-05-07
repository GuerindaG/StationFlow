<!-- Libs CSS -->
<link href="{{ asset('../assets/libs/tiny-slider/dist/tiny-slider.css')}}" rel="stylesheet" />
<link href="{{ asset('../assets/libs/nouislider/dist/nouislider.min.css')}}" rel="stylesheet" />
<link href="{{ asset('../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet">
<link href="{{ asset('../assets/libs/feather-webfont/dist/feather-icons.css')}}" rel="stylesheet">
<link href="{{ asset('../assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet">

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('../assets/css/theme.min.css')}}">


<style>
    .faq-section {
        padding: 80px 0;
        background-color: var(--light-bg);
    }

    .accordion-item {
        margin-bottom: 15px;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .accordion-button {
        font-weight: 600;
        padding: 20px;
        background-color: white;
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }

    .accordion-button:focus {
        box-shadow: none;
    }

    .accordion-body {
        padding: 20px;
        background-color: white;
    }

    /* Appliquer un effet aux cartes dans la row invoice-card-row */
.invoice-card-row .custom-card {
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 20px;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

/* Animation au survol des cartes */
.invoice-card-row .custom-card:hover {
    transform: scale(1.05); /* Agrandir légèrement */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Ombre plus marquée */
    background-color: #f5f5f5; /* Changer la couleur de fond */
}

/* Changement de couleur des titres au survol */
.invoice-card-row .custom-card:hover .card-title {
    color: #007bff; /* Change la couleur du titre */
}

.invoice-card-row .custom-card:hover .card-subtitle {
    color: #888; /* Change la couleur du sous-titre */
}

</style>