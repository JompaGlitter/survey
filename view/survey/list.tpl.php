<h1>Alla undersökningsformulär</h1>
<p>Här är alla undersökningsformulär som för närvarande finns i databasen.</p>

<ul>
<?php foreach ($surveys as $survey) : ?>
        <li><a href="<?=$this->url->create('survey.php/survey/view-single/' . $survey->id)?>"><?=$survey->name?></a></li>
<?php endforeach; ?>
</ul>

<p><a href="<?=$this->url->create('survey.php/survey/add-view')?>">Skapa nytt formulär</a></p>

<hr>

<form method=post>
    <input type='submit' name='doDeleteAll' value='Radera alla formulär' onClick="this.form.action = '<?=$this->url->create('survey.php/survey/delete-all')?>'"/>
</form>


<p><a href="<?=$this->url->create('survey.php/setup')?>">Återställ survey-databasen</a> (OBS! Raderar allt och återställer databasen till grundinställningar!)</p>