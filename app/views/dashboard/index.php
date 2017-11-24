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
            <?php
            foreach($this->data as $row){
                echo "<tr>";
                echo "<td>".($id = $row['ID'])."</td>";
                echo "<td>".$row['Name']."</td>";
                echo "<td>".$row['Registered']."</td>";
                echo "<td><a href='"._URL."dashboard/player-delete/".$id."'><img src='".ResourceLoader::getRelativePath(_IMG, 'delete.png')."' class='row-icon'/></a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
