function initMap(long, lat, zoom) {
  map = new OpenLayers.Map('basicMap');
  originalOSM = new OpenLayers.Layer.OSM("OpenStreetMap");
  map.addLayers([originalOSM]);
  map.setCenter(new OpenLayers.LonLat(174.7633315,-36.8484597).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()), 4);
  var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
  var feature = new OpenLayers.Feature.Vector(
                      new OpenLayers.Geometry.Point(174.7633315,-36.8484597),
                      {some:'data'},
                      {graphicHeight: 21, graphicWidth: 16}
                    );
  vectorLayer.addFeatures(feature);
  map.addLayer(vectorLayer);
}
