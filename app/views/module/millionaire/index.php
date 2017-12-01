<div class="page-section">
    <div class="page-section-header">
        Vragen overzicht - <?php echo $this->results;?> weergeven
    </div>
    <div class="page-section-content">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vraag</th>
                    <th>Antwoorden</th>
                    <th>Moeilijkheid</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->data as $dataRow){ ?>
                <tr>
                    <td><?php echo $dataRow['ID']; ?></td>
                    <td><?php echo $dataRow['Question']; ?></td>
                    <td class="table-expandable-column">
                        <?php ResourceLoader::loadIMG('view.png', 'class="row-icon"');?>
                        <div class="millionaire-table-question table-expandable-result">
                            <label>Vraag:</label>
                            <span><?php echo $dataRow['Question'];?></span>
                            <label>Antwoorden:</label>
                            <ol>
                                <li class="millionaire-correct-answer">1) <?php echo $dataRow['CorrectAnswer']; ?></li>
                                <?php for($i = 1; $i < 4; $i++)
                                    echo "<li class='millionaire-wrong-answer'>".($i+1).") ".$dataRow['WrongAnswer'.$i]."</li>"; ?>
                            </ol>
                        </div></td>
                    <td><?php echo MillionaireController::$difficulties[$dataRow['Difficulty']]; ?></td>
                    <td class="table-nav"><a href="<?php echo _URL.'module/millionaire/edit/'.$dataRow['ID'];?>">
                            <?php ResourceLoader::loadIMG('edit.png', 'class="row-icon"');?>
                        </a>
                        <a href="<?php echo _URL.'module/millionaire/delete/'.$dataRow['ID'];?>">
                            <?php ResourceLoader::loadIMG('delete.png', 'class="row-icon"');?>
                        </a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="table-footer">
            <a class="btn btn-success" href="<?php echo _URL.'module/millionaire/add'?>"> <i class="fa fa-plus" aria-hidden="true"></i> Nieuw</a>
        </div>
    </div>
    <div class="page-section-header">
        <div class="page-section-details">
            Pagina <?php echo $this->page->getCurrent(); ?>
            <div class="locate-right page-section-nav">
                <?php
                echo "<a ".($this->page->hasPrevious() ? "href='".$this->page->getURLTowards($this->page->getPrevious())."'" : "class='link-disabled'")."> Vorige pagina </a>";
                echo "<a href='".$this->page->getURLTowards($this->page->getNext())."'> Volgende pagina </a>";
                ?>
            </div>
        </div>
    </div>
</div>