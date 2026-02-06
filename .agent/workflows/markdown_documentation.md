---
description: Quy tắc và hướng dẫn tạo tài liệu Markdown chuẩn
---

# Markdown Documentation Guidelines

Hướng dẫn tạo tài liệu Markdown tuân thủ chuẩn markdownlint.

## Cấu trúc README chuẩn

1. **Tiêu đề & Badges** - Tên dự án và các badge status
2. **Tổng quan** - Giới thiệu ngắn gọn về dự án
3. **Mục tiêu** - Mục tiêu chính và kỹ thuật
4. **Features** - Tính năng hiện có và dự kiến
5. **Cấu trúc dự án** - Tree diagram
6. **Cài đặt** - Hướng dẫn cài đặt
7. **Đóng góp** - Quy trình contribute
8. **License** - Thông tin giấy phép

## Quy tắc Markdown Lint

### MD060 - Table Column Style

❌ **Sai:**

```markdown
| Header 1 | Header 2 |
|----------|---------|
| Cell 1   | Cell 2 |
```

✅ **Đúng (unaligned style):**

```markdown
| Header 1 | Header 2 |
| --- | --- |
| Cell 1 | Cell 2 |
```

### MD034 - No Bare URLs

❌ **Sai:**

```markdown
- Email: contact@example.com
```

✅ **Đúng:**

```markdown
- Email: [contact@example.com](mailto:contact@example.com)
```

### MD033 - No Inline HTML

❌ **Sai:**

```markdown
<p align="center">
  <strong>Text</strong>
</p>
```

✅ **Đúng:**

```markdown
**Text**
```

### MD012 - No Multiple Blank Lines

❌ **Sai:**

```markdown
Line 1


Line 2
```

✅ **Đúng:**

```markdown
Line 1

Line 2
```

### MD047 - Single Trailing Newline

- File phải kết thúc bằng **đúng 1 dòng trống**
- Không được có nhiều dòng trống cuối file

### MD024 - No Duplicate Headings

Không được có các headings trùng tên trong cùng một file.

❌ **Sai:**

```markdown
## [1.0.0]

### Added

- Feature A

## [0.1.0]

### Added

- Feature B
```

✅ **Đúng (dùng bold thay heading):**

```markdown
## [1.0.0]

**Added:**

- Feature A

## [0.1.0]

**Added:**

- Feature B
```

> **Lưu ý:** Changelog thường có các section trùng tên như `Added`, `Changed`, `Fixed`.
> Sử dụng **bold text** thay vì heading để tránh lỗi MD024.

## Code Blocks

Luôn chỉ định ngôn ngữ cho code blocks:

```bash
git clone <repo-url>
```

```javascript
const foo = 'bar';
```

```text
plain/
├── folder/
└── file.txt
```

## Checklist Features

```markdown
### Tính năng hiện có

- [x] Feature hoàn thành
- [ ] Feature chưa làm
```

## Horizontal Rules

Sử dụng `---` để phân cách các section lớn:

```markdown
## Section 1

Content...

---

## Section 2
```

## Tips

1. Luôn có **blank line** trước và sau:
   - Headers
   - Code blocks
   - Lists
   - Tables

2. Sử dụng **backticks** cho:
   - Tên file: `package.json`
   - Tên function: `handleClick()`
   - Commands: `npm install`

3. Sử dụng **bold** cho emphasis quan trọng: **Lưu ý**

4. Sử dụng emoji để tăng tính trực quan: ✅ ❌ 🔐 📦

## Kiểm tra Lint

Chạy markdownlint để kiểm tra file:

```bash
npx markdownlint README.md
```
