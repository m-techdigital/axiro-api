# AXIRO Company API

Laravel API nhận dữ liệu form tư vấn từ website company `axiro.vn`, lưu lead vào database và gửi email thông báo cho admin.

## API Contract

FE hiện gọi sẵn:

```txt
POST /api/v1/public/leads
```

Payload:

```json
{
  "full_name": "Nguyen Van A",
  "phone": "0901234567",
  "email": "a@example.com",
  "company_name": "AXIRO Demo",
  "job_title": "CEO",
  "company_size": "10-50",
  "interest": "Tư vấn triển khai AXIRO",
  "message": "Tôi muốn được tư vấn.",
  "consent": true,
  "lang": "vi",
  "page_url": "https://axiro.vn/#contact",
  "utm_source": "google",
  "utm_medium": "cpc",
  "utm_campaign": "launch"
}
```

`lang` nhận `vi` hoặc `en`. API cũng đọc header `X-Locale` và `Accept-Language`; giá trị trong body được ưu tiên. Response và validation message sẽ trả theo ngôn ngữ tương ứng.

Response thành công:

```json
{
  "message": "AXIRO đã nhận thông tin. Đội ngũ tư vấn sẽ liên hệ lại trong thời gian sớm nhất."
}
```

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve --host=127.0.0.1 --port=8000
```

Website FE local đang mặc định gọi:

```txt
http://127.0.0.1:8000/api/v1
```

## Mail

Local đang dùng:

```env
MAIL_MAILER=log
PUBLIC_LEAD_ADMIN_EMAIL=axiro.vn@gmail.com
```

Mail test sẽ ghi vào:

```txt
storage/logs/laravel.log
```

Production SMTP ví dụ:

```env
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-smtp-user
MAIL_PASSWORD=your-smtp-app-password
MAIL_FROM_ADDRESS=no-reply@axiro.vn
MAIL_FROM_NAME="AXIRO Website"
PUBLIC_LEAD_ADMIN_EMAIL=axiro.vn@gmail.com
```

## CORS

Cho phép mặc định:

```env
CORS_ALLOWED_ORIGINS=https://axiro.vn,https://www.axiro.vn,http://localhost:5173,http://localhost:5174,http://127.0.0.1:5173,http://127.0.0.1:5174
```

## Deploy Notes

- Chạy `php artisan migrate --force`.
- Chạy `php artisan config:cache`.
- Set `APP_ENV=production`, `APP_DEBUG=false`.
- Set `APP_URL` đúng domain API.
- FE chỉ cần set `VITE_API_URL=https://your-api-domain/api/v1`.
