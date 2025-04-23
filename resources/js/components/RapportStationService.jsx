import React, { useState } from 'react';
import { jsPDF } from 'jspdf';
import 'jspdf-autotable';
import { Download, Maximize, Minimize, Calendar, TrendingUp, MapPin, BarChart } from 'lucide-react';

const RapportStationService = ({ stationData }) => {
  const [expandedSection, setExpandedSection] = useState(null);
  
  // Données d'exemple - à remplacer par vos données réelles
  const data = stationData || {
    station: "Station JNP Yaoundé",
    date: "01/02/2025",
    produitsBlancsBlancs: {
      stockInitial: { gasoil: 5000, essence: 3000 },
      receptions: [{ date: "31/01/2025", gasoil: 2000, essence: 1000 }],
      sorties: { gasoil: 1200, essence: 800 },
      ventes: {
        ticketsValeurs: { gasoil: 600000, essence: 400000 },
        jnpPass: { gasoil: 300000, essence: 200000 },
        comptant: { gasoil: 900000, essence: 600000 }
      }
    },
    lubrifiants: {
      stockInitial: [
        { produit: "660x15w40/30l", quantite: 38 },
        { produit: "vulhd50/5l", quantite: 30 }
      ],
      receptions: [],
      sorties: [
        { produit: "VUL 660X 15w40", quantite: 1 }
      ],
      ventes: {
        ticketsValeurs: 50000,
        jnpPass: 25000,
        comptant: 75000
      }
    },
    gazAccessoires: {
      stockInitial: [
        { produit: "Recharge 12kg", quantite: 15 },
        { produit: "Recharge 6kg", quantite: 20 }
      ],
      receptions: [],
      sorties: [
        { produit: "Recharge 12kg", quantite: 3 },
        { produit: "Recharge 6kg", quantite: 5 }
      ],
      ventes: {
        ticketsValeurs: 30000,
        jnpPass: 15000,
        comptant: 55000
      }
    },
    infosComplementaires: {
      tv: 50000,
      resteAVerser: 20000,
      livraisonsAttente: {
        gasoil: 3000,
        essence: 2000
      }
    }
  };

  // Calculer les totaux
  const calculerStockFinal = (initial, receptions, sorties) => {
    const totalReceptions = receptions.reduce((sum, r) => sum + (r[initial.toLowerCase()] || 0), 0);
    return data.produitsBlancsBlancs.stockInitial[initial.toLowerCase()] + 
           totalReceptions - 
           data.produitsBlancsBlancs.sorties[initial.toLowerCase()];
  };

  const calculerTotalVentes = (type) => {
    return (data.produitsBlancsBlancs.ventes[type].gasoil || 0) + 
           (data.produitsBlancsBlancs.ventes[type].essence || 0);
  };

  const totalVentesProduitsBlancsBlancs = 
    calculerTotalVentes('ticketsValeurs') + 
    calculerTotalVentes('jnpPass') + 
    calculerTotalVentes('comptant');

  const totalVentesLubrifiants = 
    data.lubrifiants.ventes.ticketsValeurs + 
    data.lubrifiants.ventes.jnpPass + 
    data.lubrifiants.ventes.comptant;

  const totalVentesGazAccessoires = 
    data.gazAccessoires.ventes.ticketsValeurs + 
    data.gazAccessoires.ventes.jnpPass + 
    data.gazAccessoires.ventes.comptant;

  // Gestion de l'expansion des sections
  const toggleSection = (section) => {
    if (expandedSection === section) {
      setExpandedSection(null);
    } else {
      setExpandedSection(section);
    }
  };

  // Téléchargement du PDF
  const downloadPDF = () => {
    const doc = new jsPDF();
    
    // Titre
    doc.setFontSize(18);
    doc.text('Rapport Journalier de Station-Service', 105, 15, { align: 'center' });
    
    doc.setFontSize(12);
    doc.text(`Station: ${data.station} | Date: ${data.date}`, 105, 25, { align: 'center' });
    
    doc.line(20, 30, 190, 30);
    
    // Produits Blancs
    doc.setFontSize(14);
    doc.text('Résumé Général - Produits Blancs', 20, 40);
    
    doc.autoTable({
      startY: 45,
      head: [['Produit', 'Stock Initial', 'Réceptions', 'Sorties', 'Stock Final']],
      body: [
        ['Gasoil', 
         `${data.produitsBlancsBlancs.stockInitial.gasoil} L`, 
         `${data.produitsBlancsBlancs.receptions.reduce((sum, r) => sum + (r.gasoil || 0), 0)} L`, 
         `${data.produitsBlancsBlancs.sorties.gasoil} L`, 
         `${calculerStockFinal('gasoil')} L`],
        ['Essence', 
         `${data.produitsBlancsBlancs.stockInitial.essence} L`, 
         `${data.produitsBlancsBlancs.receptions.reduce((sum, r) => sum + (r.essence || 0), 0)} L`, 
         `${data.produitsBlancsBlancs.sorties.essence} L`, 
         `${calculerStockFinal('essence')} L`]
      ]
    });
    
    // Ventes Produits Blancs
    let yPos = doc.lastAutoTable.finalY + 10;
    doc.text('Ventes Produits Blancs (F)', 20, yPos);
    
    doc.autoTable({
      startY: yPos + 5,
      head: [['Mode de paiement', 'Gasoil', 'Essence', 'Total']],
      body: [
        ['Tickets Valeurs', 
         `${data.produitsBlancsBlancs.ventes.ticketsValeurs.gasoil}`, 
         `${data.produitsBlancsBlancs.ventes.ticketsValeurs.essence}`, 
         `${calculerTotalVentes('ticketsValeurs')}`],
        ['JNP Pass', 
         `${data.produitsBlancsBlancs.ventes.jnpPass.gasoil}`, 
         `${data.produitsBlancsBlancs.ventes.jnpPass.essence}`, 
         `${calculerTotalVentes('jnpPass')}`],
        ['Comptant', 
         `${data.produitsBlancsBlancs.ventes.comptant.gasoil}`, 
         `${data.produitsBlancsBlancs.ventes.comptant.essence}`, 
         `${calculerTotalVentes('comptant')}`],
        ['TOTAL', 
         `${data.produitsBlancsBlancs.ventes.ticketsValeurs.gasoil + 
            data.produitsBlancsBlancs.ventes.jnpPass.gasoil + 
            data.produitsBlancsBlancs.ventes.comptant.gasoil}`, 
         `${data.produitsBlancsBlancs.ventes.ticketsValeurs.essence + 
            data.produitsBlancsBlancs.ventes.jnpPass.essence + 
            data.produitsBlancsBlancs.ventes.comptant.essence}`, 
         `${totalVentesProduitsBlancsBlancs}`]
      ]
    });
    
    // Nouvelle page pour les lubrifiants
    doc.addPage();
    doc.setFontSize(14);
    doc.text('Détail des Lubrifiants', 20, 20);
    
    // Les autres sections seraient ajoutées de manière similaire...
    
    doc.save(`rapport-${data.station}-${data.date}.pdf`);
  };

  return (
    <div className="bg-gray-100 p-4 rounded-lg max-w-4xl mx-auto">
      <div className="bg-white rounded-lg shadow-md overflow-hidden">
        {/* En-tête */}
        <div className="bg-blue-600 text-white p-4 flex justify-between items-center">
          <div className="flex items-center">
            <MapPin className="mr-2" />
            <h1 className="text-xl font-bold">{data.station}</h1>
          </div>
          <div className="flex items-center">
            <Calendar className="mr-2" />
            <span>{data.date}</span>
          </div>
        </div>

        {/* Boutons d'action */}
        <div className="bg-gray-100 p-2 flex justify-end">
          <button 
            onClick={downloadPDF} 
            className="flex items-center bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
          >
            <Download size={16} className="mr-1" />
            Télécharger PDF
          </button>
        </div>

        {/* Section Produits Blancs */}
        <div className="border-b border-gray-200">
          <div 
            className="p-4 bg-gray-50 flex justify-between items-center cursor-pointer"
            onClick={() => toggleSection('produitsBlancsBlancs')}
          >
            <div className="flex items-center">
              <BarChart className="mr-2 text-blue-600" />
              <h2 className="text-lg font-semibold">Produits Blancs</h2>
            </div>
            {expandedSection === 'produitsBlancsBlancs' ? 
              <Minimize size={18} /> : 
              <Maximize size={18} />
            }
          </div>
          
          {expandedSection === 'produitsBlancsBlancs' && (
            <div className="p-4">
              <h3 className="font-medium mb-2">Stock et Mouvements</h3>
              <div className="overflow-x-auto">
                <table className="min-w-full bg-white">
                  <thead className="bg-gray-100">
                    <tr>
                      <th className="py-2 px-3 text-left">Produit</th>
                      <th className="py-2 px-3 text-right">Stock Initial</th>
                      <th className="py-2 px-3 text-right">Réceptions</th>
                      <th className="py-2 px-3 text-right">Sorties</th>
                      <th className="py-2 px-3 text-right">Stock Final</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td className="py-2 px-3 border-t">Gasoil</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.stockInitial.gasoil} L</td>
                      <td className="py-2 px-3 border-t text-right">
                        {data.produitsBlancsBlancs.receptions.reduce((sum, r) => sum + (r.gasoil || 0), 0)} L
                      </td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.sorties.gasoil} L</td>
                      <td className="py-2 px-3 border-t text-right">{calculerStockFinal('gasoil')} L</td>
                    </tr>
                    <tr>
                      <td className="py-2 px-3 border-t">Essence</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.stockInitial.essence} L</td>
                      <td className="py-2 px-3 border-t text-right">
                        {data.produitsBlancsBlancs.receptions.reduce((sum, r) => sum + (r.essence || 0), 0)} L
                      </td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.sorties.essence} L</td>
                      <td className="py-2 px-3 border-t text-right">{calculerStockFinal('essence')} L</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <h3 className="font-medium mt-4 mb-2">Détail des Réceptions</h3>
              <ul className="list-disc pl-5">
                {data.produitsBlancsBlancs.receptions.map((reception, index) => (
                  <li key={index}>
                    {reception.date}: Gasoil {reception.gasoil} L, Essence {reception.essence} L
                  </li>
                ))}
                {data.produitsBlancsBlancs.receptions.length === 0 && <li>Aucune réception</li>}
              </ul>

              <h3 className="font-medium mt-4 mb-2">Ventes (F)</h3>
              <div className="overflow-x-auto">
                <table className="min-w-full bg-white">
                  <thead className="bg-gray-100">
                    <tr>
                      <th className="py-2 px-3 text-left">Mode de paiement</th>
                      <th className="py-2 px-3 text-right">Gasoil</th>
                      <th className="py-2 px-3 text-right">Essence</th>
                      <th className="py-2 px-3 text-right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td className="py-2 px-3 border-t">Tickets Valeurs</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.ventes.ticketsValeurs.gasoil}</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.ventes.ticketsValeurs.essence}</td>
                      <td className="py-2 px-3 border-t text-right">{calculerTotalVentes('ticketsValeurs')}</td>
                    </tr>
                    <tr>
                      <td className="py-2 px-3 border-t">JNP Pass</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.ventes.jnpPass.gasoil}</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.ventes.jnpPass.essence}</td>
                      <td className="py-2 px-3 border-t text-right">{calculerTotalVentes('jnpPass')}</td>
                    </tr>
                    <tr>
                      <td className="py-2 px-3 border-t">Comptant</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.ventes.comptant.gasoil}</td>
                      <td className="py-2 px-3 border-t text-right">{data.produitsBlancsBlancs.ventes.comptant.essence}</td>
                      <td className="py-2 px-3 border-t text-right">{calculerTotalVentes('comptant')}</td>
                    </tr>
                    <tr className="font-semibold bg-gray-50">
                      <td className="py-2 px-3 border-t">TOTAL</td>
                      <td className="py-2 px-3 border-t text-right">
                        {data.produitsBlancsBlancs.ventes.ticketsValeurs.gasoil + 
                         data.produitsBlancsBlancs.ventes.jnpPass.gasoil + 
                         data.produitsBlancsBlancs.ventes.comptant.gasoil}
                      </td>
                      <td className="py-2 px-3 border-t text-right">
                        {data.produitsBlancsBlancs.ventes.ticketsValeurs.essence + 
                         data.produitsBlancsBlancs.ventes.jnpPass.essence + 
                         data.produitsBlancsBlancs.ventes.comptant.essence}
                      </td>
                      <td className="py-2 px-3 border-t text-right">{totalVentesProduitsBlancsBlancs}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          )}
        </div>

        {/* Section Lubrifiants */}
        <div className="border-b border-gray-200">
          <div 
            className="p-4 bg-gray-50 flex justify-between items-center cursor-pointer"
            onClick={() => toggleSection('lubrifiants')}
          >
            <div className="flex items-center">
              <TrendingUp className="mr-2 text-yellow-600" />
              <h2 className="text-lg font-semibold">Lubrifiants</h2>
            </div>
            {expandedSection === 'lubrifiants' ? 
              <Minimize size={18} /> : 
              <Maximize size={18} />
            }
          </div>
          
          {expandedSection === 'lubrifiants' && (
            <div className="p-4">
              {/* Contenu similaire à la section précédente, mais pour les lubrifiants */}
              <h3 className="font-medium mb-2">Stock Initial</h3>
              <div className="overflow-x-auto">
                <table className="min-w-full bg-white">
                  <thead className="bg-gray-100">
                    <tr>
                      <th className="py-2 px-3 text-left">Produit</th>
                      <th className="py-2 px-3 text-right">Quantité Initiale</th>
                    </tr>
                  </thead>
                  <tbody>
                    {data.lubrifiants.stockInitial.map((item, index) => (
                      <tr key={index}>
                        <td className="py-2 px-3 border-t">{item.produit}</td>
                        <td className="py-2 px-3 border-t text-right">{item.quantite}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>

              {/* Les autres tables pour les lubrifiants (sorties, stock final, ventes) */}
              
              <h3 className="font-medium mt-4 mb-2">Ventes (F)</h3>
              <div className="overflow-x-auto">
                <table className="min-w-full bg-white">
                  <thead className="bg-gray-100">
                    <tr>
                      <th className="py-2 px-3 text-left">Mode de paiement</th>
                      <th className="py-2 px-3 text-right">Montant</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td className="py-2 px-3 border-t">Tickets Valeurs</td>
                      <td className="py-2 px-3 border-t text-right">{data.lubrifiants.ventes.ticketsValeurs}</td>
                    </tr>
                    <tr>
                      <td className="py-2 px-3 border-t">JNP Pass</td>
                      <td className="py-2 px-3 border-t text-right">{data.lubrifiants.ventes.jnpPass}</td>
                    </tr>
                    <tr>
                      <td className="py-2 px-3 border-t">Comptant</td>
                      <td className="py-2 px-3 border-t text-right">{data.lubrifiants.ventes.comptant}</td>
                    </tr>
                    <tr className="font-semibold bg-gray-50">
                      <td className="py-2 px-3 border-t">TOTAL</td>
                      <td className="py-2 px-3 border-t text-right">{totalVentesLubrifiants}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          )}
        </div>

        {/* Section Gaz et Accessoires - similaire aux sections précédentes */}
        <div className="border-b border-gray-200">
          <div 
            className="p-4 bg-gray-50 flex justify-between items-center cursor-pointer"
            onClick={() => toggleSection('gazAccessoires')}
          >
            <div className="flex items-center">
              <TrendingUp className="mr-2 text-red-600" />
              <h2 className="text-lg font-semibold">Gaz et Accessoires</h2>
            </div>
            {expandedSection === 'gazAccessoires' ? 
              <Minimize size={18} /> : 
              <Maximize size={18} />
            }
          </div>
          
          {expandedSection === 'gazAccessoires' && (
            <div className="p-4">
              {/* Contenu pour la section Gaz et Accessoires */}
            </div>
          )}
        </div>

        {/* Section Informations Complémentaires */}
        <div>
          <div 
            className="p-4 bg-gray-50 flex justify-between items-center cursor-pointer"
            onClick={() => toggleSection('infosComplementaires')}
          >
            <div className="flex items-center">
              <TrendingUp className="mr-2 text-purple-600" />
              <h2 className="text-lg font-semibold">Informations Complémentaires</h2>
            </div>
            {expandedSection === 'infosComplementaires' ? 
              <Minimize size={18} /> : 
              <Maximize size={18} />
            }
          </div>
          
          {expandedSection === 'infosComplementaires' && (
            <div className="p-4">
              <h3 className="font-medium mb-2">Informations sur les Ventes</h3>
              <div className="grid grid-cols-2 gap-4 mb-4">
                <div className="bg-gray-50 p-3 rounded">
                  <div className="text-sm text-gray-600">TV</div>
                  <div className="text-xl font-semibold">{data.infosComplementaires.tv} F</div>
                </div>
                <div className="bg-gray-50 p-3 rounded">
                  <div className="text-sm text-gray-600">Reste à Verser</div>
                  <div className="text-xl font-semibold">{data.infosComplementaires.resteAVerser} F</div>
                </div>
              </div>

              <h3 className="font-medium mb-2">Livraisons en Attente ({data.date})</h3>
              <div className="grid grid-cols-2 gap-4">
                <div className="bg-blue-50 p-3 rounded">
                  <div className="text-sm text-blue-600">Gasoil</div>
                  <div className="text-xl font-semibold">{data.infosComplementaires.livraisonsAttente.gasoil} L</div>
                </div>
                <div className="bg-green-50 p-3 rounded">
                  <div className="text-sm text-green-600">Essence</div>
                  <div className="text-xl font-semibold">{data.infosComplementaires.livraisonsAttente.essence} L</div>
                </div>
              </div>
            </div>
          )}
        </div>

        {/* Pied de page */}
        <div className="p-4 bg-gray-50 text-sm text-gray-600 text-center">
          Rapport généré le {new Date().toLocaleString()} | Validé par: ___________________
        </div>
      </div>
    </div>
  );
};

export default RapportStationService;