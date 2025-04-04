<!doctype html>
<?php
session_start();
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';

require_once($lang);





?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
          rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo | Add task</title>
</head>
<body>
<?php
include_once 'inc/header.php';
$ids = $_SESSION['ids'];
$numberTemplate = $_SESSION['numberTemplate'];
$i = 0;

$_SESSION['ids'] = $ids;
$_SESSION['numberTemplate'] = $numberTemplate;


?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txttask1?>
            </div>

            <form method="post" action="tasks.php">

                <div class="form-check">
                    <div style="align-content: flex-start">&#9989; Login</div>
                    <!--<input class="form-check-input" name="task[]"   value="login.php" id="login" checked="checked" ">
                       <label class="form-check-label" for="defaultCheck1"  >
                           Login
                       </label> -->
                    <input type="hidden" name="task[]" value="login.php">
                </div>
                <div class="form-check">
                    <div style="align-content: flex-start">&#9989; <?php echo $txtglobali ?> </div>
                    <!--<input class="form-check-input" name="task[]"   value="login.php" id="login" checked="checked" ">
                       <label class="form-check-label" for="defaultCheck1"  >
                           Login
                       </label> -->
                    <input type="hidden" name="task[]" value="global_invite.php">
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-sm-4">

                    <!--  Фарм кук -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="coockie.php" id="coo">
                            <label class="form-check-label" for="coo">
                                <?php echo $txttask2?>
                            </label>
                        </div>
                        <!--  Фарм интересов -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="farm.php" id="farm">
                            <label class="form-check-label" for="farm">
                                <?php echo $txttask3?>
                            </label>
                        </div>
                        <!--  2fa -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="2fa.php" id="2fa">
                            <label class="form-check-label" for="2fa">
                                <?php echo $txttasks5 ?>
                            </label>
                        </div>
                        <!--  Добавить почту -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="add_mail.php" id="add_mail">
                            <label class="form-check-label" for="add_mail">
                                <?php echo $txttask30 ?>
                            </label>
                        </div>
                        <!--  заполнение акков -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="filling_accounts.php" id="filling_accounts">
                            <label class="form-check-label" for="filling_accounts">
                                <?php echo $txttask16?>
                            </label>
                        </div>
                        <!--  Прокачка новорегов -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="new_accounts.php" id="new_accounts">
                            <label class="form-check-label" for="new_accounts">
                                <?php echo $txttask4?>
                            </label>
                        </div>
                        <!--  Share -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="share.php" id="share">
                            <label class="form-check-label" for="share">
                                Share
                            </label>
                        </div>

                        <!--  Инвайт 3 Приглашение предложенных -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="invite_suggestions.php"
                                   id="invite_suggestions">
                            <label class="form-check-label" for="invite_suggestions">
                                <?php echo $txttask5?>
                            </label>
                        </div>


                        <!--  Инвайт из групп -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="invite_from_group.php" id="invite_from_group">
                            <label class="form-check-label" for="invite_from_group">
                                <?php echo $txttask6?>
                            </label>
                        </div>
                        <!-- удалить инвайты -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="erase_invite.php" id="erase_invite">
                            <label class="form-check-label" for="erase_invite">
                                <?php echo $txttask31 ?>
                            </label>
                        </div>
                        <!--  Фарм кук -->

                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task4" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask7?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="page_invite.php" id="page_invite" >
                            <label class="form-check-label" for="page_invite">
                                <?php echo $txttask8?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="invite_to_group.php" id="invite_to_group" >
                            <label class="form-check-label" for="invite_to_group">
                                <?php echo $txttask9?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask10?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="post_to_profile.php" id="post_to_profile">
                            <label class="form-check-label" for="post_to_profile">
                                <?php echo $txttask11?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="join_group.php" id="join_group" >
                            <label class="form-check-label" for="join_group">
                                <?php echo $txttask12?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="post_to_group.php" id="post_to_group"  >
                            <label class="form-check-label" for="post_to_group">
                                <?php echo $txttask13?>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="a_post_to_group.php" id="a_post_to_group"  >
                            <label class="form-check-label" for="a_post_to_group">
                                Advanced spam in Facebook group (Purchase and activation required)
                            </label>
                        </div>

                         <!---- advanced spam in Facebook group --?

                        <!--  комменты -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox"  id="commenting" value="commenting.php">
                            <label class="form-check-label" for="commenting">
                                Like + comments
                            </label>
                        </div>
                        <!--  Лайк -->
      <!---                  <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="like.php" id="like">
                            <label class="form-check-label" for="like">
                                <?php //echo $txttask15?>
                            </label>
                        </div>
-->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask17?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask18?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask19?>
                            </label>
                        </div>
                        <!--           <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask20?>
                            </label>
                        </div>
->
                        <!-- прием в друзья -->
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="accept_friends.php" id="accept_friends">
                            <label class="form-check-label" for="accept_friends">
                                <?php echo $txttask21?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="comoai.php" id="comoai" >
                            <label class="form-check-label" for="comoai">
                                <?php echo 'Comments OpenAi'?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="post_oai.php" id="post_oai" >
                            <label class="form-check-label" for="post_oai">
                                <?php echo 'Posting profile OpenAi'?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask22?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="review_page.php" id="review_page">
                            <label class="form-check-label" for="review_page">
                                Page Review
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="rss_post.php" id="rss_post">
                            <label class="form-check-label" for="rss_post">
                                Rss posting
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="create_pages.php" id="create_pages">
                            <label class="form-check-label" for="create_pages">
                                <?php echo $txttask23?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="mess_sbor.php" id="mess_sbor" >
                            <label class="form-check-label" for="mess_sbor">
                                <?php echo $txttask24?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask25?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="happy.php" id="happy" >
                            <label class="form-check-label" for="happy">
                                <?php echo $txttask26?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="" id="task6" disabled>
                            <label class="form-check-label" for="defaultCheck2">
                                <?php echo $txttask27?>
                            </label>
                        </div>
                        
                       <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="banhammer.php" id="banhammer" >
                            <label class="form-check-label" for="banhammer">
                                <?php echo $txttask28?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="parse_group.php" id="parse_group" >
                            <label class="form-check-label" for="parse_group">
                                <?php echo $txttask40?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="task[]" type="checkbox" value="parse_active.php" id="parse_active" >
                            <label class="form-check-label" for="parse_active">
                                Parse active users
                            </label>
                        </div>


                    </div>
                </div>
                <br>
                <button class="btn btn-secondary" name="i" value="0">ADD TASK</button>
            </form>


</main>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->

</body>
</html>
