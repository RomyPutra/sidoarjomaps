<script type="text/javascript">
  $(document).ready(function() {
    $('#docfile').on('change',function(){
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).siblings('.custom-file-label').html(fileName);
    });

    $('#signfile').on('change',function(){
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).siblings('.custom-file-label').html(fileName);
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

    const image = "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
    // const beachMarker = new google.maps.Marker({
    //   position: { lat: -33.89, lng: 151.274 },
    //   map,
    //   icon: image,
    // });

    // // fetch('<?php echo base_url('geojson/combined/new_indonesia_villages_border.geojson'); ?>')
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

    let tourStops = [];

    fetch('<?php echo base_url('ajaxmaps') ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      // console.log(data);
      // tourStops = data.map(item => ({
      //   position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng) },
      //   title: item.name
      // }));
      data.forEach(item => {
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

    // // Create the markers.
    // tourStops.forEach(({ position, title }, i) => {
    //   // const pin = new PinElement({
    //   //   glyph: `${i + 1}`,
    //   //   scale: 1.5,
    //   // });
    //   // [START maps_advanced_markers_accessibility_marker]
    //   const marker = new google.maps.Marker({
    //     position,
    //     map,
    //     title: `${i + 1}. ${title}`,
    //     // content: pin.element,
    //     gmpClickable: true,
    //     icon: image,
    //   });

    //   // [END maps_advanced_markers_accessibility_marker]
    //   // [START maps_advanced_markers_accessibility_event_listener]
    //   // Add a click listener for each marker, and set up the info window.
    //   marker.addListener("click", ({ domEvent, latLng }) => {
    //     const { target } = domEvent;
    //     var contentString = '<div class="col-md-7" style="text-align: left;">' +
    //       '<p>' + title + '</p>' +
    //       '<p>NAMAcoba</p>' +
    //       '<p>ALAMATcoba</p>' +
    //       '</div>';


    //     infoWindow.close();
    //     // infoWindow.setContent(marker.title);
    //     infoWindow.setContent(contentString);
    //     infoWindow.open(marker.map, marker);
    //   });
    //   // [END maps_advanced_markers_accessibility_event_listener]
    // });

  }

  window.initMap = initMap;

// function findBoundary() {
//   const request = {
//     query: "Trinidad, CA",
//     fields: ["id", "location"],
//     includedType: "locality",
//     locationBias: center,
//   };
//   const { Place } = await google.maps.importLibrary("places");
//   //@ts-ignore
//   const { places } = await Place.searchByText(request);

//   if (places.length) {
//     const place = places[0];

//     styleBoundary(place.id);
//     map.setCenter(place.location);
//   } else {
//     console.log("No results");
//   }
// }

// function styleBoundary(placeid) {
//   // Define a style of transparent purple with opaque stroke.
//   const styleFill = {
//     strokeColor: "#810FCB",
//     strokeOpacity: 1.0,
//     strokeWeight: 3.0,
//     fillColor: "#810FCB",
//     fillOpacity: 0.5,
//   };

//   // Define the feature style function.
//   featureLayer.style = (params) => {
//     if (params.feature.placeId == placeid) {
//       return styleFill;
//     }
//   };
// }

</script>
