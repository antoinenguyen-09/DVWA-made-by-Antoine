# Usage

### 1. Yêu cầu: tải về [Ubuntu 20.04.5 LTS](https://releases.ubuntu.com/focal/ubuntu-20.04.5-desktop-amd64.iso). Trong Ubuntu 20.04.5 LTS thường đã có đủ LAMP (Linux, Apache 2, MySQL 8.0.32 và PHP 7.4), nếu thiếu thì search google sudo apt install <cái gì đó muốn tải rồi copy lệnh vào mà tải về>.

![image](https://user-images.githubusercontent.com/61876488/220865105-4d47cc2a-3a3a-4ff6-abf1-920e0a277660.png)

### 2. Bật dịch vụ MySQL bằng lệnh: `service mysql start` (nếu đang chạy mà gặp vấn đề thì `service mysql restart`). Tại đường dẫn `DVWA-made-by-Antoine/` vào MySQL Shell bằng lệnh `sudo mysql -u root -p` sau đó nhập mật khẩu ubuntu ở ô `[sudo] password for xxx`. Chỗ `Enter password: ` với các bạn mới cài mysql thì mặc định root chưa có mật khẩu nên cứ ấn Enter (ONLY ENTER). Sau đó `source <script>.sql` trên MySQL shell.

![image](https://user-images.githubusercontent.com/61876488/220865549-dd653d94-ffca-4aa0-8924-8acf8bf9eb45.png)


### 3. Vào folder challenge, ví dụ: `cd cmdsqli/` sau đó gõ `php -S 0.0.0.0:5000` để chạy. Truy cập web tại `http://<địa chỉ IP của máy đang chạy PHP>:5000`.

![image](https://user-images.githubusercontent.com/61876488/220871921-cefc15be-6a20-4691-8a11-546489e5fda6.png)

![image](https://user-images.githubusercontent.com/61876488/220872003-29552138-b517-46cc-b4ee-4d6435789479.png)
