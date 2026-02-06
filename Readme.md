# Nencer Agent Hub

![Status](https://img.shields.io/badge/status-active-success.svg)
![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4.svg?logo=php&logoColor=white)
![Supabase](https://img.shields.io/badge/Supabase-Backend-3ECF8E.svg?logo=supabase&logoColor=white)

## Tổng Quan

**Nencer Agent Hub** là nền tảng chia sẻ và quản lý **Workflow Agent Skills** - các bộ kỹ năng AI được đóng gói sẵn sàng để sử dụng. Nền tảng cho phép cộng đồng người dùng tải lên, tìm kiếm và sử dụng các workflow phục vụ nhiều mục đích khác nhau như Marketing, Coding, Data Analysis, HR, Support và Design.

### Công nghệ sử dụng

| Công nghệ | Mô tả |
| --- | --- |
| **PHP** | Ngôn ngữ backend chính |
| **Supabase** | Backend-as-a-Service (Database, Auth, Storage) |
| **Tailwind CSS** | Framework CSS utility-first |
| **JavaScript** | Logic phía client |
| **Marked.js** | Parser Markdown |
| **SweetAlert2** | Thư viện thông báo đẹp mắt |

---

## Mục Tiêu

### 🎯 Mục tiêu chính

- **Chia sẻ cộng đồng**: Tạo nền tảng để cộng đồng AI/Automation chia sẻ các workflow skills
- **Dễ dàng sử dụng**: Cung cấp giao diện trực quan để tìm kiếm và cài đặt skills
- **Quản lý hiệu quả**: Cho phép người dùng quản lý các skills đã tạo

### 🚀 Mục tiêu kỹ thuật

- Xây dựng hệ thống authentication thông qua GitHub OAuth
- Tích hợp Supabase để lưu trữ và truy vấn dữ liệu realtime
- Giao diện responsive, hỗ trợ Dark Mode
- Hỗ trợ Markdown trong mô tả workflow

---

## Features

### ✅ Tính năng hiện có

- [x] **🔐 Xác thực người dùng**
  - Đăng nhập qua GitHub OAuth
  - Chế độ Mock Login cho testing
  - Quản lý session người dùng

- [x] **📦 Quản lý Skills**
  - Upload skill mới với title, mô tả, category
  - Xem danh sách "My Skills" đã upload
  - Xóa skills của mình

- [x] **🔍 Tìm kiếm & Lọc**
  - Tìm kiếm theo tên skill
  - Lọc theo category (Marketing, Coding, Data Analysis, ...)
  - Sắp xếp theo thời gian / độ phổ biến

- [x] **📱 Giao diện người dùng**
  - Responsive design (Desktop, Tablet, Mobile)
  - Dark Mode / Light Mode toggle
  - Skeleton loading animation
  - Toast notifications

- [x] **📝 Hỗ trợ Markdown**
  - Render Markdown trong mô tả skill
  - Syntax highlighting cho code blocks

- [x] **📄 Phân trang**
  - Hiển thị 6 items mỗi trang
  - Navigation pagination

### 🔮 Tính năng dự kiến

- [ ] Đánh giá và review skills
- [ ] Thống kê lượt download
- [ ] Tích hợp cài đặt skill qua CLI
- [ ] Export/Import skills

---

## Cấu Trúc Dự Án

```text
shopee.local/
├── index.php          # Trang chính (SPA)
├── Readme.md          # Tài liệu dự án
├── css/               # Stylesheets
├── js/                # JavaScript files
└── old/               # Backup files
```

---

## Cài Đặt

### Yêu cầu hệ thống

- XAMPP / PHP 8.0+
- Trình duyệt hiện đại (Chrome, Firefox, Edge)
- Tài khoản Supabase (tùy chọn)

### Các bước cài đặt

1. **Clone repository**

   ```bash
   git clone <repository-url>
   cd shopee.local
   ```

2. **Di chuyển vào thư mục XAMPP**

   ```bash
   # Copy vào thư mục htdocs của XAMPP
   cp -r . C:/xampp/htdocs/shopee.local
   ```

3. **Cấu hình Supabase** (tùy chọn)

   Mở file `index.php` và cập nhật thông tin Supabase:

   ```javascript
   const SUPABASE_URL = 'your-supabase-url';
   const SUPABASE_KEY = 'your-anon-key';
   ```

4. **Khởi động XAMPP**

   - Start Apache
   - Truy cập: `http://localhost/shopee.local`

---

## Đóng Góp

Chúng tôi luôn chào đón mọi đóng góp từ cộng đồng! Dưới đây là hướng dẫn để bạn có thể đóng góp vào dự án:

### 📋 Quy trình đóng góp

1. **Fork repository**

   ```bash
   # Fork repo về tài khoản của bạn trên GitHub
   ```

2. **Tạo branch mới**

   ```bash
   git checkout -b feature/ten-tinh-nang
   ```

3. **Commit changes**

   ```bash
   git add .
   git commit -m "feat: mô tả ngắn gọn thay đổi"
   ```

4. **Push và tạo Pull Request**

   ```bash
   git push origin feature/ten-tinh-nang
   ```

### 📝 Quy ước commit message

| Prefix        | Mô tả                |
|---------------|----------------------|
| `feat:`       | Thêm tính năng mới   |
| `fix:`        | Sửa lỗi              |
| `docs:`       | Cập nhật tài liệu    |
| `style:`      | Thay đổi CSS/UI      |
| `refactor:`   | Tái cấu trúc code    |
| `test:`       | Thêm tests           |

### 🐛 Báo cáo lỗi

Nếu bạn phát hiện lỗi, vui lòng tạo Issue với các thông tin:

- **Mô tả lỗi**: Chi tiết về lỗi gặp phải
- **Các bước tái hiện**: Làm sao để tái hiện lỗi
- **Kết quả mong đợi**: Điều bạn mong đợi xảy ra
- **Screenshots**: Ảnh chụp màn hình (nếu có)
- **Môi trường**: Trình duyệt, hệ điều hành

### 💡 Đề xuất tính năng

Bạn có ý tưởng hay? Hãy tạo Issue với label `enhancement` và mô tả:

- Vấn đề bạn muốn giải quyết
- Giải pháp đề xuất
- Các alternatives đã cân nhắc

---

## Liên Hệ

- **Website**: [Nencer Agent Hub](http://localhost/shopee.local)
- **Email**: [contact@nencer.dev](mailto:contact@nencer.dev)
- **GitHub**: [NencerAgentHub](https://github.com/nencer)

---

## License

Dự án được phân phối dưới giấy phép **MIT License**. Xem file `LICENSE` để biết thêm chi tiết.

---

**© 2026 Nencer Agent Hub** - Powered by Supabase ⚡
