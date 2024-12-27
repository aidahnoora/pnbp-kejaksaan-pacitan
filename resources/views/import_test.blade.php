<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test dulu</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Datepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

</head>

<body>
    <h1>import lampiran ba denda kn pacitan</h1>
    <form action="{{ url('import-ba-denda') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="bulan">Bulan:</label>
        <select name="bulan" required>
            <option value="Januari">Januari</option>
            <option value="Februari">Februari</option>
            <option value="Maret">Maret</option>
            <option value="April">April</option>
            <option value="Mei">Mei</option>
            <option value="Juni">Juni</option>
            <option value="Juli">Juli</option>
            <option value="Agustus">Agustus</option>
            <option value="September">September</option>
            <option value="Oktober">Oktober</option>
            <option value="November">November</option>
            <option value="Desember">Desember</option>
        </select>

        <label for="tahun">Tahun</label>
        <input type="text" name="tahun" id="tahun" placeholder="Pilih Tahun" required>

        <label for="file">File:</label>
        <input type="file" name="file" accept=".xlsx" required>

        <button type="submit">Import</button>
    </form>
    <div class="container">
        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</body>

<!-- jQuery dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tahun').datepicker({
            format: "yyyy", // Format hanya tahun
            viewMode: "years", // Mode tampilan tahun
            minViewMode: "years" // Hanya menampilkan tahun
        });
    });
</script>

</html>
