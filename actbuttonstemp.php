 //-----------BEGIN SECTION FOR BUTTONS-----------------------
        function actbuttons()
	{
	IF ($_action=="New")
            {
                
                $adisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
                $type="submit";
                $name="submit";
                $value="Confirm_New_Act";
                $OnClick="";
                forminputbutton($type, $name, $value, $OnClick)
                ?></td></tr></form>
                <tr><td align="center" colspan="3"><?PHP
                defaultmemberbuttons();
                $adisplay .="</td></tr></table></form>";
                unset($_SESSION['submit']);
            }
            ELSEIF ($_action=="Confirm_New_Act")
            {
            ?>
        <TR><TD colspan="2" align="Center">
        <?PHP			//include ("http://www.louisvillemusic.com/test/phonelist.php?submit=".$_action."&thisuser_id=$thisuser_id".$phoneup);
        //		$OnClick="actphonelist.php?submit=Edit";
                $type="submit";
                $name="submit";
                $value="Accept";
                $OnClick="";
                forminputbutton($type, $name, $value, $OnClick)
                ?></td></tr></form>
                <tr><td align="center" colspan="3">
                <?PHP defaultmemberbuttons(); ?>
        </td></tr></table><?PHP
            }
            ELSEIF ($_action=="Edit")
            {
            $adisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
                $phones="http://www.louisvillemusic.com/eventediting/actphonelist.php?submit=".$_action."&amp;ActID=".$ActID."";
                include ($phones);
                ?>
                <table align="center" border="1">
                <th align="center" colspan="3" class="th">Weblinks</th>
                <tr><Td class="td3" width="12" align="right">URL</td><td class="td3" width="12">Type</td></tr><?PHP
        //		$linksup=stripslashes($linksup);
        $links ="http://www.louisvillemusic.com/eventediting/actlinklist.php?submit=".$_action."&amp;ActID=".$ActID."";
         include ($links);
        
                //$adisplay .="</table>";// End of weblinks table
                $adisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
                $adisplay .="<hr width=\"120\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
                $adisplay .="<input type=\"hidden\" name=\"ActID\" value=\"".$ActID."\">";
                $type="submit";
                $name="submit";
                $value="Update";
                $OnClick="http://www.louisvillemusic.com/eventediting/Actinfo.php";
                forminputbutton($type, $name, $value, $OnClick);
            ?> </td></tr></form>
            <tr><td align="center" colspan="3">
                <?PHP		 $adisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
                defaultmemberbuttons();
                ?>
                </td></tr>
                <br /></table><?PHP
                @mysql_close($connection);
            }
            ELSEIF ($_action=="Update")
            {
                $adisplay .="</td></tr><TR><TD colspan=\"2\" align=\"Center\">";
                include("http://www.louisvillemusic.com/eventediting/actphonelist.php?submit=".$_action."&amp;ActID=$ActID".$phoneup);?>
        </td></tr></table>
                        <table align="center" border="1">
                        <th align="center" colspan="3" class="th">Weblinks</th>
        <tr><Td class="td3" width="12" align="right">URL</td><td class="td3" width="12">Type</td></tr><?PHP
        $linksup=stripslashes($linksup);
        $links=("http://www.louisvillemusic.com/eventediting/actlinklist.php?submit=".$_action."&amp;ActID=$ActID".$linksup);
        include ($links);
                 $adisplay .="<hr width=\"120\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
                ?><TR><TD colspan="3" align="Center"><?PHP
                $type="submit";
                $name="submit";
                $value="Final_Update";
                $OnClick="http://www.louisvillemusic.com/eventediting/Actinfo.php";
                forminputbutton($type, $name, $value, $OnClick);?>
                </form><tr><td align="center" colspan="3">
                <?PHP $adisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
                defaultmemberbuttons();
                ?></td></tr></table></td></tr></table>
                <?PHP	@mysql_close($connection);
            }
            ELSEIF ($_action=="Final_Update")
            {
        
        $adisplay .="</td></tr><TR><TD colspan=\"2\" align=\"Center\">";
            $phones="http://www.louisvillemusic.com/eventediting/actphonelist.php?submit=".$_action."&amp;ActID=$ActID".$phoneup;
                include ($phones);?>
                        </td></tr></table>
                        <table align="center" border="1">
                        <th align="center" colspan="3" class="th">Weblinks</th>
        <tr><Td class="td3" width="12" align="right">URL</td><td class="td3" width="12">Type</td></tr>
        <?PHP
        $linksup=stripslashes($linksup);
        $links=("http://www.louisvillemusic.com/eventediting/actlinklist.php?submit=".$_action."&amp;ActID=$ActID".$linksup);
        include ($links);
        ?> <tr><td align="center" colspan="3">
        </form> <tr><td align="center" colspan="3">
                <?PHP $adisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
                defaultmemberbuttons();
                // buttonrow ("Continue",""); 
                ?>
                </td></tr></table>
        
                <?PHP unset($updatestring);
            } 
            ELSEIF ($_action=="Accept")
            {
        
        $adisplay .="</td></tr><TR><TD colspan=\"2\" align=\"Center\">";
            $phones="http://www.louisvillemusic.com/eventediting/actphonelist.php?submit=".$_action."&amp;ActID=$ActID".$phoneup;
                include ($phones);?>
                        </td></tr></table>
                        <table align="center" border="1">
                        <th align="center" colspan="3" class="th">Weblinks</th>
        <tr><Td class="td3" width="12" align="right">URL</td><td class="td3" width="12">Type</td></tr>
        <?PHP
        $linksup=stripslashes($linksup);
        $links=("http://www.louisvillemusic.com/eventediting/actlinklist.php?submit=".$_action."&amp;ActID=$ActID".$linksup);
        include ($links);
        ?> <tr><td align="center" colspan="3">
        </form> <tr><td align="center" colspan="3">
                <?PHP $adisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
                defaultmemberbuttons();
                ?>
                </td></tr></table>
                <?PHP unset($updatestring);
            } 
        }
