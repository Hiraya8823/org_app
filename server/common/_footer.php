<footer id="footer" class="page_footer wrapper">
    <div class="footer_flex">
        <h1>
            <a href="/" class="logo_link">
                <img class="logo" alt="Comfyのロゴ" src="/../images/Comfy_logo.webp">
            </a>
        </h1>
        <nav>
            <ul class="menu_nav footer_menu_nav">
                <?php if (!empty($current_user) && $current_user['admin'] == 1) : ?>
                    <li><a href="/admin/index.php">Top</a></li>
                <?php else : ?>
                    <li><a href="/">Top</a></li>
                <?php endif; ?>
                <li><a href="/news.php">News</a></li>
                <li><a href="/items.php">Items</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">プライバシーポリシー</a></li>
            </ul>
        </nav>
    </div>
    <div class="footer_connect">
        <h2>Connect with us</h2>
        <a href="https://www.instagram.com/comfyniseko/" class="connect_icon"><i class="fa-brands fa-instagram"></i></a>
    </div>
</footer>
