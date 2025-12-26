import React, { useState } from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import Login from './components/Login';
import Dashboard from './components/Dashboard';

function App() {
    const [user, setUser] = useState(null);

    return (
        <Routes>
            <Route path="/login" element={<Login setUser={setUser} />} />
            <Route
                path="/"
                element={user ? <Dashboard user={user} /> : <Navigate to="/login" />}
            />
        </Routes>
    );
}

export default App;
