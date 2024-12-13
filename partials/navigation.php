

<nav>
    <ul>
        <li>
            <a href="index.php" class="<?php echo setActiveClass('index.php')?>" > Home </a>
        </li>
        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <li>
            <a href="admin.php" class="<?php echo setActiveClass('admin.php')?>"> Admin </a>
        </li>
        <li>
            <a href="logout.php"> Logout </a>
        </li>
        <?php else : ?>
        <li>
            <a href="register.php" class="<?php echo setActiveClass('register.php')?>"> Register </a>
        </li>
        <li>
            <a href="login.php" class="<?php echo setActiveClass('login.php')?>"> Login </a>
        </li>
        <?php endif; ?>
    </ul>
 </nav>