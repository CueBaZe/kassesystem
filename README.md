# Database

> [!WARNING]
> **This project uses a loacal database so if you want to test the project, you need to make your own database**

To this project i used **phpmyadmin** to make my database. If you choose to use another database you probably have to change the code.

My database is called **Kasse**. I use 2 tabels 

**items:**
This is what the collums is called
```
barcode (int(10)) (Primary key) 
name (varchar(255))
price (decimal(10.2)
category (varchar(255))
picture (varchar(255))

```

**users:**
```
id (int(10)) (Primary key) (Auto increment)
name (varchar(255))
email(varchar(255))
password(varchar(255))
role(varchar(255))
```
>[!NOTE]
>If you use the same tabel names and same database name and you also use PHPmyadmin to make the database. The code should work without any problems.
