<h1><?=$title?></h1>


<?php foreach ($surveys as $survey) : ?>

<p><strong>Namn: </strong><?=$survey->name?></p>
<p><strong>Beskrivning: </strong> <?=$survey->text?></p>
<p><strong>Bedömning: </strong>Från "<?=$survey->paramleft?>" till "<?=$survey->paramright?>" på en <?=$survey->scale?>-gradig skala.</p>
<p><strong>Skapad: </strong><?=$survey->created?></p>

<p>
    <form method='post'>
        <input type='submit' name='doEdit' value='Uppdatera' onClick="this.form.action = '<?=$this->url->create('survey.php/survey/edit-view/' . $survey->id)?>'">
        <input type='submit' name='doDeleteOne' value='Radera' onClick="this.form.action = '<?=$this->url->create('survey.php/survey/delete-single/' . $survey->id)?>'">
        <input type='submit' name='doSurveyForm' value='Visa formulär' onClick="this.form.action = '<?=$this->url->create('survey.php/survey/survey-form/' . $survey->id)?>'">
    </form>
</p>

<?php endforeach; ?>

<hr>

<p><a href="<?=$this->url->create('survey.php')?>">Se alla formulär</a></p>

