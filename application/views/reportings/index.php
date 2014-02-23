<form method="post" action="">
    <input type="text" name="ticker" placeholder="Company ticker" />
    <input type="submit" />
</form>
<h2>Headlines</h2>
<ul>
    <?php
//print_r($headlines);
    foreach ($headlines as $headline) {
        if ($headline->title && $headline->link)
            echo "<li>" . $headline->title . "<br />"
                . "<a hreg='{$headline->link}'>{$headline->link}</a></li>";
    }
    ?>
</ul>