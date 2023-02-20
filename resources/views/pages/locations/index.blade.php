@extends('layouts.app')
{{-- page title --}}
@section('title','Uid')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/leaflet/leaflet.css')}}">
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

<style>
  .leaflet-container {
    height: 500px;
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
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
@endsection

@section('page-scripts')
<script>
  const cities = L.layerGroup();

  const mLittleton = L.marker([-6.1742594,106.82156]).bindPopup('This is Littleton, CO.').addTo(cities);
  const mDenver = L.marker([-6.1746338,106.8170099]).bindPopup('This is Denver, CO.').addTo(cities);
  const mAurora = L.marker([-6.1722241,106.818969]).bindPopup('This is Aurora, CO.').addTo(cities);
  const mGolden = L.marker([-6.1712807,106.821249]).bindPopup('This is Golden, CO.').addTo(cities);

  const mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
  const mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

  const streets = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

  const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  });

  const map = L.map('map', {
    zoom: 10,
    layers: [streets, cities]
  });

  const bounds = L.latLngBounds([-6.1742594,106.82156], [-6.1746338,106.8170099], [-6.1722241,106.818969], [-6.1712807,106.821249]);
  map.fitBounds([[-6.1742594,106.82156], [-6.1746338,106.8170099], [-6.1722241,106.818969], [-6.1712807,106.821249]]);

  const baseLayers = {
    'OpenStreetMap': osm,
    'Streets': streets
  };

  const overlays = {
    'Cities': cities
  };

  const satellite = L.tileLayer(mbUrl, {id: 'mapbox/satellite-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

  L.control.layers(baseLayers, overlays)
    .addTo(map)
    .addBaseLayer(satellite, 'Satellite');

  L.Routing.control({
    waypoints: [
      L.latLng(-6.1742594,106.82156),
      L.latLng(-6.1746338,106.8170099),
      L.latLng(-6.1722241,106.818969),
      L.latLng(-6.1712807,106.821249),
    ]
  }).addTo(map);
</script>
@endsection