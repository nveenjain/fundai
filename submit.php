<?php
session_start();
if(!isset($_SESSION['name'])){
  header("Location:index.php");
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
              <strong>Submit your response</strong>
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
            <form method="post" action="submit.php" id="new_submission" onsubmit="submit();">
              <div class="form-group">
                <label for="company" class="form-control-label">company:</label>
                <input type="text" class="form-control" id="company"/>
              </div>
              <div class="form-group">
                <label for="process_type" class="form-control-label">Process Type</label>
                <input list="process_type" name="process_type" class="form-control"/>
                <datalist id="process_type">
                  <option value="Internship">
                  <option value="Placement">
                  <option value="PPO">
                </datalist>
              </div>
              <div class="form-group">
                <label for="tag" class="form-control-label">Tag</label>
                <input list="tag" name="tag" class="form-control">
                <datalist id="tag">
                  <option value="Coding Round">
                  <option value="Tech internship">
                  <option value="Facts">
                  <option value="HR ">
                </datalist>
              </div>
              <div class="form-group">
                <label for="description" class="form-control-label">Description</label>
                <textarea class="form-control" id="description"></textarea>
              </div>
              <div class="form-group">
                <label for="year" class="form-control-label">Year</label>
                <input type="number" min="1926" max="2018" class="form-control" id="year">
              </div>
              <div>
                <label for="anonymous">Anonymous</label>
                <input type="checkbox" id="anonymous" name="anonymous" value="anonymous">
              </div>
              <div class="modal-footer">
                <button type="submit" id="modal" class="btn btn-primary">Sumbit Response</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--modal for submition history start here -->

  <div class="container">
    <div class="modal fade" id="showresponse" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showModalLabel">New submission</h5>
            <button type="button" class="close" data-dismiss="showData" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form  action="" id="newsubmition">
              <div class="modal-footer">
                <button type="submit" id="showData" class="btn btn-primary">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
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
    <script>
    //open the modal
  
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
  $(document).ready(function(){
    $("#tbodydata").click(function(){
        // $("#showresponse").modal("show");
        console.log(this);
    });
  });
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
        //load more data button

        $('#btn-example-load-more').on('click', function(){
            table.page.loadMore();
        });
    });
  </script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.2.1/js/dataTables.keyTable.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.2.1/css/keyTable.bootstrap.min.css"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-pageLoadMore/1.0.0/js/dataTables.pageLoadMore.min.js"></script>
</body>
</html>