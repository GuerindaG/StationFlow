<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Vente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
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
    </style>
</head>
<body>
    <h1>Enregistrement d'une nouvelle vente</h1>
    
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
        
        <h2>Produits</h2>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Référence aux éléments HTML
            const productsContainer = document.getElementById('productsContainer');
            const addProductButton = document.getElementById('addProduct');
            const calculateTotalButton = document.getElementById('calculateTotal');
            const saleTotalElement = document.getElementById('saleTotal');
            const salesForm = document.getElementById('salesForm');
            
            // Compteur pour les IDs uniques
            let productCounter = 0;
            
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
                calculateTotal();
                
                // Collecter les données du formulaire
                const formData = new FormData(salesForm);
                const saleData = {
                    client: formData.get('clientName'),
                    date: formData.get('saleDate'),
                    paymentMethod: formData.get('paymentMethod'),
                    products: []
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
                
                // Afficher les données (pour démo)
                console.log('Données de la vente:', saleData);
                alert('Vente enregistrée avec succès!');
                
                // Ici vous pourriez envoyer les données vers votre API
                // fetch('/api/sales', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //     },
                //     body: JSON.stringify(saleData)
                // })
                // .then(response => response.json())
                // .then(data => {
                //     console.log('Succès:', data);
                //     alert('Vente enregistrée avec succès!');
                //     salesForm.reset();
                //     productsContainer.innerHTML = '';
                //     productCounter = 0;
                // })
                // .catch((error) => {
                //     console.error('Erreur:', error);
                //     alert('Erreur lors de l\'enregistrement de la vente');
                // });
            });
            
            // Ajouter les écouteurs d'événements
            addProductButton.addEventListener('click', addProductItem);
            calculateTotalButton.addEventListener('click', calculateTotal);
            
            // Ajouter un premier produit par défaut
            addProductItem();
        });
    </script>
</body>
</html>