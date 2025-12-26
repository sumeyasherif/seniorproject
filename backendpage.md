

---



---

## 2 Admin & others NEED pages

In **real projects and student projects**, backend usually has **TWO parts**:

### 🔹 Part A: API Backend (for mobile app)

* No UI
* Only JSON responses
* Used by:

  * Tourist (mobile app)
  * Payment system
  * Notifications

### 🔹 Part B: Admin Web Panel (HAS pages)

* HTML pages
* Used by:

  * Admin
  * Hotel manager
  * Car rental manager
  * Event organizer

👉 This is exactly what your **documentation already supports**
(React.js admin page + PHP backend)

---

## 3️⃣ Backend Pages (Admin Panel)


---

## 🖥️ BACKEND WEB PAGES (ADMIN & MANAGERS)

### ✅ Total Backend Pages = **9 pages**

These are **web pages** (PHP or React).

---

### 🔐 1. Admin Login Page

* Admin / Manager login
* Role-based access

---

### 📊 2. Admin Dashboard

* Total users
* Total bookings
* Total payments
* Charts

---

### 🏨 3. Hotel Management Page

**Used by:** Admin / Hotel Manager

* Add hotel
* Edit hotel
* Delete hotel
* Manage rooms

---

### 🚗 4. Car Rental Management Page

**Used by:** Admin / Car Manager

* Add car
* Update car
* Availability

---

### 🎉 5. Event Management Page

**Used by:** Admin / Event Organizer

* Add event
* Select date (calendar)
* Location

---

### 👤 6. User Management Page

**Used by:** Admin

* View users
* Block / activate users

---

### 📅 7. Booking Management Page

**Used by:** Admin

* View hotel bookings
* View car rentals
* Cancel / approve

---

### 💳 8. Payment Management Page

**Used by:** Admin

* View payments
* Approve (fake/manual)

---

### 🔔 9. Notification Management Page

**Used by:** Admin

* Send notifications
* View notification logs

---

## 4️⃣ Who uses WHAT? (Very clear mapping)

| Actor              | Uses Mobile App | Uses Admin Web Pages |
| ------------------ | --------------- | -------------------- |
| Tourist            | ✅               | ❌                    |
| Admin              | ❌               | ✅                    |
| Hotel Manager      | ❌               | ✅                    |
| Car Rental Manager | ❌               | ✅                    |
| Event Organizer    | ❌               | ✅                    |
| Payment System     | ❌               | ❌ (API only)         |

---

## 5️⃣ Final Count (VERY IMPORTANT)

### 📱 Frontend (Mobile App)

* **16 pages**

### 🖥️ Backend (Web Admin Panel)

* **9 pages**

### 🔧 Backend (API Controllers)

* **10 modules**

### 👥 Total Actors

* **6 actors**

---

## 6️⃣ How to explain this in defense (READY SENTENCE)

You can say:

> “Our system has two interfaces: a **mobile frontend** for tourists and a **web-based admin backend** for system administrators and service providers. The backend also exposes RESTful APIs consumed by the mobile application.”

This is **perfect examiner language** ✅

---

## 7️⃣ Next step suggestion

Next, we should:

* Draw **system architecture diagram**
* OR design **admin panel page flow**
* OR start **database tables**

