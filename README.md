# 🐺 LoupWakil (لو واكيل)

**LoupWakil** is a premium, open-source role shuffler for the classic "Werewolf" (Loup Garou) party game. Built with **Laravel 12**, **NativePHP**, and **Alpine.js**, it features a stunning gothic-modern aesthetic localized entirely in Arabic.

![LoupWakil UI](https://img.shields.io/badge/UI-Glassmorphism-red)
![Framework](https://img.shields.io/badge/Framework-Laravel%2012-orange)
![Tech](https://img.shields.io/badge/Frontend-Tailwind%204.0%20%2B%20Alpine.js-blue)

## ✨ Features

- 🌍 **Full Arabic Localization**: Designed specifically for Arabic-speaking game nights with RTL support.
- 🎨 **Cairo Typography**: Uses the elegant Cairo font for a premium, state-of-the-art look.
- 🎭 **Comprehensive Roles**: Includes all classic roles (Wolf, Seer, Witch, Hunter, Healer, Cupid, Thief, Wild Child, and White Wolf).
- 🎲 **Smart Randomizer**: Ensures fair distribution of roles. The "Ritual Shuffling" logic enforces matching role counts and player counts.
- 🕵️ **Secret Reveal System**: Modern card-tapping interface for players to privately view their destinies.
- 📱 **Native Ready**: Powered by **NativePHP Mobile**, ready to be bundled as an Android APK.

## 🚀 Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite (default)

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/LWEK009/loupwakilouuu.git
   cd loupwakilouuu
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   touch database/database.sqlite
   php artisan migrate --seed
   ```

4. **Run the application:**
   ```bash
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000` to start your game.

## 📱 Running as a Mobile App (linux)

To run LoupWakil as a native Android application on your emulator/device:

```bash
php artisan native:run android
```

## 🛠️ Built With

- **Backend**: [Laravel 12](https://laravel.com)
- **Mobile Engine**: [NativePHP Mobile](https://nativephp.com)
- **Styling**: [Tailwind CSS 4.0](https://tailwindcss.com)
- **Logic**: [Alpine.js](https://alpinejs.dev)
- **Database**: SQLite

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---
Created with ❤️ by Antigravity for the Werewolf community.
