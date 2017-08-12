<!DOCTYPE html>
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
        .setWidth{
            max-width: 100px;
        }
        .concat div {
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
                        <strong>Student Name</strong>
                    </a>
                </li>
                <li >
                    <a href="" class="btn btn-danger navbar-right">
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
                            <textarea type="text" id="submit_question" name="submit_question" value="submit_question"></textarea>
                        </div>
                        <div>
                            <label for="anonyms">Anonyms:</label>
                            <input type="checkbox" id="anonyms" name="anonyms" value="anonyms">
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
                                <h4 class="card-title" id="modal_question">Question goes here</h4>
                                <p class="card-text" id="modal_answer">Answer goes here</p>
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
                    Group Name
                </blockquote>
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
            <tr>
                <th class="col-xs-1">Question No.</th>
                <th class="col-xs-11">Question</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th class="col-xs-1">Question No.</th>
                <td class="col-xs-11">Question</td>
            </tr>
            </tfoot>
            <tbody id="table_question">
            <tr>
                <td >1</td>
                <td class="setWidth concat">Question</td>
            </tr>
            <tr>
                <td >1</td>
                <td class="setWidth concat">Question</td>
            </tr>
            <tr>
                <td >1</td>
                <td class="setWidth concat"><div>QuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestionQuestion</div></td>
            </tr>
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
                    <a href="http://csesociety.in/">CSE Society</a>
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
            ajax: '',
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
