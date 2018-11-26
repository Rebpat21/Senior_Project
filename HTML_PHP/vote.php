<style>
<?php
include 'styles/voteCSS.css';
require_once("session.php");
verify_login();
require_once("included_functions.php");
?>
</style>

<?php
    //include and initialize Poll class
    include 'Poll.class.php';
    $poll = new Poll;

    //get poll and options data
    $pollData = $poll->getPolls();
?>

<?php
//if vote is submitted
if(isset($_POST['voteSubmit'])){
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
        // 'hasVoted' => $_SESSION['admin_id']
    );
    //insert vote data
    $voteSubmit = $poll->vote($voteData);

    if($voteSubmit){

      // $query = "INSERT INTO hasVoted (idPoll, idU) ";
      // $query .= "VALUES ('".$_POST['pollID']."', '".$_SESSION["admin_id"]."')";
      // $result = $mysqli->query($query);

      redirect_to("readPollsStud.php");

        // setcookie($_POST['pollID'], 1, time()+60*60*24*365);
        // $statusMsg = 'Your vote has been submitted successfully.';
    }else{
        $statusMsg = 'Your vote has already been submitted.';
    }
}
?>

<div class="pollContent">
    <?php echo !empty($statusMsg)?'<p class="stmsg">'.$statusMsg.'</p>':''; ?>
    <form action="" method="post" name="pollFrm">
    <h3><?php echo $pollData['poll']['subject']; ?></h3>
    <ul>
        <?php foreach($pollData['options'] as $opt){
            echo '<li><input type="radio" name="voteOpt" value="'.$opt['id'].'" >'.$opt['Name'].'</li>';
        } ?>
    </ul>
    <input type="hidden" name="pollID" value="<?php echo $pollData['poll']['id']; ?>">
    <input type="submit" name="voteSubmit" class="button" value="Vote">
    <a href="readPollsStud.php">Back</a>
    </form>
</div>
