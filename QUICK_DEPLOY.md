# 📦 Quick Deployment Reference

## 🎯 Option 1: Build on Server (Recommended)

**Pros:** Smaller repository, more secure
**Cons:** Requires Node.js on server

### Steps:
1. Keep `/public/build` in `.gitignore`
2. On server after deployment:
```bash
npm install
npm run build
```

---

## 🎯 Option 2: Commit Build Files

**Pros:** No build step on server
**Cons:** Larger repository, more commits

### Steps:
1. Remove `/public/build` from `.gitignore`
2. Run `npm run build` locally
3. Commit build files
4. Push to repository

### To enable this option:
```bash
# Remove /public/build from .gitignore
sed -i '' '/\/public\/build/d' .gitignore

# Build assets
npm run build

# Commit
git add public/build
git commit -m "Add production build files"
```

---

## 🚀 Current Setup

Your app is configured for **Option 1** (build on server).

If your hosting doesn't support Node.js, use **Option 2**.

---

## 📋 Quick Commands

### Commit Current Changes:
```bash
git add .
git commit -m "Prepare for production deployment"
git push origin main
```

### Check Remote:
```bash
git remote -v
```

### Add Remote (if needed):
```bash
git remote add origin https://github.com/yourusername/earn-with-nazo.git
```

### Push to New Remote:
```bash
git push -u origin main
```

---

## 🔗 Next Steps

1. ✅ Review `DEPLOYMENT_CHECKLIST.md`
2. ✅ Follow `DEPLOYMENT_GUIDE.md`
3. ✅ Commit and push changes
4. ✅ Set up Git in cPanel
5. ✅ Configure `.env` on server
6. ✅ Deploy!

---

**Need Help?** Check the full guides:
- `DEPLOYMENT_GUIDE.md` - Complete deployment instructions
- `DEPLOYMENT_CHECKLIST.md` - Pre-deployment checklist
