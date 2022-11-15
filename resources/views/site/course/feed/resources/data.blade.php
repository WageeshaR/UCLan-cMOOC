<?php for ($x = 0; $x <= rand(5,10); $x++) {
    $rand_chars = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O");
?>
    <div class="resource_tab_item_horizontal">
        <a style="display: flex; flex-direction: row; align-items: center" href="https://www.sample.com" >
            <i style="font-size: 32px; color: lightgrey; margin-right: 5px" class="material-icons">folder</i>
            <span>Data of research <?php echo $rand_chars[array_rand($rand_chars)] ?></span>
        </a>
    </div>
<?php } ?>