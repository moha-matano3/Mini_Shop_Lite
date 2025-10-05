# 🛍️ MiniShop Lite  
*A full-stack Laravel eCommerce demo built for the **Red Giant Laravel Full Stack Intern Assessment.***

---

## 🚀 How to Run This Project

Follow these steps to set up and run the project locally.

---

### 1️⃣ Clone this repository
```bash
git clone https://github.com/moha-matano3/Mini_Shop_Lite.git
cd Mini_Shop_Lite
```
### 2️⃣ run the following to Install dependencies
```bash
composer install
npm install
```
### 3️⃣ run the following to create a .env file and link to the database accordingly
```bash
cp .env.example .env
```
### 4️⃣ Generate Application key
```bash
php artisan key:generate
```
### 5️⃣Run Migrations and Seed the Database
```bash
php artisan migrate --seed
```
### 6️⃣ To start the project run this on terminal 1
```bash
php artisan serve
```
### 7️⃣ Then run this on terminal 2
```bash
npm run dev
```