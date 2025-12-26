import axios from 'axios';

const API_URL = 'http://localhost/tour_backend/api/index.php';

const api = axios.create({
    baseURL: API_URL,
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
});

export const login = async (email, password) => {
    const response = await api.post('?action=login', { email, password });
    return response.data;
};

export const getHotels = async () => {
    const response = await api.get('?action=hotels');
    return response.data;
};

export const getCars = async () => {
    const response = await api.get('?action=cars');
    return response.data;
};

export const getEvents = async () => {
    const response = await api.get('?action=events');
    return response.data;
};

export default api;
