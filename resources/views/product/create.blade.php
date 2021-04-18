<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel 8 Create Post With Unique Slug- Tutsmake.com</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        body {
            background-color: #25274d;
        }

        .container {
            background: #ff9b00;
            padding: 4%;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

    </style>
</head>

<body>
    <div class="container">

        <form action="{{ route('shop.store') }}" method="POST" name="add_post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Title</strong>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title">
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Description</strong>
                        <textarea class="form-control" col="4" name="description"
                            placeholder="Enter Description"></textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>image</strong>
                        <input class="form-control" col="4" type="file" name="file">
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>

    </div>
</body>

</html>
