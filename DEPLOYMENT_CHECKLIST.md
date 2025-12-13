# 🚀 Pre-Deployment Checklist

Complete this checklist before deploying to production:

## ✅ Code Preparation

- [x] Production assets built (`npm run build`)
- [x] `.env.example` cleaned (no sensitive data)
- [x] `.cpanel.yml` created for automated deployment
- [ ] All features tested locally
- [ ] Database migrations tested
- [ ] No debug code or console.logs left

## ✅ Git Repository

- [ ] All changes committed
- [ ] Repository pushed to GitHub/GitLab/Bitbucket
- [ ] Repository is private (recommended) or public
- [ ] `.gitignore` properly configured

## ✅ Server Requirements

- [ ] PHP 8.1+ available on hosting
- [ ] Composer available
- [ ] MySQL database created in cPanel
- [ ] Database user created with privileges
- [ ] SSH access enabled (optional but recommended)
- [ ] Git Version Control enabled in cPanel

## ✅ Domain & SSL

- [ ] Domain pointed to hosting
- [ ] SSL certificate installed (Let's Encrypt or purchased)
- [ ] DNS propagated (can take 24-48 hours)

## ✅ Environment Configuration

- [ ] `.env` file created on server
- [ ] `APP_KEY` generated (`php artisan key:generate`)
- [ ] Database credentials configured
- [ ] `APP_URL` set to your domain
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] Mail settings configured

## ✅ File Permissions

- [ ] `storage/` directory writable (775)
- [ ] `bootstrap/cache/` directory writable (775)
- [ ] Correct ownership set

## ✅ Post-Deployment

- [ ] Database migrated (`php artisan migrate --force`)
- [ ] Caches cleared and optimized
- [ ] Test homepage loads
- [ ] Test login/register
- [ ] Test admin panel access
- [ ] Test course creation
- [ ] Test image uploads
- [ ] Test email functionality
- [ ] Check error logs

## 📝 Quick Deploy Commands

### On Server (via SSH):
```bash
cd ~/laravel/earn-with-nazo
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Emergency Rollback:
```bash
cd ~/laravel/earn-with-nazo
git reset --hard HEAD~1
composer install --optimize-autoloader --no-dev
php artisan config:cache
```

## 🆘 Emergency Contacts

- Hosting Support: [Your hosting support contact]
- Domain Registrar: [Your domain registrar]
- Developer: [Your contact]

---

**Last Updated:** December 13, 2025
