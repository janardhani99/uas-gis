<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Krub" rel="stylesheet">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="/css/table.css">
</head>
<body>
    <nav class="navbar">
        <div class="title">
            <a href="/">Provinsi Bali</a>
        </div>
    </nav>

    <main class="content-wrapper covid">
        <div class="form-wrapper">
            <form action="/covid-19" method="POST" class="form">
                @csrf
                <div class="form-body">
                    <h2 align="center">Tambah Data</h2>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="exampleFormControlSelect1">Kabupaten</label>
                        </div>
                        <select name="kabupaten" class="select">
                            <option value="">Pilih</option>
                            @foreach ($kabupaten as $kab)
                                <option value="{{$kab->id_kabupaten}}">{{$kab->kabupaten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="exampleFormControlSelect1">Kecamatan</label>
                        </div>
                        <select name="kecamatan" class="select">
                            <option value="">Pilih</option>
                            @foreach ($kecamatan as $kec)
                                <option value="{{$kec->id_kecamatan}}">{{$kec->kecamatan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="exampleFormControlSelect1">Kelurahan</label>
                        </div>
                        <select name="kelurahan" class="select">
                            <option value="">Pilih</option>
                            @foreach ($kelurahan as $kel)
                                <option value="{{$kel->id_kelurahan}}">{{$kel->kelurahan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="exampleFormControlInput1">Tanggal</label>
                        </div>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="level">Level</label>
                        </div>
                        <input type="number" class="input" name="level" id="level" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="pp-ln">PP-LN</label>
                        </div>
                        <input type="number" class="input" name="ppln" id="ppln" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="pp-dn">PP-DN</label>
                        </div>
                        <input type="number" class="input" name="ppdn" id="ppdn" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="tl">TL</label>
                        </div>
                        <input type="number" class="input" name="tl" id="tl" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="lainnya">Lainnya</label>
                        </div>
                        <input type="number" class="input" name="lainnya" id="lainnya" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="rawat">Dalam Perawatan</label>
                        </div>
                        <input type="number" class="input" name="rawat" id="rawat" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label>Sembuh</label>
                        </div>
                        <input type="number" class="input" name="sembuh" id="sembuh" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label>Meninggal</label>
                        </div>
                        <input type="number" class="input" name="meninggal" id="meninggal" />
                    </div>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="button">Submit</button>
                </div>
            </form>
        </div>
        <br/>
        <div class="table-wrapper">
            <br/>
        <h2 align="center"> Data Covid-19 di Bali</h2>
        </br>

            <table class="table">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kabupaten</th>
                        <th rowspan="2">Kecamatan</th>
                        <th rowspan="2">Kelurahan</th>
                        <th rowspan="2">Level</th>
                        <th colspan="5">Penyebaran</th>
                        <th colspan="5">Kondisi</th>
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
                        <th>Detail</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($test as $covid)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
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
                            <td>
                                <form action="/covid-19/{{$covid->id_kabupaten}}" method="GET">
                                    <button type="submit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
    </main>
</body>
</html>