<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $fileName }} </title>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ public_path('images/cropped_ger_logo.png') }}" width="40px">
            <img src="{{ public_path('images/ger_logo.png') }}" width="160px">
            {{-- <img src="logo.png"> --}}
        </div>
        <h1>Express entry</h1>

        <div id="company" class="clearfix">
            <div>{{ $date }}</div>
        </div>
        <div id="project">
            <div><span>Name</span>{{ $name }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th></th>
                    {!! $scennarios !!}
                </tr>
                <tr>
                    <th><b>Maritial status</b></th>
                    {!! $maritialSituations !!}
                </tr>
            </thead>
            <tbody>
                {!! $factors !!}
                <tr>
                    <th>Totals</th>
                    {!! $totals !!}
                </tr>

            </tbody>
        </table>
        {{-- <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div> --}}
    </main>
    <footer>
        Contact
        <div class="company">
            778-300-4898
        </div>
        <div class="project">
            info@gercanada.com
        </div>
        {{-- Invoice was created on a computer and is valid without the signature and seal. --}}
    </footer>
</body>

<style scoped>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    .num-val {
        text-align: right;
        padding: 5px 20px;
    }

    body {
        position: relative;
        width: 100%;
        height: auto;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        /* font-size: 12px; */
        font-family: Arial;
    }

    header {
        padding: 10px 0;
        margin-bottom: 30px;
    }

    #logo {
        text-align: right;
        margin-bottom: 10px;
    }


    h1 {
        border-top: 1px solid #5D6975;
        border-bottom: 1px solid #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
    }

    #project {
        float: left;
    }

    #project span {
        color: black;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
    }

    #company {
        float: right;
        text-align: right;
    }

    #project div,
    #company div {
        white-space: nowrap;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;

    }

    table tr:nth-child(2n-1) td {
        background: #F5F5F5;
    }

    table th,
    table td {
        text-align: right;
    }

    table th {
        padding: 5px 20px;
        /* color: #5D6975; */
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: bold;
        border-top: 1px solid #5D6975;
    }

    table .service,
    table .desc {
        text-align: left;
    }

    table td {
        /* padding: 20px; */
        text-align: left;
    }

    table td.service,
    table td.desc {
        vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table td.grand {
        border-top: 1px solid #5D6975;
        ;
    }

    #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
    }

    footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
    }

</style>

</html>
