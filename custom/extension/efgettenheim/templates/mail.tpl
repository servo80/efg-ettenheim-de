<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>EFG Ettenheim - Gottesdienstplanung</title>
    <style type="text/css">
      body {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        margin:0 !important;
        width: 100% !important;
        -webkit-text-size-adjust: 100% !important;
        -ms-text-size-adjust: 100% !important;
        -webkit-font-smoothing: antialiased !important;
      }
      .tableContent img {
        border: 0 !important;
        display: block !important;
        outline: none !important;
      }
      a{
        color:#382F2E;
      }

      p, h1{
        color:#382F2E;
        margin:0;
      }
      p{
        text-align:left;
        color:#999999;
        font-size:14px;
        font-weight:normal;
        line-height:19px;
      }

      a.link1{
        color:#382F2E;
      }
      a.link2{
        font-size:16px;
        text-decoration:none;
        color:#ffffff;
      }

      h2{
        text-align:left;
        color:#222222;
        font-size:19px;
        font-weight:normal;
      }
      div,p,ul,h1{
        margin:0;
      }

      .bgBody{
        background: #ffffff;
      }
      .bgItem{
        background: #ffffff;
      }

    </style>

    <script type="colorScheme" class="swatch active">
{
    "name":"Default",
    "bgBody":"ffffff",
    "link":"382F2E",
    "color":"999999",
    "bgItem":"ffffff",
    "title":"222222"
}
</script>

  </head>
  <body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style='font-family:Helvetica, Arial,serif;'>


      <tr><td height='35'></td></tr>

      <tr>
        <td>
          <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class='bgItem'>
            <tr>
              <td width='40'></td>
              <td width='520'>
                <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">

                  <!-- =============================== Header ====================================== -->


                  <tr><td height='75'></td></tr>
                  <!-- =============================== Body ====================================== -->

                  <tr>
                    <td class='movableContentContainer ' valign='top'>

                      <div class='movableContent'>
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td valign='top' align='center'>
                              <div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable">
                                  <p style='text-align:center;margin:0;font-family:Georgia,Time,sans-serif;font-size:26px;line-height:34px;color:#222222;'>
                                    Gottesdienstplanung
                                  </p>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>

                      <div class='movableContent'>
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td valign='top' align='center'>
                              <div class="contentEditableContainer contentImageEditable">
                                <div class="contentEditable">
                                  <img src="cid:logo.png" width='300' height='120' alt='' data-default="placeholder" data-max-width="560">
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>

                      <div class='movableContent'>
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr><td height='55'></td></tr>
                          <tr>
                            <td align='left'>
                              <div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable" align='center'>
                                  <h2>Information</h2>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <tr><td height='15'> </td></tr>

                          <tr>
                            <td align='left'>
                              <div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable" align='center'>
                                  <p >

                                    F&uuml;r den Gottesdienst am {$serviceRow->serviceLabel}

                                    {if($type == 'moderator_missing'):}

                                    wurde noch kein Moderator hinterlegt. Bitte hinterlege den zust&auml;ndigen Moderator zeitnah, um die rechtzeitige Abwicklung der Gottesdiesnstplanung zu gew&auml;hrleisten.

                                    <br /><br />
                                    <a href="{app:path:https}de/event.html?eventTimestamp={$serviceRow->serviceDate}" class="link2" bgcolor="#1A54BA" style="clear:both; display:block; text-align:center; color:#ffffff; background:#1A54BA; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;">Hier klicken, um den Moderator zu hinterlegen.</a>

                                    <br /><br />
                                    Der Link funktioniert nur im eingeloggten Zustand.

                                    {elseif($type == 'worship_leader_missing'):}

                                    wurde noch kein Lobpreisleiter hinterlegt. Bitte hinterlege den zust&auml;ndigen Moderator zeitnah, um die rechtzeitige Abwicklung der Gottesdienstplanung zu gew&auml;hrleisten.

                                    <br /><br />
                                    <a href="{app:path:https}de/event.html?eventTimestamp={$serviceRow->serviceDate}" class="link2" bgcolor="#1A54BA" style="clear:both; display:block; text-align:center; color:#ffffff; background:#1A54BA; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;">Hier klicken, um den Lobpreisleiter zu hinterlegen.</a>

                                    <br /><br />
                                    Der Link funktioniert nur im eingeloggten Zustand.

                                    {elseif($type == 'sermon_topic_missing'):}

                                    wurde noch kein Predigtthema hinterlegt. Bitte hinterlege die Information zeitnah, um die rechtzeitige Abwicklung der Gottesdiesnstplanung zu gew&auml;hrleisten.

                                    <br /><br />
                                    <a href="{app:path:https}de/event.html?eventTimestamp={$serviceRow->serviceDate}&mode=sermonTopic" class="link2" bgcolor="#1A54BA" style="clear:both; display:block; text-align:center; color:#ffffff; background:#1A54BA; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;">Hier klicken, um das Predigtthema zu hinterlegen.</a>

                                    <br /><br />
                                    Der Link funktioniert nur im eingeloggten Zustand.

                                    {elseif($type == 'songs_missing'):}

                                    wurde das Predigtthema hinterlegt:

                                    {$serviceRow->serviceSermonTopic}

                                    Bitte w&auml;hlen Sie nun die Lieder aus.

                                    <br /><br />
                                    <a href="{app:path:https}de/event.html?eventTimestamp={$serviceRow->serviceDate}&mode=songs" class="link2" bgcolor="#1A54BA" style="clear:both; display:block; text-align:center; color:#ffffff; background:#1A54BA; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;">Hier klicken, um die Lieder zu hinterlegen.</a>

                                    <br /><br />
                                    Der Link funktioniert nur im eingeloggten Zustand.

                                    {elseif($type == 'agenda_missing'):}

                                    wurden nun folgende Lieder ausgew&auml;hlt:
                                    <br /><br />
                                    <ol>
                                    {foreach($songs as $song):}
                                    <li>{echo $song->songTitle}</li>
                                    {endforeach;}
                                    </ol>
                                    <br /><br />
                                    Der Ablauf kann nun fertiggestellt werden.

                                    <br /><br />
                                    <a href="{app:path:https}de/event.html?eventTimestamp={$serviceRow->serviceDate}&mode=agenda" class="link2" bgcolor="#1A54BA" style="clear:both; display:block; text-align:center; color:#ffffff; background:#1A54BA; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;">Hier klicken, um den Ablauf fertigzustellen.</a>

                                    <br /><br />
                                    Der Link funktioniert nur im eingeloggten Zustand.

                                    {elseif($type == 'agenda_final'):}

                                    wurde die Planung nun abgeschlossen. Du findest den Ablauf im Anhang dieser Mail.

                                    {endif;}

                                    {if(!empty($serviceRow->serviceAdditionalInfo)):}
                                    <br /><br />
                                    <span style="color:red;">
                                    Wichtige Hinweise zum Gottesdienst:<br /><br />
                                    {echo $serviceRow->serviceAdditionalInfo}
                                    </span>
                                    {endif;}

                                  </p>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <tr><td height='20'></td></tr>
                        </table>
                      </div>

                      <div class='movableContent'>
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr><td  style='border-bottom:1px solid #DDDDDD;'></td></tr>

                          <tr><td height='25'></td></tr>

                          <tr>
                            <td>
                              <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                  <td valign='top' align='left' width='370'>
                                    <div class="contentEditableContainer contentTextEditable">
                                      <div class="contentEditable" align='center'>
                                        <p  style='text-align:left;color:#CCCCCC;font-size:12px;font-weight:normal;line-height:20px;'>
                                          <span style='font-weight:bold;'>&copy; Evangelisch-Freikirchliche Gemeinde Ettenheim, Stückle-Straße 2, 77955 Ettenheim</span>
                                          <br>
                                        </p>
                                      </div>
                                    </div>
                                  </td>

                                  <td width='30'></td>

                                  <td valign='top' width='52'>
                                    <div class="contentEditableContainer contentFacebookEditable">
                                      <div class="contentEditable">
                                      </div>
                                    </div>
                                  </td>

                                  <td width='16'></td>

                                  <td valign='top' width='52'>
                                    <div class="contentEditableContainer contentTwitterEditable">
                                      <div class="contentEditable">
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </div>



                    </td>
                  </tr>

                </table>
              </td>
              <td width='40'></td>
            </tr>
          </table>
        </td>
      </tr>

      <tr><td height='88'></td></tr>

    </table>

  </body>
</html>
