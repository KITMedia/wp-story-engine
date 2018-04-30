<?php if ($image->link) { ?>
<a href="<?php echo $image->link; ?>">
    <?php } ?>
    <?php echo $imageHTML; ?>
    <?php if ($image->link) { ?>
</a>
<?php } ?>
