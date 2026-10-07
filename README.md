# Đồ Án CMS Cuối Kỳ - WordPress Docker Setup

Dự án CMS chạy mã nguồn WordPress cục bộ bằng Docker & Docker Compose, tích hợp sẵn MariaDB và công cụ quản lý cơ sở dữ liệu trực quan phpMyAdmin.

---

## 1. Yêu cầu môi trường
- Đã cài đặt [Docker Desktop](https://www.docker.com/products/docker-desktop/) và đang bật.
- Hỗ trợ cả Windows (WSL2), macOS và Linux.

---

## 2. Cấu trúc thư mục
```text
Doan-CMS-CuoiKy/
├── .env                  # File cấu hình biến môi trường (port, database credentials)
├── .env.example          # File mẫu biến môi trường
├── docker-compose.yml    # File cấu hình các dịch vụ Docker (WordPress, MariaDB, phpMyAdmin)
├── docker/
│   └── uploads.ini       # Tối ưu cấu hình PHP (upload size 64MB, memory limit 256MB)
└── wordpress/            # Mã nguồn WordPress (gắn kết trực tiếp với container)
```

---

## 3. Hướng dẫn khởi chạy

### Bước 1: Khởi động các container
Mở Terminal / PowerShell tại thư mục dự án và chạy:
```bash
docker compose up -d
```
> Lần đầu chạy lệnh sẽ tải các image về máy nên có thể mất 1-3 phút tùy tốc độ mạng.

### Bước 2: Truy cập ứng dụng
Sau khi các container khởi động thành công:

| Dịch vụ | Địa chỉ truy cập | Ghi chú |
| :--- | :--- | :--- |
| **WordPress Web** | [http://wordpress.local](http://wordpress.local) | Website chính thức |
| **WordPress Admin** | [http://wordpress.local/wp-admin](http://wordpress.local/wp-admin) | Quản trị website |
| **phpMyAdmin** | [http://localhost:8081](http://localhost:8081) | Quản lý database trực quan |

---

## 4. Thông tin đăng nhập mặc định

### phpMyAdmin
- **Server:** `db`
- **Tài khoản Root:**
  - Username: `root`
  - Password: `root_secret_password`
- **Tài khoản WordPress thông thường:**
  - Username: `wp_user`
  - Password: `wp_user_password`
- **Database:** `cms-cuoiky`

### WordPress
Khi vào [http://wordpress.local](http://wordpress.local) lần đầu, WordPress sẽ hiển thị trình thiết lập:
1. Chọn ngôn ngữ (Tiếng Việt hoặc English).
2. Nhập thông tin quản trị viên (Tên trang, Tên đăng nhập Admin, Mật khẩu Admin, Email).
3. Nhấn **Cài đặt WordPress** để hoàn tất.

---

## 5. Các lệnh quản lý thường dùng

- **Dừng hệ thống:**
  ```bash
  docker compose down
  ```
- **Khởi động lại hệ thống:**
  ```bash
  docker compose restart
  ```
- **Xem trạng thái các container:**
  ```bash
  docker compose ps
  ```
- **Xem log kiểm tra lỗi (nếu có):**
  ```bash
  docker compose logs -f wordpress
  ```
- **Xóa toàn bộ dữ liệu database để cài lại từ đầu:**
  ```bash
  docker compose down -v
  ```
- **Export cơ sở dữ liệu ra file `database.sql`:**
  ```bash
  cmd /c "docker exec wordpress_db mariadb-dump -u wp_user -pwp_user_password cms-cuoiky > database.sql"
  ```
- **Import cơ sở dữ liệu từ file `database.sql`:**
  ```bash
  cmd /c "docker exec -i wordpress_db mariadb -u wp_user -pwp_user_password cms-cuoiky < database.sql"
  ```