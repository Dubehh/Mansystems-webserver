<div class="page-section">
    <div class="page-section-header">
        Vragen overzicht
    </div>
    <div class="page-section-content">
        <div class="page-section-sub-header">
            Nieuwe vraag
        </div>
        <div class="page-section-sub-header">
            Actuele vragenlijst
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Vraag</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th scope="col">Moeilijkheidsgraad</th>
                <th scope="col">Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td colspan="5">test</td>
                <td>Makkelijk</td>
                <?php echo "<td class='row-icon-holder'><a href='"._URL."dashboard/player-delete/'><img src='".ResourceLoader::getRelativePath(_IMG, 'delete.png')."' class='row-icon'/></a></td>";?>
            </tr>
            </tbody>
        </table>
    </div>
</div>