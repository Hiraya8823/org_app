<header id="menu" class="page_header wrapper">
    <div class="left_content">
        <h1>
            <a href="/">
                <img src="/../images/Comfy_logo.webp" alt="comfyのロゴ" class="logo">
            </a>
        </h1>
        <div class="user_header">
            <?php if (!empty($current_user)) : ?>
                <p>
                    ようこそ、<?= $current_user['name'] ?>さん
                </p>
                <?php if ($current_user['admin'] == 1) : ?>
                    <a class="header_logout_button" href="/logout.php" class="nav-link">ログアウト</a>
                    <details>
                        <summary>News設定</summary>
                        <li><a class="header_logout_button" href="/admin/news/new.php" class="nav-link">news登録</a></li>
                        <li><a class="header_logout_button" href="/admin/news/news_list.php" class="nav-link">news変更</a></li>
                    </details>
                    <details>
                        <summary>Product</summary>
                        <li><a class="header_logout_button" href="/admin/product/new.php" class="nav-link">商品登録</a></li>
                        <li><a class="header_logout_button" href="" class="nav-link">商品変更</a></li>
                    </details>
                    
                <?php else : ?>
                    <a class="header_logout_button" href="/logout.php" class="nav-link">ログアウト</a>
                    <a href="/../edit.php" class="btn edit-btn">設定変更</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <nav class="menu_content">
        <ul class="menu_nav">
            <?php if (!empty($current_user) && $current_user['admin'] == 1) : ?>
                <li><a href="/admin/index.php">Top</a></li>
            <?php else : ?>
                <li><a href="/">Top</a></li>
            <?php endif; ?>
            <li><a href="/news.php">News</a></li>
            <li><a href="/items.php">Items</a></li>
            <li><a href="/index.php">About</a></li>
            <?php if (empty($current_user)) : ?>
                <li><a href="/../login.php"><i class="fa-sharp fa-solid fa-user"></i></a></li>
            <?php endif; ?>
            <li><a href="/../product_cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i></a></li>
        </ul>
    </nav>
</header>
