本作品網站目前主要以展現第三方API串接功能為主，購物車尚在開發中

<p>第三方API串接：</p>
<p>Google reCAPTCHA</p>
<p>Facebook 讚分享按鈕、粉絲專頁、內嵌留言</p>
<p>&nbsp;</p>
<p>文章頁面功能</p>
<ul>
<li>使用GATE方法過濾用戶是否為管理員</li>
<li>用戶編號為1視為管理員</li>
<li>具一般CRUD功能(僅管理員可以使用)</li>
<li>刪除功能為軟刪除，並在刪除時會記錄刪除時間</li>
<li>管理員可以看見已經刪除的文章、並有權限可以將其回復</li>
<li>建立或更新文章時，使用validate驗證提交的表單內容是否合法</li>
</ul>
<p>&nbsp;</p>


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
