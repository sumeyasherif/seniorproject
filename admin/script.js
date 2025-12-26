const API_URL = "http://localhost/tour_backend/api/index.php?action=";

// State
let currentTab = 'hotels';

// DOM Elements (Login)
const loginForm = document.getElementById('loginForm');

if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        let role = 'admin'; // Default fallback
        let name = 'Admin User';

        // Simple Role Simulation based on Email
        if (email.includes('admin')) role = 'admin';
        else if (email.includes('hotel')) role = 'hotel_manager';
        else if (email.includes('car')) role = 'car_manager';
        else if (email.includes('event')) role = 'event_organizer';
        else {
            document.getElementById('errorMsg').innerText = "Unknown Role. Try admin@tour.com, hotel@tour.com, car@tour.com, event@tour.com";
            return;
        }

        const user = { name: name, email: email, role: role };
        localStorage.setItem('user', JSON.stringify(user));
        window.location.href = 'dashboard.html';
    });
}

// DOM Elements (Dashboard)
const tableBody = document.getElementById('tableBody');
const pageTitle = document.getElementById('pageTitle');
const sidebarMenu = document.getElementById('sidebarMenu');
const userRoleDisplay = document.getElementById('userRoleDisplay');

// Menus Definition
const MENUS = {
    'admin': [
        { id: 'dashboard', label: 'Dashboard' },
        { id: 'hotels', label: 'Hotel Management' },
        { id: 'cars', label: 'Car Rental Mgmt' },
        { id: 'events', label: 'Event Mgmt' },
        { id: 'admin_users', label: 'User Management' },
        { id: 'admin_bookings', label: 'Booking Mgmt' },
        { id: 'admin_payments', label: 'Payment Mgmt' },
        { id: 'notifications', label: 'Notifications' }
    ],
    'hotel_manager': [
        { id: 'hotels', label: 'Hotel Management' },
        { id: 'admin_bookings', label: 'My Bookings' }
    ],
    'car_manager': [
        { id: 'cars', label: 'Car Rental Mgmt' },
        { id: 'admin_bookings', label: 'My Rentals' }
    ],
    'event_organizer': [
        { id: 'events', label: 'Event Management' }
    ]
};

function initDashboard() {
    const userStr = localStorage.getItem('user');
    if (!userStr) {
        window.location.href = 'index.html';
        return;
    }
    const user = JSON.parse(userStr);
    if (userRoleDisplay) userRoleDisplay.innerText = user.role.toUpperCase();

    // Render Sidebar
    const roleMenus = MENUS[user.role] || MENUS['admin'];
    sidebarMenu.innerHTML = '';

    roleMenus.forEach((menu, index) => {
        const li = document.createElement('li');
        li.innerText = menu.label;
        li.id = `tab-${menu.id}`;
        li.onclick = () => switchTab(menu.id);
        if (index === 0) {
            li.classList.add('active-tab');
            switchTab(menu.id); // Load first tab
        }
        sidebarMenu.appendChild(li);
    });
}

function switchTab(tab) {
    currentTab = tab;

    // Update Sidebar UI
    document.querySelectorAll('.sidebar li').forEach(li => li.classList.remove('active-tab'));
    if (document.getElementById(`tab-${tab}`)) {
        document.getElementById(`tab-${tab}`).classList.add('active-tab');
    }

    // Update Title
    pageTitle.innerText = tab.replace('_', ' ').toUpperCase();

    // Fetch Data
    fetchData(tab);
}

// Call Init on Load
if (window.location.pathname.includes('dashboard.html')) {
    initDashboard();
}

async function fetchData(type) {
    tableBody.innerHTML = '<tr><td colspan="4">Loading...</td></tr>';

    try {
        const response = await fetch(API_URL + type);
        const json = await response.json();

        if (json.status) {
            renderTable(json.data);
        } else {
            tableBody.innerHTML = '<tr><td colspan="4">No data found or API error.</td></tr>';
        }
    } catch (error) {
        console.error(error);
        tableBody.innerHTML = '<tr><td colspan="4">Error connecting to server. Ensure XAMPP is running.</td></tr>';
    }
}

function renderTable(data) {
    tableBody.innerHTML = '';
    data.forEach(item => {
        const row = document.createElement('tr');

        // Dynamic Fields based on Type
        let name = item.name || item.model || item.company_name || item.item || 'User #' + item.id;
        let detail = item.location || item.price_per_day || item.event_date || item.amount || item.role || item.status || 'N/A';
        let detail2 = item.user || '';

        // Customize output for new types
        let displayDetail = detail;
        if (detail2) displayDetail += ` (by ${detail2})`;

        row.innerHTML = `
            <td>${item.id}</td>
            <td><strong>${name}</strong></td>
            <td>${displayDetail}</td>
            <td>
                <button onclick="editItem(${item.id}, '${name}', '${detail}')" style="width:auto; padding:5px 10px; background:#ffc107; color:black;">Edit</button>
                <button onclick="deleteItem(${item.id})" style="width:auto; padding:5px 10px; background:#dc3545;">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Actions
async function deleteItem(id) {
    if (!confirm("Are you sure you want to delete this item?")) return;

    // Determine endpoint based on tab
    let action = 'delete_' + currentTab.slice(0, -1); // delete_hotel

    try {
        const response = await fetch(API_URL + action, {
            method: 'POST',
            body: JSON.stringify({ id: id })
        });
        const json = await response.json();
        alert(json.message);
        fetchData(currentTab); // Refresh
    } catch (e) {
        console.error(e);
        alert("Action failed (ensure backend has delete_" + currentTab.slice(0, -1) + " implemented)");
    }
}

function editItem(id, name, detail) {
    document.getElementById('addModal').style.display = 'block';
    document.getElementById('modalTitle').innerText = 'Edit ' + currentTab.slice(0, -1);

    document.getElementById('itemId').value = id;
    document.getElementById('itemName').value = name;
    document.getElementById('itemDetail').value = detail;
}

// Modal Logic
function openModal() {
    document.getElementById('addModal').style.display = 'block';
    document.getElementById('modalTitle').innerText = 'Add New ' + currentTab.slice(0, -1);
    document.getElementById('addForm').reset();
    document.getElementById('itemId').value = ''; // Clear ID for new add
}

function closeModal() {
    document.getElementById('addModal').style.display = 'none';
}

document.getElementById('addForm')?.addEventListener('submit', async (e) => {
    e.preventDefault();

    const id = document.getElementById('itemId').value;
    const name = document.getElementById('itemName').value;
    const detail = document.getElementById('itemDetail').value;

    // Simple mapping for demo: name=name, detail matches location/price
    // In a real app we would map fields dynamically

    const payload = {
        id: id,
        name: name,
        location: detail, // For Hotel
        description: "Updated via Admin",
        image_url: ""
    };

    let action = id ? ('update_' + currentTab.slice(0, -1)) : ('create_' + currentTab.slice(0, -1));

    try {
        const response = await fetch(API_URL + action, {
            method: 'POST',
            body: JSON.stringify(payload)
        });
        const json = await response.json();
        alert(json.message || "Action Completed");
        closeModal();
        fetchData(currentTab);
    } catch (e) {
        alert("Error: " + e);
    }
});

function logout() {
    localStorage.removeItem('user');
    window.location.href = 'index.html';
}
