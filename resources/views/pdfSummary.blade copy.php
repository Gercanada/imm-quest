<!DOCTYPE html>
<html>


   <head>
      <title>{{ $fileName }} </title>
   </head>
   <body>
       <div>
           <div class="header">
               <h1>
                   Express Entry
                </h1>
              <div class="right">
                   <img src="{{ public_path('images/cropped_ger_logo.png') }}"  width="40px" >
                   <img src="{{ public_path('images/ger_logo.png') }}"  width="160px">
             </div>
        </div>

       </div>
    <br>
</br>
<div>
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

</div>

      <div class="footer">
          <p>contact</p>
      </div>
   </body>
   <style>
      table,
      th,
      td {
      border-right: 1px dotted;
      }
      .num-val{
      text-align: right;
      border-right: solid 1px;
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

      .header{
          width: 100%;
          top: 0%;

          /* border: 1px solid; */
          height: 60px;
          /* background-color: green; */
      }
      .footer{
          width: 100%;
          border: 1px solid;
          height: 60px;
          align-items: center;
          margin-bottom: 0%;
          padding-bottom: 0%;
          /* background-color: green; */
      }
   </style>
</html>
