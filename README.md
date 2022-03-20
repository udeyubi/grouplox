本作品網站目前主要以展現第三方API串接功能為主，購物車尚在開發中

<p>下列第三方API功能已串接</p>
<p>GOOGLE reCAPTCHA</p>
<p>FB 粉絲頁、讚分享按鈕、留言區</p>


<p>購物車系統建置中</p>

<h4>規劃</h4>

<p>商店模組：</p>
<p>顯示商品清單 /shop</p>
<p>商品詳細頁->選擇數量並加入購物車 /shop/prod</p>

<p>商品模組：</p>
<p>商品清單頁 /commodities</p>
<p>商品詳細頁 /commodities/show</p>
<p>新增商品、修改商品</p>
<br>
<p>購物車模組：</p>
<p>顯示購物車內所有物品 /carts</p>
<p>增加商品數量、刪除購物車內商品</p>
<p>填寫資料、結帳並建立訂單</p>
<br>
<p>訂單模組：</p>
<p>顯示歷史訂單內容 /orders</p>
<br>
<p>todo：</p>
<p>-將商品加入購物車(many to many relationship) -> doing</p>
<p>-購物車列表 VIEW</p>
<p>-於購物車列表確認後填寫資料、付款建立訂單</p>


<h4>環境</h4>

<p>語言版本</p>
<p>laravel 8.x</p>
<p>mysql( 10.4.11-MariaDB )</p>
<p>PHP 7.4</p>
<br>
<p>部署環境</p>
<p>AWS EC2</p>
<p>ubuntu 20 LTS</p>
<p>docker (laradock)</p>
