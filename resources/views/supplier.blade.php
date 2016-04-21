<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

</head>
<body>

<h1>Supplier</h1>
<form method="post" action="/supplier">
    {{csrf_field()}}
    <div class="form-group">
        <label>name</label>
        <input type="text" name="name" class="form-control"  placeholder="name">
    </div>

    <div class="form-group">
        <label>Address</label>
        <textarea class="form-control" name="address"></textarea>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>

@foreach($suppliers as $supplier)
    <article>
        <h1>{{$supplier->name}}</h1>
        <pre>{{$supplier->address}}</pre>
    </article>
@endforeach

</body>
</html>
