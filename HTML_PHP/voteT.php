<style>
<?php  include 'styles/voteCSS.css';
require_once("session.php");
verify_login();
require_once("included_functions.php");
?>
</style>

<?php
    //include and initialize Poll class
    include 'Poll.class.php';
    $poll = new Poll;
    $ID = $_GET["id"];

    //get poll and options data
    $pollData = $poll->getPolls($ID);
?>

<?php
$ID = $_GET["id"];
//if vote is submitted
if(isset($_POST['voteSubmit'])){
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
    );
    // insert vote data
    $voteSubmit = $poll->vote($voteData);
    if($voteSubmit){
        //store in $_COOKIE to signify the user has voted
        setcookie($_POST['pollID'], 1, time()+60*60*24*365);

        $statusMsg = 'Your vote has been submitted successfully.';
    }else{
        $statusMsg = 'Your vote already had submitted.';
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
    <a href="results.php?pollID=<?php echo $pollData['poll']['id']; ?>">Results</a>
    <a href="readPollsT.php">Back</a>
    </form>
</div>
