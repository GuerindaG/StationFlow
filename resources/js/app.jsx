import './bootstrap';

import './components/Example';

import React from 'react';
import ReactDOM from 'react-dom/client';
import RapportStationService from './components/RapportStationService';

const stationData = {}; // ici tu peux passer des données dynamiques plus tard

ReactDOM.createRoot(document.getElementById('rapport-root')).render(
  <React.StrictMode>
    <RapportStationService stationData={stationData} />
  </React.StrictMode>
);

