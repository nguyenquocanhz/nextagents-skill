---
description: Hướng dẫn sử dụng Git cho dự án NextAgents Skill
---

# Git Workflow

Hướng dẫn quản lý source code với Git và GitHub.

## Repository

- **URL:** https://github.com/nguyenquocanhz/nextagents-skill.git
- **Branch chính:** main

---

## Tạo Repository Mới

```bash
# Khởi tạo Git
git init

# Thêm README
echo "# nextagents-skill" >> README.md

# Stage và commit
git add README.md
git commit -m "first commit"

# Đổi tên branch thành main
git branch -M main

# Thêm remote origin
git remote add origin https://github.com/nguyenquocanhz/nextagents-skill.git

# Push lên GitHub
git push -u origin main
```

---

## Push Repository Đã Có

```bash
# Thêm remote origin
git remote add origin https://github.com/nguyenquocanhz/nextagents-skill.git

# Đổi tên branch thành main
git branch -M main

# Push lên GitHub
git push -u origin main
```

---

## Workflow Hàng Ngày

### 1. Pull Trước Khi Làm Việc

```bash
git pull origin main
```

### 2. Kiểm Tra Thay Đổi

```bash
git status
git diff
```

### 3. Stage Files

```bash
# Stage tất cả
git add .

# Stage file cụ thể
git add index.php
git add assets/css/style.css
```

### 4. Commit

```bash
# Commit với message
git commit -m "feat: add download skill feature"

# Commit types:
# - feat: tính năng mới
# - fix: sửa lỗi
# - docs: cập nhật docs
# - style: format code
# - refactor: tái cấu trúc
# - chore: cập nhật build tools
```

### 5. Push

```bash
git push origin main
```

---

## Các Lệnh Hữu Ích

| Lệnh | Mô tả |
| --- | --- |
| `git log --oneline -10` | Xem 10 commits gần nhất |
| `git stash` | Lưu thay đổi tạm thời |
| `git stash pop` | Khôi phục thay đổi |
| `git checkout -- .` | Hủy tất cả thay đổi chưa stage |
| `git reset HEAD~1` | Undo commit gần nhất |
| `git branch -a` | Xem tất cả branches |

---

## .gitignore Khuyến Nghị

```gitignore
# Dependencies
node_modules/

# Build output
assets/css/style.css

# IDE
.vscode/
.idea/

# OS
.DS_Store
Thumbs.db

# Logs
*.log
npm-debug.log*

# Environment
.env
.env.local
```

---

## Turbo Commands

// turbo-all

Các lệnh trong workflow này có thể auto-run.
