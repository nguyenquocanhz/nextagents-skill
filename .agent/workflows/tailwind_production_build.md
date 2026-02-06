---
description: Quy trình phân tích và biên dịch Tailwind CSS cho production
---

# Tailwind CSS Production Build Guide

Hướng dẫn chuyển đổi từ Tailwind CDN sang production build với PostCSS.

## File Extensions Hỗ Trợ

Tailwind có thể scan classes từ các loại file sau:

| Extension | Mô tả |
| --- | --- |
| `.html` | HTML thuần |
| `.php` | PHP templates |
| `.js` | JavaScript files |
| `.jsx` | React JSX |
| `.ts` | TypeScript |
| `.tsx` | TypeScript + JSX |
| `.vue` | Vue Single File Components |
| `.svelte` | Svelte components |
| `.astro` | Astro components |
| `.twig` | Twig templates |
| `.blade.php` | Laravel Blade |
| `.ejs` | EJS templates |
| `.hbs` | Handlebars templates |
| `.pug` | Pug templates |
| `.md` | Markdown files |
| `.mdx` | MDX files |

### Content Paths Examples

```javascript
// tailwind.config.js
module.exports = {
  content: [
    // HTML
    './*.html',
    './src/**/*.html',
    
    // PHP
    './*.php',
    './views/**/*.php',
    './templates/**/*.blade.php',
    
    // JavaScript/TypeScript
    './src/**/*.{js,jsx,ts,tsx}',
    './assets/js/**/*.js',
    
    // Vue/React/Svelte
    './src/**/*.vue',
    './components/**/*.{jsx,tsx}',
    './src/**/*.svelte',
    
    // Node modules (nếu dùng UI library)
    './node_modules/@package/**/*.js',
  ],
  // ...
}
```

---

Trước khi build, cần trích xuất thông tin từ file nguồn:

### 1.1 Trích xuất Tailwind Config

Tìm block `tailwind.config` trong file:

```javascript
tailwind.config = {
    darkMode: 'class',
    theme: {
        extend: {
            colors: { ... },
            fontFamily: { ... },
            fontSize: { ... },
            spacing: { ... },
            borderRadius: { ... },
            boxShadow: { ... },
            animation: { ... }
        }
    }
}
```

### 1.2 Tìm Arbitrary Values (JIT)

Các giá trị inline cần safelist:

- `bg-[#hexcode]`
- `text-[size]`
- `min-h-[value]`
- `max-h-[value]`
- `w-[value]`

### 1.3 Liệt kê Custom CSS Classes

Tìm trong `<style>` tag các class không phải Tailwind:

- `.custom-class`
- `.component-name`
- Pseudo selectors (`:hover`, `::before`)

---

## Bước 2: Khởi tạo Project

```bash
# Khởi tạo package.json
npm init -y

# Cài đặt dependencies
npm install -D tailwindcss postcss autoprefixer

# Tạo config files
npx tailwindcss init -p
```

---

## Bước 3: Cấu hình tailwind.config.js

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './*.html',
    './assets/js/**/*.js',
  ],
  darkMode: 'class',
  safelist: [
    // Thêm arbitrary values ở đây
    'bg-[#hexcode]',
    'min-h-[400px]',
  ],
  theme: {
    extend: {
      // Copy từ bước phân tích
      colors: { ... },
      fontFamily: { ... },
      // ...
    }
  },
  plugins: [],
}
```

---

## Bước 4: Tạo Source CSS

Tạo file `assets/css/input.css`:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Custom CSS từ bước phân tích */
.custom-class {
    /* styles */
}

/* Dark mode variants */
.dark .custom-class {
    /* dark styles */
}
```

---

## Bước 5: Build Commands

### Development (Watch Mode)

```bash
npx tailwindcss -i ./assets/css/input.css -o ./assets/css/style.css --watch
```

### Production (Minified)

```bash
npx tailwindcss -i ./assets/css/input.css -o ./assets/css/style.css --minify
```

---

## Bước 6: Cập nhật HTML/PHP

### Xóa CDN

```html
<!-- XÓA DÒNG NÀY -->
<script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config = { ... }</script>
```

### Thêm CSS Local

```html
<!-- THÊM DÒNG NÀY -->
<link rel="stylesheet" href="assets/css/style.css">
```

---

## Cấu trúc Assets

```text
assets/
├── css/
│   ├── input.css      # Source (Tailwind directives + custom)
│   └── style.css      # Output (compiled, minified)
├── js/
│   └── app.js         # Application JavaScript
└── lib/
    └── utils.js       # Custom utilities
```

---

## Checklist Verification

- [ ] Tất cả custom colors hiển thị đúng
- [ ] Dark mode hoạt động
- [ ] Responsive breakpoints đúng
- [ ] Arbitrary values render đúng
- [ ] Custom CSS classes hoạt động
- [ ] Animations/transitions smooth
- [ ] File size production < CDN

---

## Troubleshooting

### Class bị thiếu

1. Kiểm tra `content` paths trong config
2. Thêm vào `safelist` nếu là dynamic class
3. Chạy lại build command

### Dark mode không hoạt động

1. Kiểm tra `darkMode: 'class'` trong config
2. Verify `<html class="dark">` toggle đúng

### Arbitrary values không render

1. Thêm vào `safelist` array
2. Escape special characters nếu cần
