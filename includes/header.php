<header>
  <h1>Pizza Hut</h1>

  <nav>

    <?php
    $i = 0;
    $currentFileName = basename($_SERVER['PHP_SELF']);

    $pageLinks = array(
        ['index.php', 'HOME'],
        ['order.php', 'ORDER'],
        ['admin.php', 'ADMIN'],
    )
    ?>
    <a href="<?php echo $pageLinks[$i][0] ?>" class="nav-link <?php if ($currentFileName == $pageLinks[$i][0]) {echo 'active-nav-link"';} else {echo ' default-nav-link"';} ?>"> <?php echo $pageLinks[$i][1]; $i++; ?></a>
    <a href="<?php echo $pageLinks[$i][0] ?>" class="nav-link <?php if ($currentFileName == $pageLinks[$i][0]) {echo 'active-nav-link"';} else {echo ' default-nav-link"';} ?>"> <?php echo $pageLinks[$i][1]; $i++; ?></a>
    <a href="<?php echo $pageLinks[$i][0] ?>" class="nav-link <?php if ($currentFileName == $pageLinks[$i][0]) {echo 'active-nav-link"';} else {echo ' default-nav-link"';} ?>"> <?php echo $pageLinks[$i][1]; $i++; ?></a>

  </nav>

</header>
