<div class="page-section">
    <div class="page-section-header">
        Spelers overzicht
    </div>
    <div class="page-section-content">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Datum geregistreerd</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($this->player_data as $row){ ?>
                <tr>
                    <td><?php echo $id = $row['ID'];?></td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['Registered'];?></td>
                    <td class="row-icon-holder">
                        <a href="<?php echo _URL.'module/track/'.$id;?>"><?php ResourceLoader::loadIMG('tracking_icon.png', 'class="row-icon"');?></a>
                        <a href="<?php echo _URL.'dashboard/player-delete/'.$id;?>"><?php ResourceLoader::loadIMG('delete.png', 'class="row-icon"');?></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="page-section">
    <div class="page-section-header">
        Gebruikers overzicht
    </div>
    <div class="page-section-content">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Inlognaam</th>
                <th scope="col">Geverifieerd</th>
                <th scope="col">Token</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($this->account_data as $row){ ?>
                <tr>
                    <td><?php echo ($id = $row['ID']);?></td>
                    <td><?php echo $row['Username'];?></td>
                    <td><?php echo (($validated = $row['Validated'] == 1) ? "<span style='color: green'>Ja</span>" : "<span style='color: red'>Nee</span>");?></td>
                    <td><?php echo $row['Token'];?></td>
                    <td class="row-icon-holder">
                        <a href="<?php echo !$validated ? _URL.'dashboard/user-verify/'.$id : "";?>"><?php ResourceLoader::loadIMG('verify.png', 'class="row-icon"'.($validated ? 'style="opacity: .4"' : ''));?></a>
                        <a href="<?php echo _URL.'dashboard/user-delete/'.$id;?>"><?php ResourceLoader::loadIMG('delete.png', 'class="row-icon"');?></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>