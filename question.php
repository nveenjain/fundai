<?php
session_start();
if(isset($_SESSION['name']) && isset($_GET['gid'])){
    header("Content-type:application/json");
    require('db.php');
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";      
    $pdo = new pdo($dsn,$user,$pass);
    $q = $pdo->prepare("SELECT id,question,answer FROM question WHERE group_id=:gid");
        $q->bindParam(':gid',$_GET['gid']);
        $q->execute();
        $json_data = Array();
        $json_data["data"]= Array();
        $count=1;
        while($data = $q->fetch()){
            $nr = Array();
            array_push($nr, $count,$data["question"],$data["answer"]);
            array_push($json_data["data"], $nr);
            $count++;
        }
    echo json_encode($json_data);

    die();
}else if(isset($_SESSION['name']) && isset($_POST['qid']) && $_POST['g']){
        header("Content-type:application/json");
        require('db.php');
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";      
        $pdo = new pdo($dsn,$user,$pass);
        $q = $pdo->prepare("SELECT question,answer,user,anonymous FROM question WHERE group_id=:gid LIMIT 1 OFFSET :offset");
        $q->bindParam(':gid',$_POST['g']);
        $q->bindParam(':offset',intval($_POST['qid']-1), PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch();
        if($data[3]==1)$data[2] = "Anonymous";
        $json_data = Array($data[0],$data[1],$data[2]);
        echo json_encode($json_data,  JSON_FORCE_OBJECT);
    die();
}else if(isset($_SESSION['name']) && isset($_POST['question']) && isset($_POST['answer']) && isset($_POST['gid'])){
        require('db.php');
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";      
        $pdo = new pdo($dsn,$user,$pass);
        if($_POST['question']==NULL || $_POST['answer']==NULL){
            echo "Please enter all the field";
            die();
        }
        $q = $pdo->prepare("INSERT INTO `question`( `group_id`, `question`, `answer`, `user`, `anonymous`) VALUES (:gid,:question,:answer,:user,:anonymous)");
        $q->bindParam(':gid',intval($_POST['gid']),PDO::PARAM_INT);
        $q->bindParam(':question',$_POST['question']);
        $q->bindParam(':answer',$_POST['answer']);
        $q->bindParam(':user',$_SESSION['name']);
        $an =  $_POST['anonymous']=="false"?0:1;
        $q->bindParam(':anonymous',boolval($an),PDO::PARAM_BOOL);
        $q->execute();
        if ($q->rowCount()){
            echo "Success";
        }else echo "Some error occured. Please try again later.";
    die();
}else if(!(isset($_SESSION['name']) && isset($_GET['id']))){
  header("Location:index.php");
}else{
    
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
    <style>
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
        #table_question tr td{
            max-width: 100px;
        }
        #table_question tr td {
            overflow: hidden;
            -ms-text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            white-space: nowrap;
            width:inherit;
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
                        <strong>Submit your Question</strong>
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
                    <a href="./logout.php" class="btn btn-danger navbar-right">
                        <strong>Log out</strong>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
<!--  navigation bar ends here -->
<!-- modal for submit question start here-->
<div class="container">
    <div class="modal fade" id="queModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="question.php" id="new_question">
                        <div>
                            <label for="submit_question">Question:</label>
                            <textarea type="text" id="submit_question" name="submit_question" value="submit_question" required="required"></textarea>
                        </div>
                        <div>
                        <label for="submit_answer">Answer:</label>
                        <textarea type="text" id="submit_answer" name="submit_answer" value="submit_answer" required="required"></textarea>
                        </div>

                        <div>
                            <label for="anonymous">Anonymous:</label>
                            <input type="checkbox" id="anonymous" name="anonymous" value="anonymous">
                        </div>
                        <div id="msg">
                            
                        </div>
                        <div class="card text-white bg-danger mb-3" style="max-width: 100%;">
                            <div class="card-body">
                              <p class="card-text"></p>
                             </div>
                         </div>
                        <button type="submit" class="btn btn-info" id="submit_question-btn">Submit question</button>
                    </form>
                    <div class="modal-footer">
                        <button  id="modal" class="btn btn-primary">close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal for submit question ends here-->

<!-- modal for question and answer start here-->

<div class="container">
        <div class="modal fade bd-example-modal-lg" id="show_answer" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showModalLabel">Question & Answer:</h5>
                        <button type="button" class="close" data-dismiss="close_answer" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div class="card text-center ">
                            <div class="card-block alignleft">
                                <h4 class="card-title" id="modal_question">Loading...</h4>
                                <blockquote class="blockquote" id="modal_answer">Loading</blockquote>
                                <p class="card-text" id="modal_submitted">Loading...</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="close_answer" class="btn btn-primary">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<!-- modal for question and answer ends here-->


<section class="spacer green">
    <div class="container">
        <div class="row">
            <div class="span6 aligncenter flyLeft">
                <blockquote class="large">
                    <?php
                    include('db.php');
                    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";      
                    $pdo = new pdo($dsn,$user,$pass);
                    $q= $pdo->prepare("SELECT * FROM `group` WHERE id=?");
                    $id = $_GET['id'];
                    $q->execute([$id]);
                    $data = $q->fetch();
                    // var_dump($data);
                    echo $data["company"]. "<br />";
                    ?>
                </blockquote>
                    <?php
                    echo $data["process_type"].", ".$data["year"];
                    ?>
            </div>
            <div class="span6 aligncenter flyRight">
                <i class="icon-coffee icon-10x"></i>
            </div>
        </div>
    </div>
</section>


<!-- Jquery data table start here-->
<div class="container foot">
    <div class="panel panel-default panel-danger">
        <div class="panel-heading">
            <h1 class="panel-title">Questions</h1>
        </div>
        <table class="table table-striped table-bordered table-hover "  id="data_table">
            <thead>
            <tr class="concat">
                <th class="col-xs-1">Question No.</th>
                <th class="col-xs-6">Question</th>
                <th class="col-xs-5">Answer</th>
            </tr>
            </thead>
            
            <tbody id="table_question">
            
            </tbody>
        </table>
        <div class="dt-more-container">
            <button id="btn-example-load-more" class="btn btn-info" style="display:none">Load More</button>
        </div>
    </div>
</div>
</div>

<!--Jquery data table ends here-->
<!-- Footer start here -->
<footer>
    <div class="container">
        <div class="row">
            <div class="span6 offset3">
                <ul class="social-networks">
                    <li><a href="#" onclick="newPopup('https://www.facebook.com/')" title="CSES">
                        <i class="icon-circled icon-bgdark icon-dribbble icon-2x fa fa-fw fa-facebook"></i></a></li>
                    <li>
                        <a href="#" onclick="newPopup('http://share.here.com/r/mylocation/e-eyJuYW1lIjoiQ29tcHV0ZXIgU2NpZW5jZSBhbmQgRW5naW5lZXJpbmcgU29jaWV0eSIsImFkZHJlc3MiOiJDb21wdXRlciBTY2llbmNlICYgRW5naW5lZXJpbmcgRGVwYXJ0bWVudCwgSW5kaWFuIFNjaG9vbCBPZiBNaW5lcywgRGhhbmJhZCIsImxhdGl0dWRlIjoyMy44MTUxOCwibG9uZ2l0dWRlIjo4Ni40NDA0OCwicHJvdmlkZXJOYW1lIjoiZmFjZWJvb2siLCJwcm92aWRlcklkIjoxNDUyOTYzMTg0OTY5MjU0fQ==?link=directions&fb_locale=en_US&ref=facebooke')" class="btn-social btn-outline">
                            <i class="icon-circled icon-bgdark icon-twitter icon-2x fa fa-fw fa-map-marker"></i></a>
                    </li>

                </ul>
                <p class="copyright">
                <div class="credits">
                    <a href="" onclick="newPopup('http://csesociety.in/')" >CSE Society</a>
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
<a href="#" class="scrollup"><i class="icon-angle-up icon-square icon-bgdark icon-2x"></i></a>
<script>

    //open submit question modal
    $(document).ready(function(){
        $("#myButton").click(function(){
            $("#queModal").modal("show");
        });
    });

    //close submit question modal
    $(document).ready(function(){
        $("#modal").click(function(){
            $("#queModal").modal("hide");
        });
    });

    //show question and answer modal
    $(document).ready(function(){
        $("#table_question").click(function(){
            $("#show_answer").modal("show");
        });
    });
    
    //hide question and answer modal
    $(document).ready(function(){
        $("#close_answer").click(function(){
            $("#show_answer").modal("hide");
        });
    });

    //Question in data table
    $(document).ready(function (){
        var table = $('#data_table').DataTable({
            dom: 'frt',
            ajax: '?gid='+<?php echo $id ?>,
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
        var xtp = new XMLHttpRequest();
          xtp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            var x = JSON.parse(this.responseText);
            console.log(x);
            document.querySelector('#modal_question').innerHTML = x[0];
            document.querySelector('#modal_answer').innerHTML = x[1];
            document.querySelector('#modal_submitted').innerHTML = "by:- "+ x[2];

            }
        };
        var v = table.row(this).data()[0];
        var g = <?php echo $_GET['id']; ?>;
        xtp.open("POST", "question.php", true);
        xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xtp.send(`qid=${v}&g=${g}`);
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
    document.querySelector('#new_question').addEventListener('submit', function(e){
        e.preventDefault();
        document.querySelector('#submit_question-btn').classList.add("disabled");
        var xtp = new XMLHttpRequest();
        xtp.onreadystatechange = function(e){
            document.querySelector('#submit_question-btn').classList.remove("disabled");
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==="Success"){
                document.querySelector(".card-text").innerHTML = this.responseText;
                document.querySelector("#submit_question").value = null;
                document.querySelector("#submit_answer").value = null;
                document.querySelector("#anonymous").checked = false;
                window.location= "./";
                }else{
                document.querySelector(".card-text").innerHTML = this.responseText;
                document.querySelector(".card-text").classList.add("danger");
                }
            }
        }
        xtp.open("POST","question.php",true);
        xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xtp.send("question="+document.querySelector("#submit_question").value+"&answer="+document.querySelector("#submit_answer").value+"&anonymous="+document.querySelector("#anonymous").checked+"&gid="+<?php echo $_GET['id']; ?>);
    });

</script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.2.1/js/dataTables.keyTable.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.2.1/css/keyTable.bootstrap.min.css"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-pageLoadMore/1.0.0/js/dataTables.pageLoadMore.min.js"></script>
</body>
</html>
