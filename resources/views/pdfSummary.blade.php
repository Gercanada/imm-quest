<!DOCTYPE html>
<html>
   <h1>
      Some info
   </h1>
   <head>
      <title>{{ $fileName }} </title>
   </head>
   <body>
      <div class="user">
         <h1 class="left"> {{ $name }}</h1>
         <h4 class="right">  {{ $date }}</h4>
      </div>
      <table class="center">
         <thead>
            <tr >
               <th></th>
               {!! $scennarios !!}
            </tr>
            <tr>
               <th><b>Maritial status</b></th>
               {{!! $maritialSituations !!}}
            </tr>
            <tr>
               <th>Totals</th>
               {!! $totals !!}
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
      border-right: 1px dotted;
      }
      .num-val{
      text-align: right;
      }
      table, td, th {
      border: 1px solid;
      }
      th{
      font-weight: bold;
      }
      table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 60px
      }
      .left{
      text-align: left;
      float:left
      }
      .right{
      text-align: right;
      float: right
      }
      .user{
      padding-bottom: 10px;
      margin-bottom: 10px;
      }
   </style>
</html>
