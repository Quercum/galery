    <?php if(Albums::getCount($data->id)): ?>
    <div id="galery_item">
        <a href="<?php echo $this->createUrl('albums/index',array('id'=>$data->id)); ?>">
        <?php echo CHtml::image(Images::getLast($data->id),$data->login); ?>
        <p><?php echo CHtml::encode($data->login); ?></p>
        </a>
    </div>
    <? endif; ?>
