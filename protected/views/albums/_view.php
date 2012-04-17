    <div id="galery_item">
        <a href="<?php echo $this->createUrl('albums/view',
                array('id'=>$data->id)); ?>">
                <?php echo CHtml::image(Images::getLastFromAlb($data->id)); ?>
                <p><?php echo CHtml::encode($data->title); ?></p>
        </a>
    </div>