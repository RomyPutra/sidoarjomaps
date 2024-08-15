<script type="text/javascript">
  $(document).ready(function() {
    $('#kategori').on('change',function(){
      $.ajax({
        url: "<?php echo base_url('mapskategori/') ?>"+$(this).val(),
        type: "POST",
        "data": {
            csrf_faukes: $('input[name=csrf_faukes]').val(),  //ambil nilai csrf sesuai nama token input dari .env (wajib)
        },
        "data": function(data) {
            data.csrf_faukes = $('input[name=csrf_faukes]').val() //function bridge token view to controller (wajib)
        },
        success: function (response) {
          var data = $.parseJSON(response);
          $('input[name=csrf_faukes]').val(data.csrf_faukes); //dataSrc untuk random request token char (wajib)
          // console.log(data);
    
          const mapElement = document.getElementById('map');
          let center = new google.maps.LatLng(-7.4547306, 112.6059371); // Default center
          let zoom = 12; // Default zoom level

          // Check for stored map state
          const storedMapState = localStorage.getItem('mapState');
          if (storedMapState) {
            const parsedState = JSON.parse(storedMapState);
            center = new google.maps.LatLng(parsedState.lat, parsedState.lng);
            zoom = parsedState.zoom;
          }

          const map = new google.maps.Map(mapElement, {
            zoom: zoom,
            center: center
          });

          map.data.setStyle(function(feature) {
              return /** @type {google.maps.Data.StyleOptions} */({
                  fillColor: 'red',
                  strokeColor: 'white',
                  strokeWeight: 2
              });
          });

          fetch('<?php echo base_url('geojson/combined/sidoarjo_kecamatan.geojson'); ?>')
            .then(response => response.json())
            .then(data => {
              // Use the GeoJSON data with Google Maps API
              const geojsonLayer = new google.maps.Data();
              geojsonLayer.addGeoJson(data);
              geojsonLayer.setMap(map); // Assuming 'map' is your Google Maps object
            })
            .catch(error => {
              console.log('Error fetching GeoJSON:', error);
            });

          // Create an info window to share between markers.
          const infoWindow = new google.maps.InfoWindow();

          data.data.forEach(item => {
            const marker = new google.maps.Marker({
              position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng) },
              map,
              title: `${item.name}`,
              gmpClickable: true,
              icon: isNullOrEmpty(item.images) ? "<?php echo base_url('public/pin/default.png')?>" : "<?php echo base_url('public/pin/')?>"+item.images,
            });

            let images = isNullOrEmpty(item.gambar) ? "<?php echo base_url('public/imgmain/no-image.png')?>" : "<?php echo base_url('public/imgmain/')?>"+item.gambar;
            marker.addListener("click", ({ domEvent, latLng }) => {
              const { target } = domEvent;
              const infoWindowContent = document.createElement('div');
              infoWindowContent.innerHTML = `
                <h3>${item.name}</h3>  <div class="row">
                  <div class="col-md-4">
                    <img src="${images}" alt="${item.name}" style="width: 150px; height: 150px;margin-right:15px;">
                  </div>
                  <div class="col-md-8">
                    <p>Contact Person: ${item.namacp} / ${item.nomorcp}</p>
                    <p>${item.alamat}</p>
                    <p>${item.lokasi}</p>
                    <p>${truncateString(item.profile, 50)}</p>
                    <a href="<?php echo base_url('home/detail/')?>${item.kode}" class="btn btn-primary">Lihat Lebih</a>
                  </div>
                </div>
              `;

              infoWindow.close();
              // infoWindow.setTitle(item.kategori);
              infoWindow.setContent(infoWindowContent);
              infoWindow.open(marker.map, marker);
            });
            // Store map state on moveend event
            map.addListener('center_changed', () => {
              const newCenter = map.getCenter();
              const newZoom = map.getZoom();
              localStorage.setItem('mapState', JSON.stringify({ lat: newCenter.lat(), lng: newCenter.lng(), zoom: newZoom }));
            });

          });
    
        }
      });
    });

  });

  function initMap() {
    var LatLng = { lat: -7.4547306, lng: 112.6059371 };
    var zoomed = 12;

    const map = new google.maps.Map(document.getElementById("map"), {
      // zoom: 12,
      // center: { lat: 34.84555, lng: -111.8035 },
      zoom: zoomed,
      center: LatLng,
    });

    map.data.setStyle(function(feature) {
        return /** @type {google.maps.Data.StyleOptions} */({
            fillColor: 'red',
            strokeColor: 'white',
            strokeWeight: 2
        });
    });

    fetch('<?php echo base_url('geojson/combined/sidoarjo_kecamatan.geojson'); ?>')
      .then(response => response.json())
      .then(data => {
        // Use the GeoJSON data with Google Maps API
        const geojsonLayer = new google.maps.Data();
        geojsonLayer.addGeoJson(data);
        geojsonLayer.setMap(map); // Assuming 'map' is your Google Maps object
      })
      .catch(error => {
        console.log('Error fetching GeoJSON:', error);
      });

    // Create an info window to share between markers.
    const infoWindow = new google.maps.InfoWindow();

    fetch('<?php echo base_url('ajaxmapskat') ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      data: {
          csrf_faukes: $('input[name=csrf_faukes]').val(),  //ambil nilai csrf sesuai nama token input dari .env (wajib)
      },
    })
    .then(response => response.json())
    .then(data => {
      $('input[name=csrf_faukes]').val(data.csrf_faukes); //dataSrc untuk random request token char (wajib)
      // console.log(data.data);
      // tourStops = data.map(item => ({
      //   position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng) },
      //   title: item.name
      // }));
      data.data.forEach(item => {
        const marker = new google.maps.Marker({
          position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng) },
          map,
          title: `${item.name}`,
          // content: pin.element,
          gmpClickable: true,
          icon: isNullOrEmpty(item.images) ? "<?php echo base_url('public/pin/default.png')?>" : "<?php echo base_url('public/pin/')?>"+item.images,
        });

        let images = isNullOrEmpty(item.gambar) ? "<?php echo base_url('public/imgmain/no-image.png')?>" : "<?php echo base_url('public/imgmain/')?>"+item.gambar;
        // [END maps_advanced_markers_accessibility_marker]
        // [START maps_advanced_markers_accessibility_event_listener]
        // Add a click listener for each marker, and set up the info window.
        marker.addListener("click", ({ domEvent, latLng }) => {
          const { target } = domEvent;
          const infoWindowContent = document.createElement('div');
          infoWindowContent.innerHTML = `
            <h3>${item.name}</h3>  <div class="row">
              <div class="col-md-4">
                <img src="${images}" alt="${item.name}" style="width: 150px; height: 150px;margin-right:15px;">
              </div>
              <div class="col-md-8">
                <p>Contact Person: ${item.namacp} / ${item.nomorcp}</p>
                <p>${item.alamat}</p>
                <p>${item.lokasi}</p>
                <p>${truncateString(item.profile, 50)}</p>
                <a href="<?php echo base_url('home/detail/')?>${item.kode}" class="btn btn-primary">Lihat Lebih</a>
              </div>
            </div>
          `;

          infoWindow.close();
          // infoWindow.setTitle(item.kategori);
          infoWindow.setContent(infoWindowContent);
          infoWindow.open(marker.map, marker);
        });
      });
      // console.log(tourStops);
    })
    .catch(error => {
      console.log('Error:', error);
    });

    // Store map state on moveend event
    map.addListener('center_changed', () => {
      const newCenter = map.getCenter();
      const newZoom = map.getZoom();
      localStorage.setItem('mapState', JSON.stringify({ lat: newCenter.lat(), lng: newCenter.lng(), zoom: newZoom }));
    });

  }

  window.initMap = initMap;

</script>
