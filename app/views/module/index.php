<div class="page-section">
    <div class="page-section-header">
        Modules overzicht
    </div>
    <div class="container-fluid">
        <?php
        /** @var $module Module */
        foreach($this->modules as $module) {?>
        <div class="module-display" style="background-color: <?php echo $module->getColor();?>">
            <a href="<?php echo _URL.'module/'.$module->getController();?>">
                <div class="module-display-title">
                    <?php echo $module->getName(); ?>
                </div>
                <div class="module-display-icon">
                    <?php ResourceLoader::loadIMG('open.png');?>
                </div>
            </a>
        </div>
        <?php }?>
    </div>
</div>
