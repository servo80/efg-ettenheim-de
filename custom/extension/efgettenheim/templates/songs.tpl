<div class="container mt-20">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <style>

        table.songs {
          margin-bottom:10px;
        }

        table.songs th, td {
          padding: 3px;
          border:1px solid black;
          color:black;
        }

        table.songs th {
          background-color:black;
          color:white;
          border:1px solid white;
        }

        table.songs th.left {
          border-left:1px solid black;
        }

        table.songs th.right {
          border-right:1px solid black;
        }

        table.ui-datepicker-calendar, div.ui-datepicker-header {
          background-color:white;
          border:1px solid black;
        }

        table.ui-datepicker-calendar th, table.ui-datepicker-calendar td {
          border:1px solid black;
        }


      </style>

      <form method="post" id="filterSongs">

        <div class="form-group" style="float:left;margin-right:20px;">
          <label>Titel</label><br />
          <input type="input" name="songTitle" value="{songTitle}" onchange="this.form.submit();" />
        </div>

        <div class="form-group" style="float:left;margin-right:20px;">
          <label>Buch</label><br />
          <select name="songBook" style="width:180px;height:28px;" onchange="this.form.submit();">
            <option value="">nicht filtern</option>
            {foreach($songBooks as $songBookID => $songBookName):}
            <option value="{$songBookID}"{if($songBookID == $songBook):} selected="selected"{endif;}>{$songBookName}</option>
            {endforeach;}
          </select>
        </div>

        <div class="form-group" style="float:left;">
          <label>Nummer</label><br />
          <input type="input" name="songNumber" value="{songNumber}" onchange="this.form.submit();" />
        </div>


        <div class="form-group" style="clear:left;float:left;margin-right:20px;">
          <label>Musikteam</label><br />
          <select name="songWorshipLeader" style="width:180px;height:28px;" onchange="this.form.submit();">
            <option value="0"{if($songWorshipLeader == 0):} selected="selected"{endif;}>nicht filtern</option>
            {foreach($worshipLeaders as $worshipLeaderID => $worshipLeaderName):}
              <option value="{$worshipLeaderID}"{if($worshipLeaderID == $songWorshipLeader):} selected="selected"{endif;}>{$worshipLeaderName}</option>
            {endforeach;}
          </select>
        </div>

        <div class="form-group" style="float:left;">
          <label>Zeitraum</label><br />
          von <input type="input" name="songDateFrom" id="songDateFrom" value="{songDateFrom}" style="width:66px;" onchange="this.form.submit();" />
          bis <input type="input" name="songDateTo" id="songDateTo" value="{songDateTo}" style="width:66px;" onchange="this.form.submit();" />
        </div>

        <div class="form-group" style="float:left;margin-left:20px;">
          <label>nur gesungene Lieder</label><br />
          <input type="checkbox" name="songSung" value="1" onchange="this.form.submit();" {if($songSung == 1):} checked="checked"{endif;} />
        </div>

      </form>

      <table style="width:100%" class="songs">

        <thead>
          <tr>
            <th class="left">#</th>
            <th>Titel</th>
            <th>Buch</th>
            <th>Häufigkeit</th>
            <th class="right" colspan="2">Gespielt am</th>
          </tr>
        </thead>

        <tbody>
        {foreach($songs as $song):}

        <tr>
          <td>{$song->order}</td>
          <td>{$song->title}</td>
          <td>{$song->book}</td>
          <td>{echo count($song->dates)}</td>
          <td>{echo implode(', ', $song->dates)}</td>
          <td><a href="{songEditPage}?songID={$song->id}" target="_blank"><img src="custom/themes/efg-ettenheim-de/img/edit.png" width="16" /></a></td>
        </tr>

        {endforeach;}

        </tbody>

      </table>

      <a href="{songEditPage}">Neues Lied anlegen</a>

    </div>
  </div>
</div>