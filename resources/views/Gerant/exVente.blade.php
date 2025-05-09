<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StationFlow - Trouvez les stations service près de chez vous</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @include('gerant.css')
    @include('gerant.js')
    <style>
        :root {
            --primary-color: #0066cc;
            --secondary-color: #f8f9fa;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --light-gray: #e9ecef;
            --dark-gray: #343a40;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-bar {
            background-color: var(--secondary-color);
            padding: 8px 0;
            color: var(--dark-gray);
            font-size: 14px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .flex {
            display: flex;
        }

        .space-between {
            justify-content: space-between;
        }

        .align-center {
            align-items: center;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .logo i {
            margin-right: 8px;
        }

        .search-container {
            flex: 1;
            margin: 0 20px;
            position: relative;
        }

        .search-container input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 25px;
            border: 1px solid var(--light-gray);
            font-size: 16px;
        }

        .search-container button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--dark-gray);
            cursor: pointer;
        }

        .nav-icons a {
            color: var(--dark-gray);
            margin-left: 15px;
            text-decoration: none;
            position: relative;
        }

        .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary-color);
            color: white;
            font-size: 12px;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-nav {
            background-color: white;
            padding: 15px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .nav-menu {
            list-style: none;
            display: flex;
        }

        .nav-menu li {
            margin-right: 25px;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--dark-gray);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .main-content {
            padding: 40px 0;
        }

        .section-title {
            font-size: 32px;
            margin-bottom: 30px;
            color: var(--dark-gray);
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-image {
            height: 200px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .card-tag {
            font-size: 14px;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .card-title {
            font-size: 18px;
            margin-bottom: 12px;
            color: var(--dark-gray);
        }

        .card-info {
            margin-bottom: 15px;
            color: #666;
            font-size: 14px;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 14px;
            margin-top: 10px;
        }

        .status-available {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status-low {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .status-unavailable {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .map-container {
            height: 400px;
            margin-bottom: 40px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .map-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .filter-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: var(--dark-gray);
        }

        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-option {
            padding: 8px 15px;
            background-color: var(--secondary-color);
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-option:hover,
        .filter-option.active {
            background-color: var(--primary-color);
            color: white;
        }

        .btn {
            padding: 8px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0055aa;
        }

        .card-details {
            display: flex;
            margin-top: 10px;
        }

        .detail {
            display: flex;
            align-items: center;
            margin-right: 15px;
            font-size: 14px;
            color: #666;
        }

        .detail i {
            margin-right: 5px;
            color: var(--primary-color);
        }

        .fuel-prices {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--light-gray);
        }

        .fuel-price {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .fuel-type {
            color: #666;
        }

        .price {
            font-weight: 500;
            color: var(--dark-gray);
        }

        footer {
            background-color: var(--dark-gray);
            color: white;
            padding: 40px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 8px;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 14px;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .search-container {
                margin: 0 10px;
            }

            .cards-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 576px) {
            .cards-container {
                grid-template-columns: 1fr;
            }

            .logo {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <div class="container flex space-between align-center">
            <div>StationFlow - Trouvez facilement des stations service</div>
            <div>
                <select>
                    <option>Français</option>
                    <option>English</option>
                </select>
            </div>
        </div>
    </div>

    <header class="header">
        <div class="container flex space-between align-center">
            <div class="logo">
                <i class="fas fa-gas-pump"></i>StationFlow
            </div>
            <div class="search-container">
                <input type="text" placeholder="Rechercher une station...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="nav-icons">
                <a href="#"><i class="fas fa-map-marker-alt"></i></a>
                <a href="#"><i class="fas fa-star"></i><span class="badge">3</span></a>
                <a href="#"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </header>

    <nav class="main-nav">
        <div class="container">
            <ul class="nav-menu">
                <li><a href="#"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="#"><i class="fas fa-map"></i> Carte</a></li>
                <li><a href="#"><i class="fas fa-list"></i> Stations</a></li>
                <li><a href="#"><i class="fas fa-tag"></i> Promotions</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> À propos</a></li>
                <li><a href="#"><i class="fas fa-envelope"></i> Contact</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="filter-section">
                <h3 class="filter-title">Filtres</h3>
                <div class="filter-options">
                    <div class="filter-option active">Toutes les stations</div>
                    <div class="filter-option">Disponibles</div>
                    <div class="filter-option">Stock bas</div>
                    <div class="filter-option">En rupture</div>
                    <div class="filter-option">Essence SP95</div>
                    <div class="filter-option">Diesel</div>
                    <div class="filter-option">SP98</div>
                    <div class="filter-option">E85</div>
                </div>
            </div>

            <div class="map-container">
                <img src="/api/placeholder/1200/400" alt="Carte des stations service">
            </div>

            <h2 class="section-title">Stations à proximité</h2>
            <div class="cards-container">
                <!-- Station Card 1 -->
                <div class="card">
                    <div class="card-image">
                        <img src="/api/placeholder/350/200" alt="Station Total">
                    </div>
                    <div class="card-content">
                        <div class="card-tag">Premium</div>
                        <h3 class="card-title">Station Total Energies</h3>
                        <div class="card-info">Avenue Charles de Gaulle, 75008 Paris</div>
                        <div class="card-details">
                            <div class="detail"><i class="fas fa-road"></i> 2.3 km</div>
                            <div class="detail"><i class="far fa-clock"></i> 24h/24</div>
                        </div>
                        <div class="fuel-prices">
                            <div class="fuel-price">
                                <span class="fuel-type">SP95-E10</span>
                                <span class="price">1.89 €/L</span>
                            </div>
                            <div class="fuel-price">
                                <span class="fuel-type">Gazole</span>
                                <span class="price">1.76 €/L</span>
                            </div>
                            <div class="fuel-price">
                                <span class="fuel-type">SP98</span>
                                <span class="price">1.95 €/L</span>
                            </div>
                        </div>
                        <div class="status status-available">Disponible</div>
                    </div>
                </div>

                <!-- Station Card 2 -->
                <div class="card">
                    <div class="card-image">
                        <img src="/api/placeholder/350/200" alt="Station BP">
                    </div>
                    <div class="card-content">
                        <div class="card-tag">Standard</div>
                        <h3 class="card-title">Station BP</h3>
                        <div class="card-info">Rue de Rivoli, 75001 Paris</div>
                        <div class="card-details">
                            <div class="detail"><i class="fas fa-road"></i> 3.7 km</div>
                            <div class="detail"><i class="far fa-clock"></i> 06:00-22:00</div>
                        </div>
                        <div class="fuel-prices">
                            <div class="fuel-price">
                                <span class="fuel-type">SP95-E10</span>
                                <span class="price">1.91 €/L</span>
                            </div>
                            <div class="fuel-price">
                                <span class="fuel-type">Gazole</span>
                                <span class="price">1.78 €/L</span>
                            </div>
                        </div>
                        <div class="status status-low">Stock bas</div>
                    </div>
                </div>

                <!-- Station Card 3 -->
                <div class="card">
                    <div class="card-image">
                        <img src="/api/placeholder/350/200" alt="Station Esso">
                    </div>
                    <div class="card-content">
                        <div class="card-tag">Économique</div>
                        <h3 class="card-title">Station Esso Express</h3>
                        <div class="card-info">Boulevard Haussmann, 75009 Paris</div>
                        <div class="card-details">
                            <div class="detail"><i class="fas fa-road"></i> 1.5 km</div>
                            <div class="detail"><i class="far fa-clock"></i> 24h/24</div>
                        </div>
                        <div class="fuel-prices">
                            <div class="fuel-price">
                                <span class="fuel-type">SP95-E10</span>
                                <span class="price">1.87 €/L</span>
                            </div>
                            <div class="fuel-price">
                                <span class="fuel-type">Gazole</span>
                                <span class="price">1.74 €/L</span>
                            </div>
                            <div class="fuel-price">
                                <span class="fuel-type">E85</span>
                                <span class="price">0.89 €/L</span>
                            </div>
                        </div>
                        <div class="status status-unavailable">En rupture (Gazole)</div>
                    </div>
                </div>

                <!-- Station Card 4 -->
                <div class="card">
                    <div class="card-image">
                        <img src="/api/placeholder/350/200" alt="Station Carrefour">
                    </div>
                    <div class="card-content">
                        <div class="card-tag">Supermarché</div>
                        <h3 class="card-title">Station Carrefour Market</h3>
                        <div class="card-info">Boulevard Voltaire, 75011 Paris</div>
                        <div class="card-details">
                            <div class="detail"><i class="fas fa-road"></i> 4.2 km</div>
                            <div class="detail"><i class="far fa-clock"></i> 08:00-21:00</div>
                        </div>
                        <div class="fuel-prices">
                            <div class="fuel-price">
                                <span class="fuel-type">SP95-E10</span>
                                <span class="price">1.85 €/L</span>
                            </div>
                            <div class="fuel-price">
                                <span class="fuel-type">Gazole</span>
                                <span class="price">1.72 €/L</span>
                            </div>
                            <div class="fuel-price">
                                <span class="fuel-type">SP98</span>
                                <span class="price">1.93 €/L</span>
                            </div>
                        </div>
                        <div class="status status-available">Disponible</div>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 20px; margin-bottom: 40px;">
                <button class="btn">Voir plus de stations</button>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>StationFlow</h3>
                    <ul>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Carrières</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Presse</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Aide</h3>
                    <ul>
                        <li><a href="#">Centre d'aide</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Signaler un problème</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Pour les stations</a></li>
                        <li><a href="#">Pour les entreprises</a></li>
                        <li><a href="#">API</a></li>
                        <li><a href="#">Partenaires</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Légal</h3>
                    <ul>
                        <li><a href="#">Conditions d'utilisation</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Cookies</a></li>
                        <li><a href="#">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2025 StationFlow. Tous droits réservés.
            </div>
        </div>
    </footer>
</body>

</html>