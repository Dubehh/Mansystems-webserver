<div class="page-section">
    <div class="page-section-header">
        <?php echo $this->isTrackingView ? "Bekijk tracking gegevens" : "Modules overzicht";
        if ($this->isTrackingView) { ?>
            <div class="module-tracking-overview">
                <div class="module-tracking-img">
                    <?php ResourceLoader::loadIMG('tracking.png'); ?>
                </div>
                <div class="module-tracking-info">
                    <table class="table table-responsive">
                        <tr>
                            <th>Speler</th>
                            <td>:</td>
                            <td><?php echo $this->player->getName(); ?></td>
                        </tr>
                        <tr>
                            <th>Referentie</th>
                            <td>:</td>
                            <td><?php echo $this->player->getUUID(); ?></td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <td>:</td>
                            <td><?php echo $this->player->getID(); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="container-fluid">
        <?php
        /** @var $module Module */
        foreach ($this->modules as $module) { ?>
            <div class="module-display" style="background-color: <?php echo $module->getColor(); ?>">
                <a href="<?php echo _URL . 'module/' . $module->getController().($this->isTrackingView ? '/track/'.$this->player->getID() : ''); ?>">
                    <div class="module-display-title">
                        <?php echo $module->getName(); ?>
                    </div>
                    <div class="module-display-icon">
                        <?php ResourceLoader::loadIMG('open.png'); ?>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
