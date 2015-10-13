<?php foreach ($surveys as $survey) : ?>

<h2><?=$survey->name?></h2>
<p><?=$survey->text?></p>

<form method='post'>
    <p>
        <?=$survey->paramleft?>
        <?php
        for($x = 0; $x <= $survey->scale; $x++) {
            echo "<input type='radio' value='" . $x . "' name='result'>";
        }
        ?>
        <?=$survey->paramright?>
    </p>
    
    <p><small><em>Skapad: <?=$survey->created?></em></small></p>
    
    <input type='submit' name='doGoBack' value='Gå tillbaka' onClick="this.form.action = '<?=$this->url->create('survey.php/survey/view-single/' . $survey->id)?>'"/>
    <input type='submit' name='doGoBack' value='Avbryt' onClick="this.form.action = '<?=$this->url->create('survey.php')?>'"/>
</form>


<?php endforeach; ?>