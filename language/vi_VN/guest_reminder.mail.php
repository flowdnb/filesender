<?php 
// WARNING, this is a read only file created by import scripts
// WARNING
// WARNING,  Changes made to this file will be clobbered
// WARNING
// WARNING,  Please make changes on poeditor instead of here
// 
// 
?>
chủ đề: (nhắc nhở) nhận được voucher của khách
chủ đề: (nhắc nhở) {guest.subject}

{thay thế:đồng bằng}

Thưa ông hoặc bà,

Đây là lời nhắc nhở, vui lòng tìm thấy bên dưới phiếu thưởng cấp quyền truy cập vào {cfg:site_name}. Bạn có thể sử dụng phiếu thưởng này để tải lên một bộ tệp và cung cấp tệp đó để tải xuống cho một nhóm người.

Tổ chức phát hành: {guest.user_email}
Liên kết phiếu thưởng: {guest.upload_link}

Phiếu thưởng có sẵn cho đến {date:guest.expires} sau thời gian đó, phiếu thưởng sẽ tự động bị xóa.

{if:guest.message}Tin nhắn cá nhân từ {guest.user_email}: {guest.message}{endif}

Trân trọng,
{cfg:site_name}

{thay thế:html}

<p>
     Thưa ông hoặc bà,
</p>

<p>
     Đây là lời nhắc, vui lòng tìm thấy bên dưới phiếu thưởng cấp quyền truy cập vào <a href="{cfg:site_url}">{cfg:site_name}</a>. Bạn có thể sử dụng phiếu thưởng này để tải lên một bộ tệp và cung cấp tệp đó để tải xuống cho một nhóm người.
</p>

<quy tắc bảng="hàng">
     <thead>
         <tr>
             <th colspan="2">Chi tiết phiếu thưởng</th>
         </tr>
     </thead>
     <tbody>
         <tr>
             <td>Nhà phát hành</td>
             <td><a href="mailto:{guest.user_email}">{guest.user_email}</a></td>
         </tr>
         <tr>
             <td>Liên kết phiếu thưởng</td>
             <td><a href="{guest.upload_link}">{guest.upload_link}</a></td>
         </tr>
         <tr>
             <td>Có hiệu lực đến</td>
             <td>{date:guest.expires}</td>
         </tr>
     </tbody>
</bảng>

{if:guest.message}
<p>
     Tin nhắn cá nhân từ {guest.user_email}:
</p>
<p class="message">
     {khách.tin nhắn}
</p>
{endif}

<p>
     Trân trọng,<br />
     {cfg:site_name}
</p>