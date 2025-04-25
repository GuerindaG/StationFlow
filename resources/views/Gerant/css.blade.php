<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('./assets/css/theme.min.css')}}">

<!-- Favicon icon-->
<link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/favicon.ico">


<!-- Libs CSS -->
<link href="{{ asset('./assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet">
<link href="{{ asset('./assets/libs/feather-webfont/dist/feather-icons.css')}}" rel="stylesheet">
<link href="{{ asset('./assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('../asset/css/all.css')}}">
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
</style>