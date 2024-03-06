<div className="map-wrap">
  <MapContainer center={[27.672738, 85.345685]} zoom={13}>
    <TileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
    <Marker position={[27.672738, 85.345685]}>
      <Popup>Gagan lives here, come over for a cup of coffee :)</Popup>
    </Marker>
  </MapContainer>
</div>