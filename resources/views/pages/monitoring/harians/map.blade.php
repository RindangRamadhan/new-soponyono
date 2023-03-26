@extends('layouts.app')
{{-- page title --}}
@section('title','Monitoring Lokasi')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/leaflet/leaflet.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/leaflet/leaflet-routing-machine.css')}}">

<style>
  .leaflet-container {
    height: 650px;
    width: 2000px;
    max-width: 100%;
    max-height: 100%;
  }

  .leaflet-routing-container {
    display: none;
  }

</style>
@endsection

@section('content')
<!-- Uid start -->
<section id="basic-datatable">
  <div class="card">
    <div class="card-content">
      <div class="card-body card-dashboard">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Nama Petugas</label>
              <div class="controls form-label-group position-relative ">
                <input type="text" class="form-control " value="{{ $user->officer_name }}" readonly>

              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>RBM</label>
              <div class="controls form-label-group position-relative ">
                <input type="text" class="form-control " value="{{ $user->rbm_code }}" readonly>
              </div>
            </div>
          </div>
        </div>

        <div id="map"></div>
      </div>
    </div>
  </div>

</section>
<!-- Uid ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/leaflet/leaflet.js')}}"></script>
<script src="{{asset('vendors/js/leaflet/leaflet-routing-machine.js')}}"></script>
@endsection

@section('page-scripts')
<script>
  const data = @php echo json_encode($orders) @endphp;;

  const map_attr = `
    Map data &copy; 
    <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> 
    contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>
  `;

  const map_url = "{{ env('MAP_URL') }}";
  const map_url_osm = "{{ env('MAP_URL_OSM') }}";

  const streets = L.tileLayer(map_url, {id: 'mapbox/streets-v11',  tileSize: 512,  zoomOffset: -1,  attribution: map_attr});
  const satellite = L.tileLayer(map_url, {id: 'mapbox/satellite-v9', tileSize: 512, zoomOffset: -1, attribution: map_attr});
  const osm = L.tileLayer(map_url_osm, {attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'});

  const map = L.map('map', {
    zoom: 10,
    layers: [osm]
  });


  const layers = {
    'Streets': streets,
    'OpenStreetMap': osm,
    'Satellite': satellite,
  };

  L.control.layers(layers)
    .addTo(map)

  L.Routing.control({
    waypoints: data.filter(el => el.latitude != null && el.longitude != null).map(el => L.latLng(el.latitude,el.longitude)),
    createMarker: (i, wp, n) => L.marker(wp.latLng).bindPopup(`Pelanggan ${data[i].customer_name}`)
  }).addTo(map);
</script>
@endsection