<div class="page-section">
    <div class="page-section-header">
        Nieuwe vraag toevoegen
    </div>
    <div class="page-section-content container-fluid">
        <form method="post" name="question-adding">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="cols-sm-2 control-label">Vraag</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="Question"  placeholder="Typ hier de vraag"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="cols-sm-2 control-label">Moeilijkheidsgraad</label>
                    <div class="cols-sm-10">
                        <div class="input-group radio">
                            <label class="radio-label">
                                <input value="3" type="radio" name="Difficulty" checked/><span>Makkelijk</span>
                            </label>
                        </div>
                        <div class="input-group radio">
                            <label class="radio-label">
                                <input value="2" type="radio" name="Difficulty"/><span>Gemiddeld</span>
                            </label>
                        </div>
                        <div class="input-group radio">
                            <label class="radio-label">
                                <input value="1" type="radio" name="Difficulty"/><span>Moeilijk</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="cols-sm-2 control-label">Antwoord</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="CorrectAnswer" placeholder="Typ hier het juiste antwoord"/>
                        </div>
                    </div>
                    <label class="cols-sm-2 control-label">Onjuiste antwoorden</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="WrongAnswer1" placeholder="Typ hier een onjuist antwoord"/>
                        </div>
                    </div>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="WrongAnswer2" placeholder="Typ hier een onjuist antwoord"/>
                        </div>
                    </div>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="WrongAnswer3" placeholder="Typ hier een onjuist antwoord"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-footer">
                <button class="btn btn-success locate-right">Toevoegen</button>
                <a class="btn btn-danger locate-right" href="<?php echo _URL.'module/millionaire'?>">&#8592; Terug</a>
            </div>
        </form>
    </div>
</div>