# 🚀 SIMPLE DEPLOYMENT STEPS - Earn With Nazo

Follow these steps **IN ORDER** to deploy your application to cPanel.

---

## ✅ STEP 1: Push Code to GitHub

Your repository: `https://github.com/earnwithnaso/testsite.git`

**Run this command in your terminal:**

```bash
cd "/Users/enohmichael/Downloads/EARN WITH NAZO"
git push origin main
```

✅ **Verify:** Go to https://github.com/earnwithnaso/testsite and confirm your latest changes are there.

---

## ✅ STEP 2: Create MySQL Database in cPanel

1. Log into your **cPanel**
2. Go to **MySQL® Databases**
3. Create a new database:
   - Database Name: `earnwithnaso_db` (or your choice)
   - Click **Create Database**
4. Create a database user:
   - Username: `earnwithnaso_user`
   - Password: (create a strong password - SAVE IT!)
   - Click **Create User**
5. Add user to database:
   - Select the user and database
   - Grant **ALL PRIVILEGES**
   - Click **Add**

✅ **Write down:**
- Database name: `_________________`
- Username: `_________________`
- Password: `_________________`

---

## ✅ STEP 3: Set Up Git Repository in cPanel

1. In cPanel, go to **Git™ Version Control**
2. Click **Create** button
3. Fill in the form:
   - **Clone URL:** `https://github.com/earnwithnaso/testsite.git`
   - **Repository Path:** `/home/YOUR_USERNAME/repositories/earn-with-nazo`
   - **Repository Name:** `earn-with-nazo`
4. Click **Create**
5. Wait for cPanel to clone the repository (may take 1-2 minutes)

✅ **Verify:** You should see "Repository created successfully"

---

## ✅ STEP 4: Create Application Directory

**Option A: Using File Manager**

1. Go to cPanel → **File Manager**
2. Navigate to your home directory
3. Create new folder: `laravel`
4. Inside `laravel`, create a symlink or copy the repository

**Option B: Using SSH (Recommended)**

```bash
# Connect to your server
ssh YOUR_USERNAME@yourdomain.com

# Create directory structure
mkdir -p ~/laravel
ln -s ~/repositories/earn-with-nazo ~/laravel/earn-with-nazo
```

---

## ✅ STEP 5: Point Domain to Laravel Public Folder

**Method 1: Using cPanel (Subdomain/Addon Domain)**

1. Go to **Domains** in cPanel
2. Find your domain
3. Click **Manage**
4. Change **Document Root** to:
   ```
   /home/YOUR_USERNAME/laravel/earn-with-nazo/public
   ```
5. Click **Save**

**Method 2: Using Symlink (Main Domain)**

```bash
# SSH into server
ssh YOUR_USERNAME@yourdomain.com

# Backup current public_html
mv ~/public_html ~/public_html_backup

# Create symlink
ln -s ~/laravel/earn-with-nazo/public ~/public_html
```

---

## ✅ STEP 6: Install Composer Dependencies

**SSH into your server:**

```bash
ssh YOUR_USERNAME@yourdomain.com
cd ~/laravel/earn-with-nazo
composer install --optimize-autoloader --no-dev
```

**If you get "composer: command not found":**

```bash
# Use full path to composer
/usr/local/bin/composer install --optimize-autoloader --no-dev

# OR download composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php composer.phar install --optimize-autoloader --no-dev
```

---

## ✅ STEP 7: Configure Environment File

```bash
# Still in SSH
cd ~/laravel/earn-with-nazo

# Copy example file
cp .env.example .env

# Edit the file
nano .env
```

**Update these lines in .env:**

```env
APP_NAME="Earn With Nazo"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME_FROM_STEP2
DB_USERNAME=YOUR_DATABASE_USER_FROM_STEP2
DB_PASSWORD=YOUR_DATABASE_PASSWORD_FROM_STEP2
```

**Save and exit:**
- Press `Ctrl + X`
- Press `Y`
- Press `Enter`

---

## ✅ STEP 8: Generate Application Key

```bash
cd ~/laravel/earn-with-nazo
php artisan key:generate
```

✅ **Verify:** You should see "Application key set successfully"

---

## ✅ STEP 9: Set File Permissions

```bash
cd ~/laravel/earn-with-nazo

# Set directory permissions
chmod -R 755 .
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set ownership (replace YOUR_USERNAME)
chown -R YOUR_USERNAME:YOUR_USERNAME .
```

---

## ✅ STEP 10: Run Database Migrations

```bash
cd ~/laravel/earn-with-nazo
php artisan migrate --force
```

**If you have a database backup to import:**

1. Go to cPanel → **phpMyAdmin**
2. Select your database
3. Click **Import** tab
4. Choose `Earn_with_naso_database.sql`
5. Click **Go**

---

## ✅ STEP 11: Optimize Application

```bash
cd ~/laravel/earn-with-nazo

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

---

## ✅ STEP 12: Install SSL Certificate

1. Go to cPanel → **SSL/TLS Status**
2. Find your domain
3. Click **Run AutoSSL**
4. Wait for certificate to install

**OR use Let's Encrypt:**

1. Go to cPanel → **SSL/TLS**
2. Click **Manage SSL Sites**
3. Select your domain
4. Install Let's Encrypt certificate

---

## ✅ STEP 13: Test Your Website

1. Open your browser
2. Go to: `https://yourdomain.com`
3. Check:
   - ✅ Homepage loads
   - ✅ Styling appears correctly
   - ✅ Navigation works
   - ✅ Login page loads
   - ✅ Register page loads

---

## ✅ STEP 14: Create Admin User

**SSH into server:**

```bash
cd ~/laravel/earn-with-nazo
php artisan tinker
```

**In tinker console, run:**

```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@yourdomain.com';
$user->password = bcrypt('your-secure-password');
$user->role = 'admin';
$user->save();
exit
```

**Now you can login at:** `https://yourdomain.com/login`

---

## 🔄 FUTURE UPDATES (When You Make Changes)

### On Your Local Computer:

```bash
cd "/Users/enohmichael/Downloads/EARN WITH NAZO"

# Make your changes, then:
npm run build
git add .
git commit -m "Description of changes"
git push origin main
```

### On Your Server (via SSH):

```bash
cd ~/laravel/earn-with-nazo
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🐛 TROUBLESHOOTING

### Problem: 500 Internal Server Error

**Solution:**
```bash
cd ~/laravel/earn-with-nazo
tail -50 storage/logs/laravel.log
```

Check the error and fix accordingly.

### Problem: Page shows but no styling

**Solution:**
1. Check `public/build` folder exists
2. Clear browser cache
3. Check `.env` has correct `APP_URL`

### Problem: Database connection error

**Solution:**
1. Verify database credentials in `.env`
2. Try changing `DB_HOST=localhost` to `DB_HOST=127.0.0.1`
3. Check database exists in cPanel

### Problem: Permission denied errors

**Solution:**
```bash
cd ~/laravel/earn-with-nazo
chmod -R 775 storage bootstrap/cache
```

---

## 📞 NEED HELP?

- Check Laravel logs: `storage/logs/laravel.log`
- Check Apache logs in cPanel
- Contact hosting support for server issues

---

## 🎉 CONGRATULATIONS!

Your **Earn With Nazo** application is now live!

**Next steps:**
- Add courses
- Test all features
- Set up backups
- Monitor error logs

---

**Repository:** https://github.com/earnwithnaso/testsite
**Last Updated:** December 13, 2025
