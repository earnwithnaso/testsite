# 🚀 Deploy Earn With Nazo to cPanel Using Git

This guide will help you deploy your Laravel application to your live website using cPanel's Git Version Control feature.

---

## 📋 Prerequisites

Before starting, ensure you have:
- ✅ cPanel access with Git Version Control enabled
- ✅ SSH access to your hosting account (optional but recommended)
- ✅ A GitHub/GitLab/Bitbucket account
- ✅ MySQL database created in cPanel
- ✅ PHP 8.1+ available on your hosting

---

## 🔧 Part 1: Prepare Your Local Repository

### 1.1 Build Production Assets

Before deploying, you need to build your CSS/JS for production:

```bash
# Stop the dev server (Ctrl+C in the terminal running npm run dev)
npm run build
```

This creates optimized production files in `public/build/`.

### 1.2 Commit Your Changes

```bash
git add .
git commit -m "Prepare for production deployment"
```

### 1.3 Push to Remote Repository

If you haven't already, create a repository on GitHub/GitLab and push:

```bash
# Add remote (replace with your repository URL)
git remote add origin https://github.com/yourusername/earn-with-nazo.git

# Push to main branch
git push -u origin main
```

---

## 🌐 Part 2: Deploy Using cPanel Git Version Control

### 2.1 Access Git Version Control in cPanel

1. Log into your **cPanel**
2. Navigate to **Files** section
3. Click on **Git™ Version Control**

### 2.2 Create Repository

1. Click **"Create"** button
2. Fill in the details:
   - **Clone URL**: Your repository URL (e.g., `https://github.com/yourusername/earn-with-nazo.git`)
   - **Repository Path**: `/home/yourusername/repositories/earn-with-nazo`
   - **Repository Name**: `earn-with-nazo`
3. Click **"Create"**

### 2.3 Pull the Repository

After creation, cPanel will clone your repository. Click **"Manage"** to see details.

---

## 📁 Part 3: Set Up Application Structure

### 3.1 Access File Manager or SSH

**Option A: Using File Manager**
1. Go to cPanel → **File Manager**
2. Navigate to `public_html`

**Option B: Using SSH (Recommended)**
```bash
ssh yourusername@yourdomain.com
cd public_html
```

### 3.2 Move Files to Correct Location

Your Laravel app should NOT be in `public_html` directly. Here's the correct structure:

```
/home/yourusername/
├── repositories/
│   └── earn-with-nazo/          # Git repository (already here)
├── laravel/
│   └── earn-with-nazo/          # Symlink or copy of repository
└── public_html/
    └── (Laravel public folder contents will go here)
```

**Create symlink or copy:**

```bash
# Navigate to home directory
cd ~

# Create laravel directory if it doesn't exist
mkdir -p laravel

# Create symlink to repository
ln -s ~/repositories/earn-with-nazo ~/laravel/earn-with-nazo

# OR copy the repository
# cp -r ~/repositories/earn-with-nazo ~/laravel/
```

---

## 🔗 Part 4: Configure Public Directory

### 4.1 Point public_html to Laravel's public folder

**Option A: Using .htaccess (Subdomain/Addon Domain)**

If using a subdomain or addon domain, point the document root to:
`/home/yourusername/laravel/earn-with-nazo/public`

**Option B: Using Symlinks (Main Domain)**

```bash
# Backup current public_html
mv ~/public_html ~/public_html_backup

# Create symlink
ln -s ~/laravel/earn-with-nazo/public ~/public_html
```

**Option C: Copy public contents (Alternative)**

```bash
# Copy Laravel public folder contents to public_html
cp -r ~/laravel/earn-with-nazo/public/* ~/public_html/

# Update index.php to point to correct paths
```

### 4.2 Update index.php (if using Option C)

Edit `public_html/index.php` and update paths:

```php
// Change this line:
require __DIR__.'/../vendor/autoload.php';
// To:
require __DIR__.'/../laravel/earn-with-nazo/vendor/autoload.php';

// Change this line:
$app = require_once __DIR__.'/../bootstrap/app.php';
// To:
$app = require_once __DIR__.'/../laravel/earn-with-nazo/bootstrap/app.php';
```

---

## ⚙️ Part 5: Install Dependencies & Configure

### 5.1 SSH into Your Server

```bash
ssh yourusername@yourdomain.com
cd ~/laravel/earn-with-nazo
```

### 5.2 Install Composer Dependencies

```bash
# Check PHP version
php -v

# Install dependencies (without dev packages)
composer install --optimize-autoloader --no-dev
```

