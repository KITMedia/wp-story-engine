<?php if ($image->caption) { ?>
[caption align="<?php echo $image->align; ?>" width="<?php echo $image->width; ?>" class="size-<?php echo $image->size; ?>"]<?php } ?>
<?php if ($image->link) { ?>
<a href="<?php echo $image->link; ?>">
    <?php } ?>
    <?php echo $imageHTML; ?>
    <?php if ($image->link) { ?>
</a>
<?php } ?>
<?php if ($image->caption) { ?><?php echo $image->caption; ?> [/caption]<?php } ?>