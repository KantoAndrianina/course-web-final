<?php
$url = config('app.url');
?>
@extends('layouts.app_dash')
@section('content2')
<div id="facture">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                

                color: black;
                display: table;
                font-family: Georgia, serif;
                font-size: 24px;
                text-align: center;
            }
            .img{
                
                
            }
            .container {
                background-image: url("<?php echo $url ?>/assets/certificat2.png");
                background-repeat: no-repeat;
                background-size: 20%;
                
                border: 20px solid red;
                width: 850px;
                height: 563px;
                display: table-cell;
                vertical-align: middle;
            }
            .logo {
                color: red;
            }

            .marquee {
                color: red;
                font-size: 48px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }
            .person {
                border-bottom: 2px solid black;
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
            }
            .signature {
                border-bottom: 1px solid black;
                font-style: italic;
                float: left;
            }
            .date {
                border-bottom: 1px solid black;
                font-style: italic;
                float: right;
            }
            .reason {
                margin: 20px;
            }
           
        </style>
    </head>
    <body>
        <div class="container">
            <div class="img">
            <!-- <div class="logo">
                An Organization
            </div> -->

            <div class="marquee">
                ULTIMATE TEAM RACE
            </div>

            <div class="assignment">
                Ce certificat atteste que 
            </div>

            <div class="person">
                L'EQUIPE {{ $data[0]->nom_equipe }}
            </div>

            <div class="reason">
                a brillamment remporté la course<br/>
                TOUTES CATEGORIES
            </div>
            <!-- <div class="signature">
                <p>signature</p>
            </div>
            <div class="date">
                <p>Date</p>
            </div> -->
        </div>

        </div>
    </body>
</html>

                </div>
            </div>
            
            </div>
</div>
<p  class="align-right"><button  id="btn-download-pdf" class="btn btn-success btn-radius btn-brd">Télécharger</button></p>

    {{-- export pdf --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
      {{-- export excel --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
            <script>
          document.getElementById('btn-download-pdf').addEventListener('click', function() {
              // eto maka an'ilay élement ho havadika pdf izay hivelan'io div (facture) io dia tsy voaray
              const element = document.getElementById("facture");
      
              // Options de conversion
              const options = {
              filename: 'course.pdf',
              image: { type: 'jpeg', quality: 0.98 },
              html2canvas: { scale: 2 },
              jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
              //liste @ izay tsy raisina ho havadika pdf
              ignore: ['.ignore-element', '#another-ignore-element']
          };
      
              //mamadika an'azy en pdf
              html2pdf().from(element).set(options).save();
          });
  
          //export to excel
          document.getElementById('btn-download-excel').addEventListener('click', function() {
              const wb = XLSX.utils.table_to_book(document.getElementById('facture'));
              XLSX.writeFile(wb, 'facturation.xlsx');
          });
      </script>
@stop