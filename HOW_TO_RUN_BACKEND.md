# 🚀 How to Run the Backend

## Step-by-Step Guide to Start Your Backend Server

---

## 📋 **Prerequisites**

1. **XAMPP** must be installed on your computer
2. Your project is located at: `C:\xampp\htdocs\tour_backend\`

---

## ✅ **Step 1: Start XAMPP Services**

### **Option A: Using XAMPP Control Panel (Recommended)**

1. **Open XAMPP Control Panel**
   - Press `Windows Key` and search for "XAMPP Control Panel"
   - Or navigate to: `C:\xampp\xampp-control.exe`

2. **Start Required Services**
   - Click **"Start"** button next to **Apache** ✅
   - Click **"Start"** button next to **MySQL** ✅
   
   **Both should show green "Running" status**

   ```
   ✅ Apache   - Running (Port 80)
   ✅ MySQL    - Running (Port 3306)
   ```

---

## ✅ **Step 2: Verify Database is Created**

1. **Open phpMyAdmin**
   - Open your browser
   - Go to: `http://localhost/phpmyadmin`

2. **Check Database**
   - Look for database named: **`tour_travel_system`**
   - If it doesn't exist, run the SQL file:
     - Go to **Import** tab
     - Select file: `data/tour_data.sql`
     - Click **Go**

3. **Verify Tables**
   - Click on `tour_travel_system` database
   - You should see these tables:
     - ✅ users
     - ✅ hotels
     - ✅ rooms
     - ✅ cars
     - ✅ events
     - ✅ bookings
     - ✅ payments
     - ✅ notifications

---

## ✅ **Step 3: Test Backend API**

### **Test API Endpoints in Browser**

Open these URLs in your browser to test:

#### **1. Test Hotels API**
```
http://localhost/tour_backend/api/index.php?action=hotels
```

**Expected Response:**
```json
{
  "status": true,
  "data": [
    {
      "id": 1,
      "name": "Blue Sky Hotel",
      "location": "Addis Ababa",
      "description": "Luxury 5-star hotel...",
      "image_url": "https://images.unsplash.com/...",
      "price_per_night": 80.00
    }
  ]
}
```

#### **2. Test Cars API**
```
http://localhost/tour_backend/api/index.php?action=cars
```

#### **3. Test Events API**
```
http://localhost/tour_backend/api/index.php?action=events
```

---

## ✅ **Step 4: Test with Android App**

### **For Android Emulator:**

1. **Backend URL in Android:**
   ```
   http://10.0.2.2/tour_backend/api/
   ```
   - `10.0.2.2` is the special IP for Android emulator to access localhost

2. **Update RetrofitClient.java:**
   - File: `android_source/app/src/main/java/com/example/tour/api/RetrofitClient.java`
   - Should already have: `http://10.0.2.2/tour_backend/api/`

### **For Real Android Device:**

1. **Find Your Computer's IP Address:**
   - **Windows:** Open Command Prompt, type: `ipconfig`
   - Look for **IPv4 Address** (e.g., `192.168.1.100`)
   
2. **Update RetrofitClient.java:**
   ```java
   private static final String BASE_URL = "http://192.168.1.100/tour_backend/api/";
   ```
   - Replace `192.168.1.100` with your actual IP

3. **Important:** Make sure your phone and computer are on the **same WiFi network**

---

## 🔧 **Troubleshooting**

### **Problem: Apache won't start**

**Solutions:**
1. **Port 80 is already in use:**
   - Close Skype or other apps using port 80
   - Or change Apache port in XAMPP settings

2. **Check XAMPP Error Log:**
   - Click **"Logs"** button next to Apache
   - Read error messages

### **Problem: MySQL won't start**

**Solutions:**
1. **Port 3306 is already in use:**
   - Close other MySQL services
   - Or change MySQL port in XAMPP settings

2. **Check MySQL Error Log:**
   - Click **"Logs"** button next to MySQL

### **Problem: API returns error**

**Check:**
1. ✅ Apache is running
2. ✅ MySQL is running
3. ✅ Database `tour_travel_system` exists
4. ✅ Tables have data
5. ✅ File path is correct: `C:\xampp\htdocs\tour_backend\api\index.php`

### **Problem: Android app can't connect**

**Check:**
1. ✅ Apache is running
2. ✅ Test API in browser first (Step 3)
3. ✅ Correct URL in RetrofitClient.java
4. ✅ For real device: Same WiFi network
5. ✅ For emulator: Use `10.0.2.2`

---

## 📝 **Quick Test Commands**

### **Test in Browser (GET requests):**

```bash
# Hotels
http://localhost/tour_backend/api/index.php?action=hotels

# Cars
http://localhost/tour_backend/api/index.php?action=cars

# Events
http://localhost/tour_backend/api/index.php?action=events
```

### **Test with cURL (POST requests):**

```bash
# Test Login
curl -X POST http://localhost/tour_backend/api/index.php?action=login \
  -H "Content-Type: application/json" \
  -d "{\"email\":\"test@test.com\",\"password\":\"123456\"}"
```

---

## ✅ **Verification Checklist**

Before running Android app, verify:

- [ ] ✅ XAMPP Control Panel is open
- [ ] ✅ Apache is **Running** (green)
- [ ] ✅ MySQL is **Running** (green)
- [ ] ✅ Database `tour_travel_system` exists
- [ ] ✅ Tables have sample data
- [ ] ✅ API test in browser works
- [ ] ✅ RetrofitClient.java has correct URL
- [ ] ✅ Android app has INTERNET permission

---

## 🎯 **Summary**

**To run backend:**
1. Start **Apache** in XAMPP ✅
2. Start **MySQL** in XAMPP ✅
3. Test API: `http://localhost/tour_backend/api/index.php?action=hotels`
4. Run Android app

**That's it!** Your backend is now running! 🚀

---

## 📞 **Need Help?**

If you see errors:
1. Check XAMPP logs
2. Verify database exists
3. Test API in browser first
4. Check file paths are correct

