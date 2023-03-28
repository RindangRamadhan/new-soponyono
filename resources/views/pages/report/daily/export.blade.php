<style>
  .table {
    border-collapse: collapse;
  }

  .table th,
  .table td {
    padding: 5px;
    border: solid 1px #777;
  }

  .table th {
    background-color: lightblue;
  }

</style>

<table class="table">
  <thead>
    <tr>
      <th rowspan="2">No</th>
      <th rowspan="2">Petugas</th>
      
      @for ($i = 1; $i <= 20; $i++) 
        <th colspan="2">{{ $i }}</th>
      @endfor
    </tr>
    <tr>
      @for ($i = 1; $i <= 20; $i++) 
        <th>Lunas</th>
        <th>Janji</th>
      @endfor
    </tr>
  </thead>
  <tbody>
    @foreach ($reports as $report)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td style="white-space: nowrap">{{ $report['name'] }}</td>
          @for ($i = 1; $i <= 20; $i++) 
            <td>{{ $report["total_paid_$i"] }}</td>
            <td>{{ $report["total_debt_$i"] }}</td>
          @endfor
        </tr>
    @endforeach
  </tbody>
</table>