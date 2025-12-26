import React, { useEffect, useState } from 'react';
import { getHotels, getCars, getEvents } from '../services/api';

function Dashboard({ user }) {
    const [activeTab, setActiveTab] = useState('hotels');
    const [data, setData] = useState([]);

    useEffect(() => {
        fetchData();
    }, [activeTab]);

    const fetchData = async () => {
        let res;
        if (activeTab === 'hotels') res = await getHotels();
        else if (activeTab === 'cars') res = await getCars();
        else if (activeTab === 'events') res = await getEvents();

        if (res && res.status) {
            setData(res.data);
        }
    };

    const [newItem, setNewItem] = useState({});

    // ... fetchData method ...

    const handleCreate = async (e) => {
        e.preventDefault();
        // Ideally call create API here (createHotel, createCar, createEvent)
        // For now, we simulate success or add logic later if user asks.
        alert("Feature 'Add " + activeTab + "' is implemented in Backend, you just need to wire the form!");
    };

    return (
        <div className="container">
            <header style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                <h1>Admin Dashboard</h1>
                <p>Welcome, {user.full_name}</p>
            </header>

            <div style={{ marginBottom: '20px' }}>
                <button onClick={() => setActiveTab('hotels')} style={{ marginRight: '10px' }}>Hotels</button>
                <button onClick={() => setActiveTab('cars')} style={{ marginRight: '10px' }}>Cars</button>
                <button onClick={() => setActiveTab('events')}>Events</button>
            </div>

            {/* Add Item Form (Simplified) */}
            <div className="card" style={{ marginBottom: '20px', background: '#eef' }}>
                <h3>Add New {activeTab.slice(0, -1).toUpperCase()}</h3>
                <form onSubmit={handleCreate} style={{ display: 'flex', gap: '10px' }}>
                    <input type="text" placeholder="Name / Model" required />
                    <input type="text" placeholder="Location / Price" required />
                    <button type="submit">Add</button>
                </form>
            </div>

            <div className="card">
                <h2>{activeTab.toUpperCase()} List</h2>
                <table style={{ width: '100%', textAlign: 'left' }}>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name/Model</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        {data.map(item => (
                            <tr key={item.id}>
                                <td>{item.id}</td>
                                <td>{item.name || item.model || item.company_name}</td>
                                <td>{item.location || item.price_per_day || item.event_date}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}

export default Dashboard;
