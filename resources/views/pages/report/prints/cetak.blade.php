<table style="width: 100%; height: 50px; font-family: 'Tahoma, sans-serif';font-size: 14; ">
  <tbody>
    <tr>
      {{-- <img src="{{ asset('/images/logo_pln_print.png') }}" alt="logo pln" /> --}}
      <td style="width: 5%;" rowspan="2"></td>
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
      <td><b>ULP {{ $order->ulp_name }} </b></td>
    </tr>
  </tbody>
</table>
<br>
<table style="width: 100%; height: 50px;">
  <tbody>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td style="width: 20%; ">ID PELANGGAN</td>
      <td style="width: 40%;">: {{ $order->customer_id }}</td>
      <td style="width: 18%;">NAMA PETUGAS</td>
      <td style="width: 22%;">: {{ $order->officer_name }}</td>
    </tr>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td >NAMA PELANGGAN</td>
      <td >: {{ $order->customer_name }}</td>
      <td >RBM</td>
      <td >: {{ $order->rbm_code }}</td>
    </tr>
    <tr>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">TARIF/DAYA</td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->tarif }}/{{ $order->power }}
      </td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>TAGIHAN</b></td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>: {{ $order->bill }}</b>
      </td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">ALAMAT</td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->customer_address }}</td>
    </tr>
  </tbody>
</table>
<table style="width: 100%; height: 110px;">
  <tbody>
    <tr style="height: 50px;">
      <td style="height: 50px; width: 60%; font-family: 'Tahoma, sans-serif';font-size: 12;"><b> Dengan ini kami mohon untuk membayar rekening listrik tersebut di atas sebelum tanggal 20 untuk menghindari pemutusan sementara.</b></td>
      <td style="height: 110px; width: 40%; border-spacing: 0;" rowspan="3">
        <table style="width: 100%; border-spacing: 0;">
          <tbody>
          <tr>
          <td>METRO</td>
          </tr>
          <tr>
          <td>MANAGER</td>
          </tr>
          <tr>
          <td>&nbsp;</td>
          </tr>
          <tr>
          <td>EKO WAHYUDI</td>
          </tr>
          </tbody>
          </table>
        </td>
    </tr>
    <tr style="height: 10px;">
      <td style="height: 10px; width: 60%; ">&nbsp;</td>
    </tr>
    <tr style="height: 50px;">
      <td style="height: 50px; font-family: 'Tahoma, sans-serif';font-size: 12;"><b>( REKENING INI MERUPAKAN PEMAKAIAN ENERGI LISTRIK DIBULAN SEBELUMNYA )</b></td>
    </tr>
  </tbody>
</table>



{{-- Pelanggan --}}
<hr style="height:2px;border-width:0;color:gray;background-color:gray">
<table style="width: 100%; height: 50px; font-family: 'Tahoma, sans-serif';font-size: 14; ">
  <tbody>
    <tr>
      {{-- <img src="{{ asset('/images/logo_pln_print.png') }}" alt="logo pln" /> --}}
      <td style="width: 5%;" rowspan="2"></td>
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
      <td><b>ULP {{ $order->ulp_name }} </b></td>
    </tr>
  </tbody>
</table>
<br>
<table style="width: 100%; height: 50px;">
  <tbody>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td style="width: 20%; ">ID PELANGGAN</td>
      <td style="width: 40%;">: {{ $order->customer_id }}</td>
      <td style="width: 18%;">NAMA PETUGAS</td>
      <td style="width: 22%;">: {{ $order->officer_name }}</td>
    </tr>
    <tr style="font-family: 'Tahoma, sans-serif';font-size: 14;">
      <td >NAMA PELANGGAN</td>
      <td >: {{ $order->customer_name }}</td>
      <td >RBM</td>
      <td >: {{ $order->rbm_code }}</td>
    </tr>
    <tr>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">TARIF/DAYA</td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->tarif }}/{{ $order->power }}
      </td>
      <td style="font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>TAGIHAN</b></td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 18;" rowspan="2"><b>: {{ $order->bill }}</b>
      </td>
    </tr>
    <tr>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">ALAMAT</td>
      <td style=" font-family: 'Tahoma, sans-serif';font-size: 14;">: {{ $order->customer_address }}</td>
    </tr>
  </tbody>
</table>
<table style="width: 100%;">
  <tbody>
    <tr style="height: 50px;">
      <td style="height: 50px; width: 60%; font-family: 'Tahoma, sans-serif';font-size: 12;"><b> Dengan ini kami mohon untuk membayar rekening listrik tersebut di atas sebelum tanggal 20 untuk menghindari pemutusan sementara.</b></td>
      <td style="height: 114px; width: 40%;" rowspan="3">1</td>
    </tr>
    <tr style="height: 14px;">
      <td style="height: 14px; ">&nbsp;</td>
    </tr>
    <tr style="height: 50px;">
      <td style="height: 50px; font-family: 'Tahoma, sans-serif';font-size: 12;"><b>( REKENING INI MERUPAKAN PEMAKAIAN ENERGI LISTRIK DIBULAN SEBELUMNYA )</b></td>
    </tr>
  </tbody>
</table>

