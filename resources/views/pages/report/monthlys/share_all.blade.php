<style>
  .tb { border-collapse: collapse; }
  .tb th, .tb td { padding: 5px; border: solid 1px #777; }
  .tb th { background-color: lightblue; }
</style>

<table class="tb" style="width:100%;">
  <thead>
    <tr>
      <th>No</th>
      <th>Petugas</th>
      <th>Total Wo</th>
      <th>Lunas</th>
      <th>Janji</th>
      <th>Total Realisasi</th>
      <th>%</th>
    </tr>
  </thead>
  <tbody>
    @php echo $no=0;@endphp
    @foreach ($top_officers as $row)
    <tr>
      
      <td>{{ $row->no }}</td>
      <td>{{ $row->name }}</td>
      <td>{{ $row->total_wo }}</td>
      <td>{{ $row->total_paid }}</td>
      <td>{{ $row->total_debt }}</td>
      <td>{{ $row->total_realisasi }}</td>
      <td>{{ $row->total_persen }}</td>

    </tr>
    @endforeach
  </tbody>
</table>