@foreach ($orders as $order)
<table style="width: 100%; height: 50px; font-family: 'Tahoma, sans-serif';font-size: 14; " cellspacing="0"
  cellpadding="0">
  <tbody>
    <tr>
      <td style="width: 5%;" rowspan="2"><img src="{{ public_path('/images/logo_pln_print.png') }}" alt="logo pln"
          width="50" height="50" /></td>
      <td style="width: 20%;"><b>PT. PLN (Persero)</b></td>
      <td style="width: 51%; text-align:center;vertical-align:middle" rowspan="2"><b>INFO REKENING LISTRIK</b></td>
      <td style="width: 24%; text-align:center;vertical-align:middle" rowspan="2"><b>
          <table style="border: 1px solid black;
          border-collapse: collapse;">
            <tbody>
              <tr>
                <td> &nbsp;LEMBAR PETUGAS&nbsp;</td>
              </tr>
        </b></td>
    </tr>
    <tr>
      <td><b>ULP {{ $manager_ulp->location }} </b></td>
    </tr>
  </tbody>
</table>
<br>
<table style="width: 100%; " cellspacing="0" cellpadding="0">
  <tbody>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td style="width: 20%; ">ID PELANGGAN</td>
      <td style="width: 40%;">: {{ $order->customer_id }}</td>
      <td style="width: 18%;">NAMA PETUGAS</td>
      <td style="width: 22%;">: {{ $order->officer_name }}</td>
    </tr>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td>NAMA PELANGGAN</td>
      <td>: {{ $order->customer_name }}</td>
      <td>RBM</td>
      <td>: {{ $order->rbm_code }}</td>
    </tr>
    <tr>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">TARIF/DAYA</td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->tarif }}/{{ $order->power }}
      </td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>TAGIHAN</b></td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>: {{$order->bill}}</b>
      </td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">ALAMAT</td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->customer_address }}</td>
    </tr>
  </tbody>
</table>

<table style="width: 100%; " cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="height: 50px; width: 60%; font-family: 'Tahoma, sans-serif';font-size: 12;"><b> Dengan ini kami mohon
          untuk membayar rekening listrik tersebut di atas sebelum tanggal 20 untuk menghindari pemutusan sementara.</b>
      </td>
      <td style="height: 110px; width: 40%; text-align:center;vertical-align:middle" rowspan="3">
        <table
          style="width: 100%; height: 110px; font-family: 'Tahoma, sans-serif';font-size: 14; text-align:center;vertical-align:middle"
          cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td style="height: 20px; ">{{ $manager_ulp->location }}, {{ $date_now }}</td>
            </tr>
            <tr>
              <td style="height: 20px; ">MANAJER</td>
            </tr>
            <tr>
              <td style="height: 50px;  ">&nbsp;</td>
            </tr>
            <tr>
              <td style="height: 20px;  ">{{ $manager_ulp->manager_name }}</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="height: 10px; width: 60%; ">&nbsp;</td>
    </tr>
    <tr>
      <td style="height: 50px; font-family: 'Tahoma, sans-serif';font-size: 12;"><b>( REKENING INI MERUPAKAN PEMAKAIAN
          ENERGI LISTRIK DIBULAN SEBELUMNYA )</b></td>
    </tr>
  </tbody>
</table>
<hr style="border-top: 2px dashed black;">

{{-- PELANGGAN --}}
<table style="width: 100%; height: 50px; font-family: 'Tahoma, sans-serif';font-size: 14; " cellspacing="0"
  cellpadding="0">
  <tbody>
    <tr>

      <td style="width: 5%;" rowspan="2"><img src="{{ public_path('/images/logo_pln_print.png') }}" alt="logo pln"
          width="50" height="50" /></td>
      <td style="width: 20%;"><b>PT. PLN (Persero)</b></td>
      <td style="width: 51%; text-align:center;vertical-align:middle" rowspan="2"><b>INFO REKENING LISTRIK</b></td>
      <td style="width: 24%; text-align:center;vertical-align:middle" rowspan="2"><b>
          <table style="border: 1px solid black;
          border-collapse: collapse;">
            <tbody>
              <tr>
                <td> &nbsp;LEMBAR PELANGGAN&nbsp;</td>
              </tr>
        </b></td>
    </tr>
    <tr>
      <td><b>ULP {{ $manager_ulp->location }} </b></td>
    </tr>
  </tbody>
</table>
<br>
<table style="width: 100%; height: 50px;" cellspacing="0" cellpadding="0">
  <tbody>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td style="width: 20%; ">ID PELANGGAN</td>
      <td style="width: 40%;">: {{ $order->customer_id }}</td>
      <td style="width: 18%;">NAMA PETUGAS</td>
      <td style="width: 22%;">: {{ $order->officer_name }}</td>
    </tr>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td>NAMA PELANGGAN</td>
      <td>: {{ $order->customer_name }}</td>
      <td>RBM</td>
      <td>: {{ $order->rbm_code }}</td>
    </tr>
    <tr>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">TARIF/DAYA</td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->tarif }}/{{ $order->power }}
      </td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>TAGIHAN</b></td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>: {{$order->bill}}</b>
      </td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">ALAMAT</td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->customer_address }}</td>
    </tr>
  </tbody>
</table>

<table style="width: 100%; " cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="height: 50px; width: 60%; font-family: 'Tahoma, sans-serif';font-size: 12;"><b> Dengan ini kami mohon
          untuk membayar rekening listrik tersebut di atas sebelum tanggal 20 untuk menghindari pemutusan sementara.</b>
      </td>
      <td style="height: 110px; width: 40%; text-align:center;vertical-align:middle" rowspan="3">
        <table
          style="width: 100%; height: 110px; font-family: 'Tahoma, sans-serif';font-size: 14; text-align:center;vertical-align:middle"
          cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td style="height: 20px; ">{{ $manager_ulp->location }}, {{ $date_now }}</td>
            </tr>
            <tr>
              <td style="height: 20px; ">MANAJER</td>
            </tr>
            <tr>
              <td style="height: 50px;  ">&nbsp;</td>
            </tr>
            <tr>
              <td style="height: 20px;  ">{{ $manager_ulp->manager_name }}</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="height: 10px; width: 60%; ">&nbsp;</td>
    </tr>
    <tr>
      <td style="height: 50px; font-family: 'Tahoma, sans-serif';font-size: 12;"><b>( REKENING INI MERUPAKAN PEMAKAIAN
          ENERGI LISTRIK DIBULAN SEBELUMNYA )</b></td>
    </tr>
  </tbody>
</table>

@endforeach