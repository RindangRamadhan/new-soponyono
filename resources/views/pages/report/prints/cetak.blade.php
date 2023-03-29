<table style="width: 100%;  font-family: 'Tahoma, sans-serif';font-size: 10; " cellspacing="0"
  cellpadding="0">
  <tbody>
    <tr>
      {{-- server --}}
      {{-- <td style="width: 5%;" rowspan="2"><img src="{{ asset('images/logo_pln_print.png') }}" alt="logo pln"
          width="40" height="40" /></td> --}}
      {{-- local --}}
      <td style="width: 5%;" rowspan="2"><img src="{{ public_path('/images/logo_pln_print.png') }}" alt="logo pln"
          width="40" height="40" /></td>
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
<table style="width: 100%; " cellspacing="0" cellpadding="0" >
  <tbody>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 10;">
      <td style="width: 20%; ">ID PELANGGAN</td>
      <td style="width: 40%;">: {{ $order->customer_id }}</td>
      <td style="width: 18%;">NAMA PETUGAS</td>
      <td style="width: 22%;">: {{ $order->officer_name }}</td>
    </tr>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 10;">
      <td>NAMA PELANGGAN</td>
      <td>: {{ $order->customer_name }}</td>
      <td>RBM</td>
      <td>: {{ $order->rbm_code }}</td>
    </tr>
    <tr  >
      <td style="font-family: 'Tahoma, sans-serif';font-size: 10;">TARIF/DAYA</td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 10;">: {{ $order->tarif }}/{{ $order->power }}
      </td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;" rowspan="2"><b>TAGIHAN</b></td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;" rowspan="2"><b>: {{$order->bill}}</b>
      </td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 10;">ALAMAT</td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 10;">: {{ $order->customer_address }}</td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 9;" colspan="2">
        <b> Dengan ini kami mohon
          untuk membayar rekening listrik tersebut di atas sebelum tanggal 20 untuk menghindari pemutusan sementara.</b>
          <br>
          <br>
          <b>( REKENING INI MERUPAKAN PEMAKAIAN
            ENERGI LISTRIK DIBULAN SEBELUMNYA )</b>
            <br>
          <br>
        </td>
      
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 9; text-align:center;vertical-align:middle"colspan="2" > 
        {{ $manager_ulp->location }}, {{ $date_now }}
      <br>
      MANAJER
      <br>
      {{-- server --}}
      {{-- <img src="{{ asset('/images/upload/'.$manager_ulp->tanda_tangan) }}" alt="ttd" width="40" height="40" /> --}}
      {{-- local --}}
      <img src="{{ public_path('/images/upload/'.$manager_ulp->tanda_tangan) }}" alt="ttd"
          width="40" height="40" />
      <br>
      {{ $manager_ulp->manager_name }}
    </td>
    </tr>
  </tbody>
</table>

<hr style="border-top: 2px dashed black;">

{{-- PELANGGAN --}}

<table style="width: 100%;  font-family: 'Tahoma, sans-serif';font-size: 10; " cellspacing="0"
  cellpadding="0">
  <tbody>
    <tr>
      {{-- server --}}
      {{-- <td style="width: 5%;" rowspan="2"><img src="{{ asset('images/logo_pln_print.png') }}" alt="logo pln"
          width="40" height="40" /></td> --}}
      {{-- local --}}
      <td style="width: 5%;" rowspan="2"><img src="{{ public_path('/images/logo_pln_print.png') }}" alt="logo pln"
          width="40" height="40" /></td>
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
<table style="width: 100%; " cellspacing="0" cellpadding="0" >
  <tbody>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 10;">
      <td style="width: 20%; ">ID PELANGGAN</td>
      <td style="width: 40%;">: {{ $order->customer_id }}</td>
      <td style="width: 18%;">NAMA PETUGAS</td>
      <td style="width: 22%;">: {{ $order->officer_name }}</td>
    </tr>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 10;">
      <td>NAMA PELANGGAN</td>
      <td>: {{ $order->customer_name }}</td>
      <td>RBM</td>
      <td>: {{ $order->rbm_code }}</td>
    </tr>
    <tr  >
      <td style="font-family: 'Tahoma, sans-serif';font-size: 10;">TARIF/DAYA</td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 10;">: {{ $order->tarif }}/{{ $order->power }}
      </td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;" rowspan="2"><b>TAGIHAN</b></td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;" rowspan="2"><b>: {{$order->bill}}</b>
      </td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 10;">ALAMAT</td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 10;">: {{ $order->customer_address }}</td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 9;" colspan="2">
        <b> Dengan ini kami mohon
          untuk membayar rekening listrik tersebut di atas sebelum tanggal 20 untuk menghindari pemutusan sementara.</b>
          <br>
          <br>
          <b>( REKENING INI MERUPAKAN PEMAKAIAN
            ENERGI LISTRIK DIBULAN SEBELUMNYA )</b>
            <br>
          <br>
        </td>
      
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 9; text-align:center;vertical-align:middle"colspan="2" > 
        {{ $manager_ulp->location }}, {{ $date_now }}
      <br>
      MANAJER
      <br>
      {{-- server --}}
      {{-- <img src="{{ asset('/images/upload/'.$manager_ulp->tanda_tangan) }}" alt="ttd" width="40" height="40" /> --}}
      {{-- local --}}
      <img src="{{ public_path('/images/upload/'.$manager_ulp->tanda_tangan) }}" alt="ttd"
          width="40" height="40" />
      <br>
      {{ $manager_ulp->manager_name }}
    </td>
    </tr>
  </tbody>
</table>

