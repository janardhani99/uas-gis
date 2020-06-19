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
    <!-- <style> html, body, #map { height: 100%; width: 100%; padding: 0; margin: 0; } </style> -->
    <!-- Leaflet (JS/CSS) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
    <!-- Leaflet-KMZ -->
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
</head>

<body>
	<nav class="navbar">
		<div class="title">
			<a href="/">Provinsi Bali</a>
		</div>
	</nav>
 	
 	<main class="content-wrapper">
    </br>
        <div class="table-wrapper">
        <br/>
        <h2 align="center"> Data Kasus Covid-19 di {{$covids[0]['kelurahan']}} </h2>
        </br>
        	<table class="table">
        		<thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kabupaten</th>
                        <th rowspan="2">Kecamatan</th>
                        <th rowspan="2">Level</th>
                        <th colspan="4">Penyebaran</th>
                        <th colspan="4">Kondisi</th>
                        <th rowspan="2">Detail</th>
                    </tr>
                    <tr>
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
                            <td>{{ $covid->level }}</td>
                            <td>{{ $covid->ppln }}</td>
                            <td>{{ $covid->ppdn }}</td>
                            <td>{{ $covid->tl }}</td>
                            <td>{{ $covid->lainnya }}</td>
                            <td>{{ $covid->positif }}</td>
                            <td>{{ $covid->rawat }}</td>
                            <td>{{ $covid->sembuh }}</td>
                            <td>{{ $covid->meninggal }}</td>
                            <th colspan="2">
                                <form action="/covid-19/{{$covid->id_input}}/edit" method="GET">
                                    <button type="submit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </form>
                                <form action="/covid-19/{{$covid->id_input}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </th>
                            <!-- <td>
                                
                            </td> -->
                        </tr>
                    @endforeach
                </tbody>
        	</table>
		</div>
    </main>
</body>
</html>
