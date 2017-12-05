<div class="page-section">
    <div class="page-section-header">
        Catcher - Tracking gegevens <?php echo ' - ' . $this->results; ?> weergeven
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
    </div>
    <div class="page-section-content">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Score</th>
                <th>Gewonnen experience</th>
                <th>Gewonnen Monny</th>
                <th>Gevangen klanten</th>
                <th>Gevangen nepklanten</th>
                <th>Datum toegevoegd</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->data as $row) { ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['Score'] ?></td>
                    <td><?php echo $row['ExperienceEarned']; ?></td>
                    <td><?php echo $row['CoinsEarned']; ?></td>
                    <td><?php echo $row['LogosCaught']; ?></td>
                    <td><?php echo $row['FakeLogosCaught']; ?></td>
                    <td><?php echo $row['DateAdded']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
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
