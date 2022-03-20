本作品網站目前主要以展現第三方API串接功能為主，購物車尚在開發中

下列第三方API功能已串接
GOOGLE reCAPTCHA
FB 粉絲頁、讚分享按鈕、留言區


購物車系統建置中

<h4>規劃</h4>

商店模組：
顯示商品清單 /shop
商品詳細頁->選擇數量並加入購物車 /shop/prod

商品模組：
商品清單頁 /commodities
商品詳細頁 /commodities/show
新增商品、修改商品

購物車模組：
顯示購物車內所有物品 /carts
增加商品數量、刪除購物車內商品
填寫資料、結帳並建立訂單

訂單模組：
顯示歷史訂單內容 /orders

todo：
-將商品加入購物車(many to many relationship) -> doing
-購物車列表 VIEW
-於購物車列表確認後填寫資料、付款建立訂單


<h4>環境</h4>

語言版本
laravel 8.x
mysql( 10.4.11-MariaDB )
PHP 7.4

部署環境
AWS EC2
ubuntu 20 LTS
docker (laradock)