import React from 'react';
import './App.css';
import Introduction from './Introduction';
import BuildingPage from './BuildingPage';
import Difficulties from './Difficulties';
import Installation from './Installation';
import Solutions from './Solutions';

function App() {
  return (
    <div>
      <div className="container">
        <Introduction />
      </div>
      <div className="container">
        <BuildingPage />
      </div>
      <div className="container">
        <Difficulties />
      </div>
      <div className="container">
        <Installation />
      </div>
      <div className="container">
        <Solutions />
      </div>
    </div>
  );
}

export default App;
