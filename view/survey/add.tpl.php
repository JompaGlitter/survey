<h1><?=$title?></h1>

<div>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create('survey.php')?>">
        <fieldset>
        <legend>Skapa nytt formulär</legend>
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Beskrivning:<br/><textarea name='text'><?=$text?></textarea></label></p>
        <p><label>Bedömningsskala:<br/>1 till <input type='number' name='scale' min='1' max='10' value='<?=$scale?>'> (max=10)</label></p>
        <p><label>Från:<br/><input type='text' name='paramleft' value='<?=$paramleft?>'/></label></p>
        <p><label>Till:<br/><input type='text' name='paramright' value='<?=$paramright?>'/></label></p>
        
        <p>
            <input type='submit' name='doCreate' value='Spara formulär' onClick="this.form.action = '<?=$this->url->create('survey.php/survey/add')?>'"/>
            <input type='reset' value='Återställ'/>
            <input type='submit' name='doGoBack' value='Avbryt' onClick="this.form.action = '<?=$this->url->create('survey.php')?>'"/>
        </p>
        </fieldset>
    </form>
</div>