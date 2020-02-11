<div class="container mt-20">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <form method="post" id="filterSongs">

        <input type="hidden" name="exec[{cn_id}]" value="saveSong" />
        <input type="hidden" name="songID" value="{songID}" />

        <div class="form-group" style="">
          <label>Titel</label><br />
          <input type="input" name="songTitle" value="{songTitle}" />
        </div>

        <div class="form-group" style="">
          <label>Buch</label><br />
          <select name="songBook" style="width:180px;height:28px;">
            <option value=""></option>
            {foreach($songBooks as $songBookID => $songBookName):}
            <option value="{$songBookID}"{if($songBookID == $songBook):} selected="selected"{endif;}>{$songBookName}</option>
            {endforeach;}
          </select>
        </div>

        <div class="form-group" style="">
          <label>Nummer</label><br />
          <input type="input" name="songNumber" value="{songNumber}" />
        </div>

        <div class="form-group" style="">
          <input type="submit" value="{buttonText}" class="btn btn-primary" />
          <a href="{songsListPage}" class="btn btn-primary">zur Liste</a>
        </div>

      </form>

    </div>
  </div>
</div>