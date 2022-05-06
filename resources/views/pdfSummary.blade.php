<!DOCTYPE html>
<html>
<h1>
    Some info
</h1>

<head>
    <title>{{ $fileName }} </title>
</head>

<body>
    <h1>{{ $name }}</h1>
    <p>{{ $date }}</p>


    <table>
        <thead>
            <tr>
                <th></th>
                {!! $scennarios !!}
            </tr>
            <tr>
                <th><b>Maritial status</b></th>
                {{!! $maritialSituations !!}}
            </tr>
            <tr>
                <th>Totals</th>
            </tr>
        </thead>

        <tbody>
             {!! $factors !!}
        </tbody>
    </table>

</body>

<style>
    table,
    th,
    td {
        border: 1px solid;
    }

</style>

</html>
