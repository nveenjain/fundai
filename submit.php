<?php
session_start();
if(!isset($_SESSION['name'])){
  header("Location:index.php");
}
if(isset($_POST['company'])&&isset($_POST['process_type'])&&isset($_POST['tag'])&&isset($_POST['year'])){
    require('db.php');
      $dsn = "mysql:host=$host;dbname=$db;charset=$charset";      
      $pdo = new pdo($dsn,$user,$pass);
      if($_POST['company']==NULL || $_POST['process_type']==NULL || $_POST['tag']==NULL || $_POST['year']==NULL){
          echo "Please enter all the field";
          die();
      }
      $q = $pdo->prepare("INSERT INTO `group` (`company`, `process_type`, `tag`, `year`) VALUES (?,?,?,?)");
      $q->bindParam(1,$_POST['company']);
      $q->bindParam(2,$_POST['process_type']);
      $q->bindParam(3,$_POST['tag']);
      $q->bindParam(4,intval($_POST['year']),PDO::PARAM_INT);
      $q->execute();
      if ($q->rowCount()){
          echo "Success";
      }else echo "Some error occured. (IS the company already listed?) Please try again later.";
      die();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>fundai</title>
    <style >
    body{
            background-color: #696969;
        }
    h1{
      text-align: center;
    }
    .navtabbar{
      margin-right: .5%;
    }
    .dt-more-container {
            text-align:center;
            margin:2em 0;
        }
        .dataTable tbody tr {
          cursor: pointer;
        }
    </style>
</head>
<body>
  <!--navigation bar start here-->
  <header>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" id="navtabs" data-toggle="collapse" data-target="#navtab" data-whatever="@mdo">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navtab">
        <ul class="nav navbar-nav navbar-left">
          <li >
            <a class="btn btn-info" id="myButton" data-toggle="modal" data-whatever="@mdo">
              <strong>Submit your Group(If not Listed)</strong>
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right navtabbar ">
          <li >
            <a  href="#" class="btn btn-info ">
              <strong><?php echo $_SESSION['name']; ?></strong>
            </a>
          </li>
          <li >
            <a href="logout.php" class="btn btn-danger navbar-right">
              <strong>Log out</strong>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </header>
  <div>
    <div class="jumbotron">
      <div class="page-header">
        <div class="container"> 
          <h1>FUNDAI</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- modal for submit response starts  here-->
  <div class="container">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New submission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="" id="new_submission" ">
              <div class="form-group">
                <label for="company" class="form-control-label">company:</label>
                <input required="required" autocomplete="off" type="text" class="form-control" id="company"/>
              </div>
              <div class="form-group">
                <label for="process_type" class="form-control-label">Process Type</label>
                <input required="required" list="process_type" name="process_type" class="form-control"/>
                <datalist id="process_type">
                  <option value="Internship">
                  <option value="Placement">
                  <option value="PPO">
                </datalist>
              </div>
              <div class="form-group">
                <label for="tag" class="form-control-label">Tag</label>
                <input required="required" list="tag" name="tag" class="form-control">
                <datalist id="tag">
                  <option value="Coding Round">
                  <option value="Tech internship">
                  <option value="Facts">
                  <option value="HR ">
                </datalist>
              </div>
              
              <div class="form-group">
                <label for="year" class="form-control-label">Year</label>
                <input required="required" autocomplete="off" type="number" min="1926" max="2018" class="form-control" id="year">
              </div>
              <div class="card text-white bg-danger mb-3" id="msg" style="max-width: 100%;">
                <div class="card-body">
                  <p class="card-text"></p>
                 </div>
             </div>
            <button type="submit" class="btn btn-info" id="submit_response_btn">Submit Response</button>
            </form>
            <div class="modal-footer">
               <button id="modal" class="btn btn-primary">Close</button>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--modal for submition history start here -->

 
  <!--Data table start here -->
  <div class="container foot">
    <div class="panel panel-default panel-danger">
        <div class="panel-heading">
          <h1 class="panel-title">Data table of Your submitioin</h1>
        </div>
        <table class="table table-striped table-bordered table-hover "  id="data_table">
          <thead>
            <tr>
              <th>Serial No.</th>
              <th>Company</th>
              <th>Process Type</th>
              <th>Tag</th>
              <th>Year</th>
            </tr>
          </thead>
          <tbody id="tbodydata">
          </tbody>
        </table>
         <div class="dt-more-container">
            <button id="btn-example-load-more" class="btn btn-info" style="display:none">Load More</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Data table ends here here-->

  <!-- Footer start here -->
  <footer>
      <div class="container">
          <div class="row">
              <div class="span6 offset3">
                  <ul class="social-networks">
                      <li><a href="" onclick="newPopup('https://www.facebook.com/')" title="CSES">
                          <i class="icon-circled icon-bgdark icon-dribbble icon-2x fa fa-fw fa-facebook"></i></a></li>
                      <li>
                          <a href="" onclick="newPopup('http://share.here.com/r/mylocation/e-eyJuYW1lIjoiQ29tcHV0ZXIgU2NpZW5jZSBhbmQgRW5naW5lZXJpbmcgU29jaWV0eSIsImFkZHJlc3MiOiJDb21wdXRlciBTY2llbmNlICYgRW5naW5lZXJpbmcgRGVwYXJ0bWVudCwgSW5kaWFuIFNjaG9vbCBPZiBNaW5lcywgRGhhbmJhZCIsImxhdGl0dWRlIjoyMy44MTUxOCwibG9uZ2l0dWRlIjo4Ni40NDA0OCwicHJvdmlkZXJOYW1lIjoiZmFjZWJvb2siLCJwcm92aWRlcklkIjoxNDUyOTYzMTg0OTY5MjU0fQ==?link=directions&fb_locale=en_US&ref=facebooke')" class="btn-social btn-outline">
                              <i class="icon-circled icon-bgdark icon-twitter icon-2x fa fa-fw fa-map-marker"></i></a>
                      </li>

                  </ul>
                  <p class="copyright">
                  <div class="credits">
                      <a href="" onclick="newPopup('http://csesociety.in/')">CSE Society</a>
                  </div>
                      &copy; IIT(ISM) Dhanbad<br>
                      Computer Science & Engineering<br>
                      Technological Avenue<br>
                      IIT (ISM) ,Dhanbad, Jharkhand 82600

                  </p>
              </div>
          </div>
      </div>
  </footer>
  <!-- footer ends here-->
    <script>
    //open the modal
  document.querySelector("#new_submission").addEventListener('submit', function(e){
    e.preventDefault();
    document.querySelector('#submit_response_btn').classList.add("disabled");
    var xtp = new XMLHttpRequest();
    xtp.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200) {
        console.log(this.responseText);
        if(this.responseText==="Success"){
          document.querySelector('#submit_response_btn').classList.remove("disabled");
          document.querySelector("#msg").classList.remove("bg-danger");
          document.querySelector("#msg").innerHTML="Success";
          window.location= "./";
          document.querySelectorAll('input').forEach( function(element) {
            element.value = null;
          });
        }else{
          document.querySelector('#submit_response_btn').classList.remove("disabled");
          document.querySelector("#msg").innerHTML=this.responseText;
        }
      }
    };
    xtp.open("POST", "submit.php", true);
    xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xtp.send("company="+document.querySelector("#company").value+"&process_type="+document.querySelector("input[name='process_type']").value+"&tag="+document.querySelector("input[name='tag']").value+"&year="+document.querySelector("#year").value);
    
  });
  $(document).ready(function(){
    $("#myButton").click(function(){
        $("#exampleModal").modal("show");
    });
  });
  //close the modal
  $(document).ready(function(){
    $("#modal").click(function(){
        $("#exampleModal").modal("hide");
    });
  });
  //show response modal
  
  //hide response modala
  $(document).ready(function(){
    $("#showData").click(function(){
        $("#showresponse").modal("hide");
    });
  });
  //Data for data table section
  $(document).ready(function (){
        var table = $('#data_table').DataTable({
            dom: 'frt',
            ajax: 'http://localhost/fundai/fundai/news.php',
            drawCallback: function(){
                if($('#btn-example-load-more').is(':visible')){
                    $('html, body').animate({
                        scrollTop: $('#btn-example-load-more').offset().top
                    }, 1000);
                }

                $('#btn-example-load-more').toggle(this.api().page.hasMore());
            }
        });
        $('.dataTable').on('click', 'tbody tr', function() {
          document.location = ("./question.php?id="+parseInt(this.textContent));

});
        //load more data button

        $('#btn-example-load-more').on('click', function(){
            table.page.loadMore();
        });
    });

    //open location and fbpage
        function newPopup(url) {
            popupWindow=window.open(
                url,'popUpWindow','height=350 ,width=810,left=10,top=10,resizable=yes,scrollbars=yes,toolbars=yes ,menubar=no ,location=no,directories=no,status=yes'
            )

        }
  </script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.2.1/js/dataTables.keyTable.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.2.1/css/keyTable.bootstrap.min.css"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-pageLoadMore/1.0.0/js/dataTables.pageLoadMore.min.js"></script>
</body>
</html>