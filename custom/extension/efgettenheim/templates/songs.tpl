<div class="container mt-20">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <style>

        table {
          margin-bottom:10px;
        }


        th, td {
          padding: 3px;
          border:1px solid black;
          color:black;
        }

        th {
          background-color:black;
          color:white;
          border:1px solid white;
        }

        th.left {
          border-left:1px solid black;
        }

        th.right {
          border-right:1px solid black;
        }


      </style>

      <table style="width:100%">

        <thead>
          <tr>
            <th class="left">Titel</th>
            <th>Buch</th>
            <th>Häufigkeit</th>
            <th class="right">Gespielt am</th>
          </tr>
        </thead>

        <tbody>
        {foreach($songs as $song):}

        <tr>
          <td>{$song->title}</td>
          <td>{$song->book}</td>
          <td>{echo count($song->dates)}</td>
          <td>{echo implode(', ', $song->dates)}</td>
        </tr>

        {endforeach;}

        </tbody>

      </table>


    </div>
  </div>
</div>