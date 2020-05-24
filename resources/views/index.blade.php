<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Provinsi Bali</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Krub" rel="stylesheet">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/table.css">
    <link rel="stylesheet" href="/css/form.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- Leaflet (JS/CSS) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://pendataan.baliprov.go.id/assets/frontend/map/MarkerCluster.css" />
    <link rel="stylesheet" href="https://pendataan.baliprov.go.id/assets/frontend/map/MarkerCluster.Default.css" />
    <!-- Leaflet-KMZ -->
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- <style>
    html,
    body,
    #map {
        height: 400px;
        width: 100%;
        padding: 0;
        margin: 0;
    }
</style> -->
   
</head>

<body>
    <nav class="navbar">
        <div class="title">
            <a href="/">Provinsi Bali</a>
        </div>
        <form action="/covid-19" method="GET" class="button-wrapper">
            <button type="submit" class="button">
                <i class="fa"> Tambah Data </i>
            </button>
        </form>
    </nav>

    <main class="content-wrapper">
        <br/>
        <div class="table-wrapper">
            <br/>
            <h2 align="center"> Peta Penyebaran Covid-19 di Bali</h2>
            <br/>
            <div class="card">
                <h4 class="card-title" align="center">Cari Data</h4>
                <form action="/search" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggalSearch"  @if(isset($tanggal)) value="{{$tanggal}}" @endif>
                    </div>
                    <button type="submit" class="button">Cari</button>
            </div>

            <div class="maps" id="map"></div>

            <div class="card-footer" style="background: white">
              <div class="row">
                <div class="col-6">
                  Color Start
                  <input type="color" value="#E5000D" class="form-control" id="colorStart">
                </div>
                <div class="col-6">
                  Color End
                  <input type="color" value="#FFFFFF" class="form-control" id="colorEnd">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <button class="btn btn-primary form-control" id="btnGenerateColor">Generate Color</button>
                </div>
              </div>
            </div>
        </div>
        <br/>
        
        <div class="table-wrapper">
            <br/>
            <h2 align="center"> Data Covid-19 di Bali</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kabupaten</th>
                        <th>Positif</th>
                        <th>Dalam Perawatan</th>
                        <th>Sembuh</th>
                        <th>Meninggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($covids as $covid)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $covid->kabupaten }}</td>
                        <td>{{ $covid->positif }}</td>
                        <td>{{ $covid->rawat }}</td>
                        <td>{{ $covid->sembuh }}</td>
                        <td>{{ $covid->meninggal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://pendataan.baliprov.go.id/assets/frontend/map/leaflet.markercluster-src.js"></script>
    <script type="text/javascript" class="init">

        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

    <script>
        $(document).ready(function () {
            var dataMap=null;
            var dataPos=null;
            var colorMap=[
                "e5000d",
                "e71925",
                "ea333d",
                "ec4c55",
                "ef666d",
                "f27f68",
                "f4999e",
                "f7b2b6",
                "f9ccce"
            ];

            var tanggal = $('#tanggalSearch').val();
            console.log(tanggal);
            $.ajax({
                async:false,
                url:'data',
                type:'get',
                dataType:'json',
                covids:{date: tanggal},
                success: function(response){
                    dataMap = response;
                }
            });
            console.log(dataMap);
            
            $.ajax({
                async:false,
                url:'positif',
                type:'get',
                dataType:'json',
                covids:{date: tanggal},
                success: function(response){
                    dataPos = response;
                }
            });
            console.log(dataPos);

            $('#btnGenerateColor').on('click',function(e){
                var colorStart = $('#colorStart').val();
                var colorEnd = $('#colorEnd').val();
                $.ajax({
                    async:false,
                    url:'/create-pallete',
                    type:'get',
                    dataType:'json',
                    covids:{start: colorStart, end:colorEnd},
                    success: function(response){
                        colorMap = response;
                        setMapColor();
                    }
                });
            });

            var map = L.map('map');
            map.setView(new L.LatLng(-8.374187,115.172922), 10);

            var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                attribution: 'Map data: &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
                opacity: 0.90
            });

            OpenTopoMap.addTo(map);
            setMapColor();
            // define variables
            var lastLayer;
            var defStyle = {opacity:'1',color:'#000000',fillOpacity:'0',fillColor:'#CCCCCC'};
            var selStyle = {color:'#0000FF',opacity:'1',fillColor:'#00FF00',fillOpacity:'1'};

            function setMapColor(){
                var markerIcon = L.icon({
                    iconUrl: '/mar.png',
                    iconSize: [40, 40],
                });

                var BADUNG,BULELENG,BANGLI,DENPASAR,GIANYAR,JEMBRANA,KARANGASEM,KLUNGKUNG,TABANAN;
                dataPos.forEach(function(value,index){
                    var colorKab = dataPos[index].kabupaten.toUpperCase();
                    console.log(colorKab);
                    if(colorKab == "BADUNG"){
                      BADUNG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }else if(colorKab=="BANGLI"){
                      BANGLI = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    } else if(colorKab=="BULELENG"){
                      BULELENG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }else if(colorKab=="DENPASAR"){
                      DENPASAR = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }else if(colorKab=="GIANYAR"){
                      GIANYAR = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }else if(colorKab =="JEMBRANA"){
                      JEMBRANA = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }else if(colorKab=="KARANGASEM"){
                      KARANGASEM = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }else if(colorKab=="KLUNGKUNG"){
                      KLUNGKUNG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }else if(colorKab =="TABANAN"){
                      TABANAN = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
                    }

                });

                // Instantiate KMZ parser (async)
                var kmzParser = new L.KMZParser({
                    onKMZLoaded: function (layer, name) {
                        control.addOverlay(layer, name);
                        var markers = L.markerClusterGroup();
                        var layers = layer.getLayers()[0].getLayers();

                        // fetching sub layer
                        layers.forEach(function(layer, index){

                            var kab  = layer.feature.properties.NAME_2;
                            kab = kab.toUpperCase();
                            var prov = layer.feature.properties.NAME_1;

                            if(!Array.isArray(dataMap) || !dataMap.length == 0 ){
                            // set sub layer default style positif covid
                            if(kab == 'BADUNG'){
                              layer.setStyle(BADUNG);
                            }else if(kab == 'BANGLI'){
                              layer.setStyle(BANGLI);
                            }else if(kab == 'BULELENG'){
                              layer.setStyle(BULELENG);
                            }else if(kab == 'DENPASAR'){
                              layer.setStyle(DENPASAR);
                            }else if(kab == 'GIANYAR'){
                              layer.setStyle(GIANYAR);
                            }else if(kab == 'JEMBRANA'){
                              layer.setStyle(JEMBRANA);
                            }else if(kab == 'KARANGASEM'){
                              layer.setStyle(KARANGASEM);
                            }else if(kab == 'KLUNGKUNG'){
                              layer.setStyle(KLUNGKUNG);
                            }else if(kab == 'TABANAN'){
                              layer.setStyle(TABANAN);
                            } 

                            // peparing data format
                            var covids = '<table width="300">';
                            covids +='  <tr>';
                            covids +='    <th colspan="2">Keterangan</th>';
                            covids +='  </tr>';


                            covids +='  <tr>';
                            covids +='    <td>Kabupaten</td>';
                            covids +='    <td>: '+kab+'</td>';
                            covids +='  </tr>';              

              
                            // covids +='  <tr style="color:red">';
                            // covids +='    <td>Positif</td>';
                            // covids +='    <td>: '+dataMap[index].positif+'</td>';
                            // covids +='  </tr>';


                            // covids +='  <tr style="color:blue">';
                            // covids +='    <td>Dalam Perawatan</td>';
                            // covids +='    <td>: '+dataMap[index].rawat+'</td>';
                            // covids +='  </tr>';
                            

                            // covids +='  <tr style="color:green">';
                            // covids +='    <td>Sembuh</td>';
                            // covids +='    <td>: '+dataMap[index].sembuh+'</td>';
                            // covids +='  </tr>'; 


                            // covids +='  <tr style="color:black">';
                            // covids +='    <td>Meninggal</td>';
                            // covids +='    <td>: '+dataMap[index].meninggal+'</td>';
                            // covids +='  </tr>';

          
                            covids +='</table>';
    
                            if(kab == 'BANGLI'){
                              markers.addLayer( 
                                L.marker([-8.254251, 115.366936] ,{
                                  icon: markerIcon
                                }).bindPopup(covids).addTo(map)
                              );
                            }
                            else if(kab == 'GIANYAR'){
                              markers.addLayer( 
                                L.marker([-8.422739, 115.255700] ,{
                                  icon: markerIcon
                                }).bindPopup(covids).addTo(map)
                              );

                            }else if(kab == 'KLUNGKUNG'){
                              markers.addLayer( 
                                L.marker([-8.487338, 115.380029] ,{
                                  icon: markerIcon
                                }).bindPopup(covids).addTo(map)
                            );

                            }else{
                              markers.addLayer( 
                                L.marker(layer.getBounds().getCenter(),{
                                  icon: markerIcon
                                }).bindPopup(covids).addTo(map)
                              );
                            }

                            }else{
                              var covids = "Tidak ada Data pada tanggal tersebut"
                              layer.setStyle(defStyle);
                            }
                            layer.bindPopup(covids);
                        });
                        map.addLayer(markers);
                        layer.addTo(map);
                        }
                    });
  
    // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
                    kmzParser.load('kabupaten-bali.kmz');
    // kmzParser.load('https://raruto.github.io/leaflet-kmz/examples/globe.kmz');

                    var control = L.control.layers(null, null, {
                        collapsed: false
                    }).addTo(map);
                    $('.leaflet-control-layers').hide();
            }
        });
</script>
</body>
</html>