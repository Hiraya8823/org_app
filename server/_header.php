<header id="menu" class="page_header wrapper">
    <div class="left_content">
        <h1>
            <a href="toppage.php">
                <img src="../images/Comfy ロゴ 片貫 .webp" alt="comfyのロゴ" class="logo">
            </a>
        </h1>
        <?php if (!empty($current_user)) : ?>
            <p>
                ようこそ、<?= $current_user['name'] ?>さん
            </p>
            <a class="header_logout_button" href="logout.php" class="nav-link">ログアウト</a>
        <?php endif; ?>
    </div>
    <nav class="menu_content">
        <ul class="menu_nav">
            <li><a href="toppage.php">Top</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="items.php">Items</a></li>
            <li><a href="toppage.php">About</a></li>
            <?php if (empty($current_user)) : ?>
                <li><a href="login.php"><i class="fa-sharp fa-solid fa-user"></i></a></li>
            <?php endif; ?>
            <li><a href="product_cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i></a></li>
        </ul>
    </nav>
</header>
