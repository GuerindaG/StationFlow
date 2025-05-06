<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Ventes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #2c3e50;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-bottom: none;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }
        .tab.active {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        
        /* Formulaire */
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .product-item {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border-left: 3px solid #3498db;
        }
        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-add {
            background-color: #2ecc71;
            color: white;
        }
        .btn-remove {
            background-color: #e74c3c;
            color: white;
        }
        .btn-calculate {
            background-color: #3498db;
            color: white;
            margin-right: 10px;
        }
        .btn-submit {
            background-color: #2c3e50;
            color: white;
        }
        .form-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .total-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }
        .total-value {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        /* Liste des ventes */
        .sales-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .sales-list th, .sales-list td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .sales-list th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .sales-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .sales-list tr:hover {
            background-color: #f1f1f1;
        }
        .action-btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .view-btn {
            background-color: #3498db;
            color: white;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        
        /* Détails de la vente */
        .sale-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .sale-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .sale-info {
            margin-bottom: 20px;
        }
        .sale-info p {
            margin: 5px 0;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
        }
        .products-table th, .products-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .products-table th {
            background-color: #f2f2f2;
        }
        .sale-total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .back-btn {
            background-color: #7f8c8d;
            color: white;
            margin-top: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Système de Gestion des Ventes</h1>
    
    <div class="tabs">
        <div class="tab active" data-tab="new-sale">Nouvelle Vente</div>
        <div class="tab" data-tab="sales-list">Liste des Ventes</div>
        <div class="tab" data-tab="sale-details">Détails de la Vente</div>
    </div>
    
    <!-- Onglet Formulaire de Nouvelle Vente -->
    <div id="new-sale" class="tab-content active">
        <h2>Enregistrement d'une nouvelle vente</h2>
        
        <form id="salesForm">
            <div class="form-group">
                <label for="clientName">Nom du client</label>
                <input type="text" id="clientName" name="clientName" required>
            </div>
            
            <div class="form-group">
                <label for="saleDate">Date de vente</label>
                <input type="date" id="saleDate" name="saleDate" required value="2025-05-05">
            </div>
            
            <div class="form-group">
                <label for="paymentMethod">Méthode de paiement</label>
                <select id="paymentMethod" name="paymentMethod" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="cash">Espèces</option>
                    <option value="card">Carte bancaire</option>
                    <option value="transfer">Virement</option>
                    <option value="check">Chèque</option>
                </select>
            </div>
            
            <h3>Produits</h3>
            <div id="productsContainer">
                <!-- Le container où les produits seront ajoutés dynamiquement -->
            </div>
            
            <button type="button" id="addProduct" class="btn btn-add">+ Ajouter un produit</button>
            
            <div class="total-section">
                <p>Total de la vente: <span id="saleTotal" class="total-value">0,00 €</span></p>
            </div>
            
            <div class="form-actions">
                <button type="button" id="calculateTotal" class="btn btn-calculate">Calculer le total</button>
                <button type="submit" class="btn btn-submit">Enregistrer la vente</button>
            </div>
        </form>
    </div>
    
    <!-- Onglet Liste des Ventes -->
    <div id="sales-list" class="tab-content">
        <h2>Liste des ventes enregistrées</h2>
        
        <table class="sales-list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Méthode de paiement</th>
                    <th>Nombre d'articles</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="salesTableBody">
                <!-- Les ventes seront ajoutées ici dynamiquement -->
            </tbody>
        </table>
    </div>
    
    <!-- Onglet Détails de la Vente -->
    <div id="sale-details" class="tab-content">
        <h2>Détails de la vente</h2>
        
        <div id="saleDetailsContainer" class="sale-details">
            <!-- Les détails de la vente seront ajoutés ici dynamiquement -->
        </div>
        
        <button id="backToList" class="btn back-btn">Retour à la liste</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des onglets
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Désactiver tous les onglets et contenus
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Activer l'onglet et le contenu cliqués
                    this.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // Référence aux éléments du formulaire
            const productsContainer = document.getElementById('productsContainer');
            const addProductButton = document.getElementById('addProduct');
            const calculateTotalButton = document.getElementById('calculateTotal');
            const saleTotalElement = document.getElementById('saleTotal');
            const salesForm = document.getElementById('salesForm');
            const salesTableBody = document.getElementById('salesTableBody');
            const backToListButton = document.getElementById('backToList');
            
            // Compteur pour les IDs uniques
            let productCounter = 0;
            
            // Stockage local des ventes
            let sales = JSON.parse(localStorage.getItem('sales')) || [];
            
            // Ajouter un produit au formulaire
            function addProductItem() {
                productCounter++;
                
                // Créer un élément div pour le produit
                const productItem = document.createElement('div');
                productItem.className = 'product-item';
                productItem.id = `product-${productCounter}`;
                
                // Contenu HTML du produit
                productItem.innerHTML = `
                    <div class="product-header">
                        <h3>Produit #${productCounter}</h3>
                        <button type="button" class="btn btn-remove" onclick="removeProduct('product-${productCounter}')">Supprimer</button>
                    </div>
                    <div class="form-group">
                        <label for="product-name-${productCounter}">Nom du produit</label>
                        <input type="text" id="product-name-${productCounter}" name="products[${productCounter}][name]" required>
                    </div>
                    <div class="form-group">
                        <label for="product-quantity-${productCounter}">Quantité</label>
                        <input type="number" id="product-quantity-${productCounter}" name="products[${productCounter}][quantity]" min="1" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="product-price-${productCounter}">Prix unitaire (€)</label>
                        <input type="number" id="product-price-${productCounter}" name="products[${productCounter}][price]" step="0.01" min="0" required>
                    </div>
                `;
                
                // Ajouter le produit au conteneur
                productsContainer.appendChild(productItem);
            }
            
            // Fonction pour supprimer un produit
            window.removeProduct = function(productId) {
                const productElement = document.getElementById(productId);
                if (productElement) {
                    productElement.remove();
                }
            };
            
            // Calculer le total de la vente
            function calculateTotal() {
                let total = 0;
                
                // Parcourir tous les produits
                for (let i = 1; i <= productCounter; i++) {
                    const quantityElement = document.getElementById(`product-quantity-${i}`);
                    const priceElement = document.getElementById(`product-price-${i}`);
                    
                    // Vérifier si les éléments existent (ils pourraient avoir été supprimés)
                    if (quantityElement && priceElement) {
                        const quantity = parseFloat(quantityElement.value) || 0;
                        const price = parseFloat(priceElement.value) || 0;
                        total += quantity * price;
                    }
                }
                
                // Afficher le total formaté
                saleTotalElement.textContent = total.toLocaleString('fr-FR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + ' €';
                
                return total;
            }
            
            // Formater un montant en euros
            function formatCurrency(amount) {
                return amount.toLocaleString('fr-FR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + ' €';
            }
            
            // Formater une date
            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('fr-FR');
            }
            
            // Traduire la méthode de paiement
            function translatePaymentMethod(method) {
                const translations = {
                    'cash': 'Espèces',
                    'card': 'Carte bancaire',
                    'transfer': 'Virement',
                    'check': 'Chèque'
                };
                return translations[method] || method;
            }
            
            // Charger les ventes dans le tableau
            function loadSales() {
                salesTableBody.innerHTML = '';
                
                if (sales.length === 0) {
                    salesTableBody.innerHTML = `
                        <tr>
                            <td colspan="7" style="text-align: center;">Aucune vente enregistrée</td>
                        </tr>
                    `;
                    return;
                }
                
                sales.forEach((sale, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${sale.id}</td>
                        <td>${sale.client}</td>
                        <td>${formatDate(sale.date)}</td>
                        <td>${translatePaymentMethod(sale.paymentMethod)}</td>
                        <td>${sale.products.length}</td>
                        <td>${formatCurrency(sale.total)}</td>
                        <td>
                            <button class="action-btn view-btn" data-id="${sale.id}">Voir</button>
                            <button class="action-btn delete-btn" data-id="${sale.id}">Supprimer</button>
                        </td>
                    `;
                    salesTableBody.appendChild(row);
                });
                
                // Ajouter les écouteurs pour les boutons de vue et suppression
                document.querySelectorAll('.view-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const saleId = this.getAttribute('data-id');
                        showSaleDetails(saleId);
                    });
                });
                
                document.querySelectorAll('.delete-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const saleId = this.getAttribute('data-id');
                        deleteSale(saleId);
                    });
                });
            }
            
            // Afficher les détails d'une vente
            function showSaleDetails(saleId) {
                const sale = sales.find(s => s.id === parseInt(saleId));
                if (!sale) return;
                
                const detailsContainer = document.getElementById('saleDetailsContainer');
                
                // Calculer le total général
                const totalAmount = sale.products.reduce((sum, product) => {
                    return sum + (product.quantity * product.price);
                }, 0);
                
                detailsContainer.innerHTML = `
                    <div class="sale-header">
                        <h3>Vente #${sale.id}</h3>
                        <p>Date: ${formatDate(sale.date)}</p>
                    </div>
                    
                    <div class="sale-info">
                        <p><strong>Client:</strong> ${sale.client}</p>
                        <p><strong>Méthode de paiement:</strong> ${translatePaymentMethod(sale.paymentMethod)}</p>
                    </div>
                    
                    <h3>Produits</h3>
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${sale.products.map(product => `
                                <tr>
                                    <td>${product.name}</td>
                                    <td>${product.quantity}</td>
                                    <td>${formatCurrency(product.price)}</td>
                                    <td>${formatCurrency(product.quantity * product.price)}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                    
                    <div class="sale-total">
                        Total: ${formatCurrency(totalAmount)}
                    </div>
                `;
                
                // Afficher l'onglet des détails
                document.querySelector('.tab[data-tab="sale-details"]').click();
            }
            
            // Supprimer une vente
            function deleteSale(saleId) {
                if (confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')) {
                    sales = sales.filter(sale => sale.id !== parseInt(saleId));
                    localStorage.setItem('sales', JSON.stringify(sales));
                    loadSales();
                }
            }
            
            // Gérer la soumission du formulaire
            salesForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // S'assurer qu'il y a au moins un produit
                if (productsContainer.children.length === 0) {
                    alert('Veuillez ajouter au moins un produit à la vente.');
                    return;
                }
                
                // Recalculer le total avant de soumettre
                const total = calculateTotal();
                
                // Collecter les données du formulaire
                const formData = new FormData(salesForm);
                
                // Générer un ID unique pour la vente
                const saleId = sales.length > 0 ? Math.max(...sales.map(s => s.id)) + 1 : 1;
                
                const saleData = {
                    id: saleId,
                    client: formData.get('clientName'),
                    date: formData.get('saleDate'),
                    paymentMethod: formData.get('paymentMethod'),
                    products: [],
                    total: total
                };
                
                // Collecter les produits
                for (let i = 1; i <= productCounter; i++) {
                    const nameElement = document.getElementById(`product-name-${i}`);
                    const quantityElement = document.getElementById(`product-quantity-${i}`);
                    const priceElement = document.getElementById(`product-price-${i}`);
                    
                    if (nameElement && quantityElement && priceElement) {
                        saleData.products.push({
                            name: nameElement.value,
                            quantity: parseFloat(quantityElement.value),
                            price: parseFloat(priceElement.value)
                        });
                    }
                }
                
                // Enregistrer la vente
                sales.push(saleData);
                localStorage.setItem('sales', JSON.stringify(sales));
                
                // Réinitialiser le formulaire
                salesForm.reset();
                productsContainer.innerHTML = '';
                productCounter = 0;
                saleTotalElement.textContent = '0,00 €';
                
                // Ajouter un premier produit par défaut
                addProductItem();
                
                // Charger les ventes et afficher l'onglet de liste
                loadSales();
                document.querySelector('.tab[data-tab="sales-list"]').click();
                
                alert('Vente enregistrée avec succès!');
            });
            
            // Retour à la liste depuis les détails
            backToListButton.addEventListener('click', function() {
                document.querySelector('.tab[data-tab="sales-list"]').click();
            });
            
            // Ajouter les écouteurs d'événements
            addProductButton.addEventListener('click', addProductItem);
            calculateTotalButton.addEventListener('click', calculateTotal);
            
            // Ajouter un premier produit par défaut
            addProductItem();
            
            // Charger les ventes au démarrage
            loadSales();
        });
    </script>
</body>
</html>