<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Data</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Krub" rel="stylesheet">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/form.css">
</head>
<body>
    <nav class="navbar">
        <div class="title">
            <a href="/">Provinsi Bali</a>
        </div>
    </nav>

    <main class="content-wrapper covid">
        <div class="form-wrapper">
            <!-- <form action="/covid-19/{{ $covids->id_input }}" method="POST"> -->
            <!-- @csrf -->
            <!-- @method('PUT') -->
            <form action="/covid-19/{{ $covids->id_input }}" method="POST">
                    @csrf
                    @method('PUT')    
                    
                <div class="form-header">
                    <h3>Form Edit Data</h3>
                </div>
                
                <div class="form-body">
                    <div class="form-control">
                        <div class="form-label">
                            <label for="rawat">Dalam Perawatan</label>
                        </div>
                        <input type="number" class="input" name="rawat" value="{{ $covids->rawat }}" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="sembuh">Sembuh</label>
                        </div>
                        <input type="number" class="input" name="sembuh" value="{{ $covids->sembuh }}" />
                    </div>
                    <div class="form-control">
                        <div class="form-label">
                            <label for="meninggal">Meninggal</label>
                        </div>
                        <input type="number" class="input" name="meninggal" value="{{ $covids->meninggal }}" />
                    </div>
                </div>  
                
                <div class="form-footer">
                    <button type="submit" class="button">Submit</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>