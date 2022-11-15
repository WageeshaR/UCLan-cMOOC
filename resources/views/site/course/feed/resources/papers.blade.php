<?php for ($x = 0; $x <= rand(5,10); $x++) {
    $rand_chars = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O");
    $a = array_rand($rand_chars);
    $b = array_rand($rand_chars);
?>
    <div class="resource_tab_item_vertical">
        <a href="https://www.sample.com" >Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
        <p style="font-size: small; margin-top: -2px">
            <?php echo $rand_chars[$a] ?>. Author, <?php echo $rand_chars[$b] ?>. Author - Symposium One, 201<?php echo rand(0,9) ?>
        </p>
    </div>
<?php } ?>