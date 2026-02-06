# Changelog

Tất cả các thay đổi quan trọng của dự án **Nencer Agent Hub** sẽ được ghi lại tại đây.

Định dạng dựa trên [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
và dự án tuân thủ [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

**Added:**

- Tính năng đánh giá và review skills
- Thống kê lượt download

---

## [1.0.0] - 2026-02-06

**Added:**

- 🔐 **Authentication**: Đăng nhập qua GitHub OAuth
- 📦 **Skills Management**: Upload, xem, xóa skills
- 🔍 **Search & Filter**: Tìm kiếm và lọc theo category
- 📱 **Responsive UI**: Hỗ trợ Desktop, Tablet, Mobile
- 🌙 **Dark Mode**: Toggle giữa Light/Dark theme
- 📝 **Markdown Support**: Render markdown trong mô tả skill
- 📄 **Pagination**: Phân trang 6 items/page
- 🔔 **Toast Notifications**: Thông báo SweetAlert2
- ⚡ **Supabase Integration**: Backend realtime

**Changed:**

- Cập nhật giao diện theo design tokens mới
- Tối ưu skeleton loading animation

**Fixed:**

- Sửa lỗi RLS policy cho skills table
- Sửa lỗi user_id khi upload skill

---

## [0.1.0] - 2026-01-15

**Added:**

- Khởi tạo dự án
- Cấu trúc thư mục cơ bản
- Trang index.php ban đầu

---

## Types of Changes

| Tag | Mô tả |
| --- | --- |
| `Added` | Tính năng mới |
| `Changed` | Thay đổi tính năng hiện có |
| `Deprecated` | Tính năng sẽ bị loại bỏ |
| `Removed` | Tính năng đã bị loại bỏ |
| `Fixed` | Sửa lỗi |
| `Security` | Cập nhật bảo mật |
