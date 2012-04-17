<div id="galery_item">
    <a href="<?php echo Images::getFilePath($data->id); ?>">
        <?php echo CHtml::image(Images::getFilePath($data->id), $data->title); ?>
        <p><?php echo $data->title; ?></p>
    </a>
</div>
