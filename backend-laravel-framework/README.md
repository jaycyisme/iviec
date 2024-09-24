## Hướng dẫn
1. Đổi tên .env.backup thành .env
2. Thay đổi thông tin MySQL trong .env
3. Chạy `composer update`
4. Chạy `php artisan migrate`
5. Chạy `php artisan db:seed PermissionTableSeeder`
6. Chạy `php artisan serve`
7. Vào trang `http://localhost:8000/dang-ky.html` để tạo tài khoản
8. Chạy `php artisan db:seed PermissionTableAssign`
9. Bắt đầu!
