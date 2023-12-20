import React from 'react';

const Installation = () => {
  return (
    <div>
      <h2>Setting Up Your React Environment</h2>
      <p>
        Before diving into React development, you need to set up your development environment. Follow these steps to get started:
      </p>
      <ol>
        <li>Install Node.js and npm on your machine if you haven't already.</li>
        <li>Create a new React app using the command: <code>npx create-react-app my-react-webpage</code></li>
        <li>Change into the app's directory: <code>cd my-react-webpage</code></li>
        <li>Start the development server: <code>npm start</code></li>
      </ol>
    </div>
  );
};

export default Installation;