### 5.3 Set Up Environment File

```bash
# Copy example environment file
cp .env.example .env

# Edit .env file
nano .env
```

Update these critical settings in `.env`:

```env
APP_NAME="Earn With Nazo"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Generate this in next step
APP_KEY=

# Mail settings (if using email)
MAIL_MAILER=smtp
MAIL_HOST=mail.yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 5.4 Generate Application Key

```bash
php artisan key:generate
```

### 5.5 Set Up Database

```bash
# Run migrations
php artisan migrate --force

# Seed database (if you have seeders)
php artisan db:seed --force
```

### 5.6 Set Permissions

```bash
# Set correct permissions
chmod -R 755 ~/laravel/earn-with-nazo
chmod -R 775 ~/laravel/earn-with-nazo/storage
chmod -R 775 ~/laravel/earn-with-nazo/bootstrap/cache

# If using Apache
chown -R yourusername:yourusername ~/laravel/earn-with-nazo
```

### 5.7 Optimize Application

```bash
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

## 🗄️ Part 6: Database Setup in cPanel

### 6.1 Create MySQL Database

1. Go to cPanel → **MySQL® Databases**
2. Create a new database: `yourusername_earnwithnaso`
3. Create a new user with a strong password
4. Add user to database with **ALL PRIVILEGES**
5. Note down the database name, username, and password

### 6.2 Import Database (if you have a backup)

1. Go to cPanel → **phpMyAdmin**
2. Select your database
3. Click **Import** tab
4. Choose your SQL file (`Earn_with_naso_database.sql`)
5. Click **Go**

---

## 🔒 Part 7: Security & SSL

### 7.1 Install SSL Certificate

1. Go to cPanel → **SSL/TLS Status**
2. Enable **AutoSSL** or install Let's Encrypt certificate
3. Update `.env` file: `APP_URL=https://yourdomain.com`

### 7.2 Force HTTPS

Add to `public/.htaccess` (after `RewriteEngine On`):

```apache
# Force HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 7.3 Hide Sensitive Files

Ensure `.env` is NOT accessible:

```apache
# In public/.htaccess, add:
<Files .env>
    Order allow,deny
    Deny from all
</Files>
```

---

## 🔄 Part 8: Update Workflow (Future Updates)

When you make changes locally and want to deploy:

### 8.1 Local Changes

```bash
# Build production assets
npm run build

# Commit changes
git add .
git commit -m "Your update message"
git push origin main
```

### 8.2 Pull Updates on Server

**Via cPanel:**
1. Go to **Git™ Version Control**
2. Click **Manage** on your repository
3. Click **Pull or Deploy** → **Update from Remote**

**Via SSH:**
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

## 🐛 Troubleshooting

### Issue: 500 Internal Server Error

**Solutions:**
```bash
# Check Laravel logs
tail -f ~/laravel/earn-with-nazo/storage/logs/laravel.log

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check permissions
chmod -R 775 storage bootstrap/cache
```

### Issue: Assets Not Loading

**Solutions:**
1. Ensure `npm run build` was executed locally
2. Check `public/build` folder exists
3. Verify `.env` has correct `APP_URL`
4. Clear browser cache

### Issue: Database Connection Error

**Solutions:**
1. Verify database credentials in `.env`
2. Check database exists in cPanel
3. Ensure user has privileges
4. Try `DB_HOST=127.0.0.1` instead of `localhost`

### Issue: Git Pull Fails

**Solutions:**
```bash
# Stash local changes
git stash

# Pull updates
git pull origin main

# Reapply stashed changes
git stash pop
```

---

## ✅ Verification Checklist

After deployment, verify:

- [ ] Website loads at your domain
- [ ] SSL certificate is active (https://)
- [ ] Homepage displays correctly with styling
- [ ] Navigation works
- [ ] Login/Register pages work
- [ ] Database connection is successful
- [ ] Images and assets load properly
- [ ] Admin panel is accessible
- [ ] Email functionality works (if configured)

---

## 📞 Need Help?

If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check Apache error logs in cPanel
3. Enable debug mode temporarily: `APP_DEBUG=true` (remember to disable after)
4. Contact your hosting support for server-specific issues

---

## 🎉 Congratulations!

Your **Earn With Nazo** application is now live! 🚀

**Next Steps:**
- Set up regular backups
- Configure email notifications
- Set up monitoring
- Add courses and content
- Test all functionality thoroughly

---

*Last Updated: December 13, 2025*
