<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="vh-100 d-flex justify-content-center align-items-center">

    <div class="container d-flex flex-column align-items-center">

        <div class="card shadow-sm p-4">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="mb-3">Upload PDF File</h1>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-12">

                        <label class="d-block" for="file">Select PDF File</label>
                        <input type="file" id="file" name="file" />
                        @error('file')
                            <p class="text-danger">{{ $message }}
                            <p>
                            @enderror



                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>



        </div>


    </div>

</body>

</html>
