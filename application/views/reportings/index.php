<form method="post" action="">
    <input type="text" name="ticker" placeholder="Company ticker" value="<?php echo $ticker; ?>" />
    <input type="checkbox" name="yahoo" value="yahoo" /> Yahoo
    <input type="checkbox" name="google" value="google" />  Google
    <input class="button" type="submit" />
</form>
<h2>Yahoo Headlines</h2>
<ul>
    <?php
    if(!count($yahooHeadlines))
        echo "<h3>No headlines available!</h3>";
    
    foreach ($yahooHeadlines as $headline) {
        if ($headline->title && $headline->link)
            echo "<li>" . $headline->title . "<br />"
                . "<a hreg='{$headline->link}'>{$headline->link}</a></li>";
    }
    ?>
</ul>
<h2>Google Headlines</h2>
<ul>
    <?php
    if(!count($googleHeadlines))
        echo "<h3>No headlines available!</h3>";
    
    foreach ($googleHeadlines as $headline) {
        if ($headline->title && $headline->link)
            echo "<li>" . $headline->title . "<br />"
                . "<a hreg='{$headline->link}'>{$headline->link}</a></li>";
    }
    ?>
</ul>