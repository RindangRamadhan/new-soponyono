@extends('layouts.app')
{{-- page title --}}
@section('title','Uid')

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
  const data = [
    {
      lat: -6.1746338,
      long: 106.8170099,
      customer: 'Doni'
    },
    {
      lat: -6.1722241,
      long: 106.818969,
      customer: 'Dona'
    },
    {
      lat: -6.1712807,
      long: 106.821249,
      customer: 'Dani'
    },
    {
      lat: -6.1713807,
      long: 106.831249,
      customer: 'Dina'
    },
  ];

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
    layers: [streets]
  });


  const layers = {
    'Streets': streets,
    'OpenStreetMap': osm,
    'Satellite': satellite,
  };

  L.control.layers(layers)
    .addTo(map)

  L.Routing.control({
    waypoints: data.map(el => L.latLng(el.lat,el.long)),
    createMarker: (i, wp, n) => L.marker(wp.latLng).bindPopup(`Pelanggan ${data[i].customer}`)
  }).addTo(map);
</script>
@endsection