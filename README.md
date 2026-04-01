# 📧 Laravel Send Mail API (Step-by-Step Guide)

---

## 🚀 Step 1: Configure Mail (.env)

```env
MAIL_MAILER=smtp
MAIL_HOST=mail.microtechcnc.com.sg
MAIL_PORT=465
MAIL_USERNAME=admin@microtechcnc.com.sg
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=admin@microtechcnc.com.sg
MAIL_FROM_NAME="${APP_NAME}"
```

---

## ⚙️ Step 2: Create Controller

```bash
php artisan make:controller API/SendMailController
```

---

## 📩 Step 3: Create Mail Class

```bash
php artisan make:mail ContactMail
```

---

## 🎨 Step 4: Create Email Blade File

```bash
mkdir -p resources/views/emails
touch resources/views/emails/contact.blade.php
```

---

## 🧩 Step 5: Add Route

📁 `routes/api.php`

```php
Route::prefix('v1')->group(function () {
    Route::post('send-mail', [SendMailController::class, 'send']);
});
```

---

## 🔄 Step 6: Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

---

## ▶️ Step 7: Run Project

```bash
php artisan serve
```

---

## 🧪 Step 8: Test API (Postman)

* Method: **POST**
* URL:

```
http://127.0.0.1:8000/api/v1/send-mail
```

* Body → JSON:

```json
{
  "name": "Test User",
  "email": "test@example.com",
  "mobile": "9876543210",
  "subject": "Test Mail",
  "message": "Hello from API"
}
```

---

## 🐞 Debug (Optional)

```env
MAIL_MAILER=log
```

Check logs:

```
storage/logs/laravel.log
```

---

## ✅ Done

Your Send Mail API setup is complete 🎉

---
