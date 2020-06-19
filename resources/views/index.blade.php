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

            <!-- <div class="card-footer" style="background: white">
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
            </div> -->
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
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Level</th>
                        <th>PP-LN</th>
                        <th>PP-DN</th>
                        <th>TL</th>
                        <th>Lainnya</th>
                        <th>Positif</th>
                        <th>Dirawat</th>
                        <th>Sembuh</th>
                        <th>Meninggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($covids as $covid)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $covid->kabupaten }}</td>
                        <td>{{ $covid->kecamatan }}</td>
                        <td>{{ $covid->kelurahan }}</td>
                        <td>{{ $covid->level }}</td>
                        <td>{{ $covid->ppln }}</td>
                        <td>{{ $covid->ppdn }}</td>
                        <td>{{ $covid->tl }}</td>
                        <td>{{ $covid->lainnya }}</td>
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

            var tanggal = $('#tanggalSearch').val();
            console.log(tanggal);
            $.ajax({
                async:false,
                url:'getData',
                type:'get',
                dataType:'json',
                covids:{date: tanggal},
                success: function(response){
                    dataMap = response;
                }
            });

            var map = L.map('map');
            map.setView(new L.LatLng(-8.374187,115.172922), 10);

            var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                attribution: 'Map data: &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
                opacity: 0.90
            });

            OpenTopoMap.addTo(map);
            var defStyle = {opacity:'1',color:'#000000',fillOpacity:'0',fillColor:'#CCCCCC'};
            setMapColor();
    
            function setMapColor(){
                var markerIcon = L.icon({
                    iconUrl: 'mar.png',
                    iconSize: [40, 40],
                });

                // Instantiate KMZ parser (async)
                var kmzParser = new L.KMZParser({
                    onKMZLoaded: function (kmz_layer, name) {
                        control.addOverlay(kmz_layer,name);
                        var markers = L.markerClusterGroup();
                        var layers = kmz_layer.getLayers()[0].getLayers();
                        console.log(layers[0]);
                        // fetching sub layer
                        layers.forEach(function(layer, index){          
                            var kab  = layer.feature.properties.NAME_2;
                            var kec =  layer.feature.properties.NAME_3;
                            var kel = layer.feature.properties.NAME_4;
                            var covids;

                            var STYLE = {opacity:'1',color:'#000',fillOpacity:'1'};
                            var HIJAU_MUDA = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#81F781'};
                            var HIJAU_TUA = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#088A08'};
                            var KUNING = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#FFFF00'};
                            var MERAH_MUDA = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#F78181'};
                            var MERAH_TUA = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#B40404'};
          
          //
                            if(!Array.isArray(dataMap) || !dataMap.length == 0 ){
                                var searchResult = dataMap.filter(function(it){
                                    return it.kecamatan.replace(/\s/g,'').toLowerCase() === kec.replace(/\s/g,'').toLowerCase() &&
                                    it.kelurahan.replace(/\s/g,'').toLowerCase() === kel.replace(/\s/g,'').toLowerCase();
                                });

                                if(!Array.isArray(searchResult) || !searchResult.length ==0){
                                    var item = searchResult[0];
                                    if(item.positif == 0 ){
                                        layer.setStyle(HIJAU_MUDA);  
                                    }else if(item.rawat == 0 && item.positif>0 && item.sembuh >= 0 && item.meninggal >=0){
                                        layer.setStyle(HIJAU_TUA);
                                    }else if(item.ppln ==1 && item.rawat == 1 && item.positif == 1 && item.tl==0 || item.ppdn ==1 && item.rawat == 1&& item.positif == 1 && item.tl==0){
                                        layer.setStyle(KUNING);
                                    }else if((item.ppln >1 && item.rawat <= item.ppln && item.sembuh <= item.ppln && item.tl == 0) || (item.ppdn >1 && item.rawat<= item.ppdn && item.sembuh <= item.ppdn && item.tl == 0)  ){
                                        layer.setStyle(MERAH_MUDA);
                                    }else{
                                        layer.setStyle(MERAH_TUA);
                                    }

                                // set sub layer default style positif covid
                                // if(kab == 'BADUNG'){
                                //     layer.setStyle(BADUNG);
                                // }else if(kab == 'BANGLI'){
                                //     layer.setStyle(BANGLI);
                                // }else if(kab == 'BULELENG'){
                                //     layer.setStyle(BULELENG);
                                // }else if(kab == 'DENPASAR'){
                                //     layer.setStyle(DENPASAR);
                                // }else if(kab == 'GIANYAR'){
                                //     layer.setStyle(GIANYAR);
                                // }else if(kab == 'JEMBRANA'){
                                //     layer.setStyle(JEMBRANA);
                                // }else if(kab == 'KARANGASEM'){
                                //     layer.setStyle(KARANGASEM);
                                // }else if(kab == 'KLUNGKUNG'){
                                //     layer.setStyle(KLUNGKUNG);
                                // }else if(kab == 'TABANAN'){
                                //     layer.setStyle(TABANAN);
                                // } 


                                // peparing data format
                                covids = '<table width="300">';
                                covids +='  <tr>';
                                covids +='    <th colspan="2">Keterangan</th>';
                                covids +='  </tr>';
              
              
                                covids +='  <tr>';
                                covids +='    <td>Kabupaten</td>';
                                covids +='    <td>: '+kab+'</td>';
                                covids +='  </tr>';


                                covids +='  <tr>';
                                covids +='    <td>Kecamatan</td>';
                                covids +='    <td>: '+kec+'</td>';
                                covids +='  </tr>';


                                covids +='  <tr>';
                                covids +='    <td>Kelurahan</td>';
                                covids +='    <td>: '+kel+'</td>';
                                covids +='  </tr>'; 


                                covids +='  <tr>';
                                covids +='    <td>Level</td>';
                                covids +='    <td>: '+item.level+'</td>';
                                covids +='  </tr>';             

              
                                covids +='  <tr style="color:red">';
                                covids +='    <td>Positif</td>';
                                covids +='    <td>: '+item.positif+'</td>';
                                covids +='  </tr>';
              

                                covids +='  <tr style="color:green">';
                                covids +='    <td>Sembuh</td>';
                                covids +='    <td>: '+item.sembuh+'</td>';
                                covids +='  </tr>'; 

                                covids +='  <tr style="color:black">';
                                covids +='    <td>Meninggal</td>';
                                covids +='    <td>: '+item.meninggal+'</td>';
                                covids +='  </tr>';

                  
                                covids +='  <tr style="color:blue">';
                                covids +='    <td>Dalam Perawatan</td>';
                                covids +='    <td>: '+item.rawat+'</td>';
                                covids +='  </tr>';               
              
              
                            //     covids +='</table>';
    
                            //     if(kab == 'BANGLI'){
                            //         markers.addLayer( 
                            //             L.marker([-8.254251, 115.366936] ,{
                            //                 icon: markerIcon
                            //             }).bindPopup(covids).addTo(map)
                            //         );
                            //     }
                            //     else if(kab == 'GIANYAR'){
                            //         markers.addLayer( 
                            //             L.marker([-8.422739, 115.255700] ,{
                            //                 icon: markerIcon
                            //             }).bindPopup(covids).addTo(map)
                            //         );

                            //     }else if(kab == 'KLUNGKUNG'){
                            //         markers.addLayer( 
                            //             L.marker([-8.487338, 115.380029] ,{
                            //                 icon: markerIcon
                            //             }).bindPopup(covids).addTo(map)
                            //         );

                            //     }else{
                            //         markers.addLayer( 
                            //             L.marker(layer.getBounds().getCenter(),{
                            //                 icon: markerIcon
                            //             }).bindPopup(covids).addTo(map)
                            //         );
                            //     }

                            // }else{
                            //     var covids = "Tidak ada Data pada tanggal tersebut"
                            //     layer.setStyle(defStyle);
                            // }

                                }else{
                                    console.log(kel.replace(/\s/g,'').toLowerCase());
                                    console.log(kec.replace(/\s/g,'').toLowerCase());
                                    covids = '<table width="300">';
                                    covids +='  <tr>';
                                    covids +='    <th colspan="2">Keterangan</th>';
                                    covids +='  </tr>';
                                    
                                    covids +='  <tr>';
                                    covids +='    <td>Kabupaten</td>';
                                    covids +='    <td>: '+kab+'</td>';
                                    covids +='  </tr>';              
                      
                                    covids +='  <tr style="color:red">';
                                    covids +='    <td>Kecamatan</td>';
                                    covids +='    <td>: '+kec+'</td>';
                                    covids +='  </tr>';

                                    covids +='  <tr style="color:red">';
                                    covids +='    <td>Kelurahan</td>';
                                    covids +='    <td>: '+kel+'</td>';
                                    covids +='  </tr>';

                                    covids +='  <tr style="color:red">';
                                    covids +='    <td>Tidak ada data pada tanggal ini</td>';
                                    covids +='  </tr>';
                                }

                            }else{
                                covids = '<table width="300">';
                                covids +='  <tr>';
                                covids +='    <th colspan="2">Keterangan</th>';
                                covids +='  </tr>';
                                
                                covids +='  <tr>';
                                covids +='    <td>Kabupaten</td>';
                                covids +='    <td>: '+kab+'</td>';
                                covids +='  </tr>';              
                  
                                covids +='  <tr style="color:black">';
                                covids +='    <td>Kecamatan</td>';
                                covids +='    <td>: '+kec+'</td>';
                                covids +='  </tr>';

                                covids +='  <tr style="color:black">';
                                covids +='    <td>Kelurahan</td>';
                                covids +='    <td>: '+kel+'</td>';
                                covids +='  </tr>';

                                covids +='  <tr style="color:black">';
                                covids +='    <td>Tidak ada data</td>';
                                covids +='  </tr>';
                            layer.setStyle(defStyle);
                            }

                            layer.bindPopup(covids);
                            markers.addLayer( 
                                L.marker(layer.getBounds().getCenter(),{
                                    icon: markerIcon
                                }).bindPopup(covids)
                            );
                        });
                        
                        map.addLayer(markers);
                        kmz_layer.addTo(map);
                    }
                });
  
                // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
                kmzParser.load('bali-kelurahan.kmz');
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