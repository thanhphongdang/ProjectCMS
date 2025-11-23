# HƯỚNG DẪN TEST TÍNH NĂNG ĐĂNG KÝ EMAIL SẢN PHẨM MỚI

## BƯỚC 1: Thêm Form Đăng Ký Vào Trang

### Cách 1: Dùng Shortcode (Dễ nhất)
1. Vào **WordPress Admin** → **Pages** → **Add New** (hoặc edit trang có sẵn)
2. Thêm shortcode này vào nội dung:
   ```
   [shopcar_email_subscription]
   ```
3. **Publish** hoặc **Update** trang
4. Vào trang đó trên frontend để xem form

### Cách 2: Thêm vào Footer (Tự động hiển thị mọi trang)
1. Vào **Appearance** → **Widgets** → **Footer**
2. Thêm widget **Shortcode** hoặc **Text**
3. Nhập: `[shopcar_email_subscription]`
4. **Save**

### Cách 3: Thêm vào Template (Nếu muốn code trực tiếp)
Mở file `footer.php` hoặc template muốn thêm, thêm:
```php
<?php echo do_shortcode('[shopcar_email_subscription]'); ?>
```

---

## BƯỚC 2: Test Đăng Ký Email

1. **Mở trang có form đăng ký** trên frontend
2. **Nhập email** (ví dụ: test@example.com)
3. **Click "Đăng ký"**
4. **Kiểm tra thông báo**:
   - ✅ Thành công: "Đăng ký thành công! Bạn sẽ nhận được thông báo khi có sản phẩm mới."
   - ❌ Lỗi: "Email này đã được đăng ký rồi." (nếu đăng ký lại)

---

## BƯỚC 3: Kiểm Tra Trong Admin

1. Vào **WordPress Admin** → **Email Đăng ký** → **Quản lý Email**
2. **Kiểm tra**:
   - Email vừa đăng ký có trong danh sách không?
   - Trạng thái là "✓ Đang hoạt động" không?
   - Ngày đăng ký hiển thị đúng không?

---

## BƯỚC 4: Test Gửi Email Khi Có Sản Phẩm Mới

### Tạo sản phẩm mới:
1. Vào **Products** → **Add New**
2. **Nhập thông tin sản phẩm**:
   - Tên sản phẩm: "Test Product"
   - Giá: 100000
   - Thêm hình ảnh (nếu có)
   - **Publish** sản phẩm

### Kiểm tra email:
1. **Kiểm tra hộp thư** của email đã đăng ký
2. **Email sẽ chứa**:
   - Tên sản phẩm
   - Giá sản phẩm
   - Hình ảnh sản phẩm (nếu có)
   - Link xem chi tiết
   - Link hủy đăng ký

### Lưu ý:
- Email chỉ gửi **1 lần** cho mỗi sản phẩm
- Chỉ gửi cho email có trạng thái **"Đang hoạt động"**
- Nếu không nhận được email, kiểm tra:
  - WordPress email có hoạt động không? (Settings → General)
  - Có thể cần cài plugin SMTP (như WP Mail SMTP)

---

## BƯỚC 5: Test Hủy Đăng Ký

### Cách 1: Từ Admin
1. Vào **Email Đăng ký** → **Quản lý Email**
2. Click **"Hủy đăng ký"** bên cạnh email
3. Xác nhận
4. Kiểm tra trạng thái đổi thành "✗ Đã hủy"

### Cách 2: Từ Link Trong Email
1. Mở email thông báo sản phẩm mới
2. Click link **"Hủy đăng ký"** ở cuối email
3. Sẽ chuyển đến trang xác nhận hủy đăng ký
4. Kiểm tra trong Admin xem trạng thái đã đổi chưa

---

## BƯỚC 6: Test Kích Hoạt Lại

1. Vào **Email Đăng ký** → **Quản lý Email**
2. Tìm email có trạng thái "✗ Đã hủy"
3. Click **"Kích hoạt lại"**
4. Kiểm tra trạng thái đổi thành "✓ Đang hoạt động"

---

## KIỂM TRA LỖI (Nếu có vấn đề)

### Form không hiển thị:
- Kiểm tra shortcode đã đúng: `[shopcar_email_subscription]`
- Kiểm tra jQuery đã được load chưa (F12 → Console)

### Đăng ký không hoạt động:
- Mở **F12** → **Console** xem có lỗi JavaScript không
- Kiểm tra **Network** tab xem AJAX request có thành công không
- Kiểm tra nonce có đúng không

### Email không gửi được:
- Kiểm tra WordPress email settings
- Cài plugin **WP Mail SMTP** để gửi email qua SMTP
- Kiểm tra spam folder
- Test với email thật (Gmail, Outlook...)

### Sản phẩm mới không gửi email:
- Kiểm tra sản phẩm đã được **Publish** chưa (không phải Draft)
- Kiểm tra trong **Products** → chọn sản phẩm → xem meta `_new_product_notified` có = '1' không
- Kiểm tra có email nào đang active không

---

## TEST NHANH (Tóm tắt)

1. ✅ Thêm `[shopcar_email_subscription]` vào trang
2. ✅ Đăng ký email test
3. ✅ Kiểm tra trong Admin → Email Đăng ký
4. ✅ Tạo sản phẩm mới và Publish
5. ✅ Kiểm tra email đã nhận được
6. ✅ Test hủy đăng ký
7. ✅ Test kích hoạt lại

---

## LƯU Ý QUAN TRỌNG

⚠️ **Email Localhost (XAMPP)**: 
- WordPress mặc định không gửi được email trên localhost
- Cần cài plugin **WP Mail SMTP** hoặc dùng service như Mailtrap, SendGrid
- Hoặc test trên server thật

⚠️ **Email chỉ gửi 1 lần**:
- Mỗi sản phẩm chỉ gửi email 1 lần khi publish lần đầu
- Nếu update sản phẩm, không gửi lại email
- Muốn test lại, xóa meta `_new_product_notified` của sản phẩm



