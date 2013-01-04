<?PHP 
function statusoption($status)
{
if ($status=="DE")
{?>
<select name="status"><option value="OK">Display</option>
      <option value="PE">Pending</option>
      <option value="DE" SELECTED>Deleted</option>
      </select>
	  <?PHP }
	  ELSEIF ($status=="PE")
	  
	  { ?>
	  <select name="status"><option value="OK">Display</option>
      <option value="PE" SELECTED>Pending</option>
      <option value="DE">Deleted</option>
      </select>
<?PHP }
ELSE 
{?>
<select name="status"><option value="OK" SELECTED>Display</option>
      <option value="PE">Pending</option>
      <option value="DE"> Deleted</option>
      </select>
<?PHP 
}
}

statusoption("");
?>