<?php
require_once 'templates/header.php';


$db = new PDO("mysql:host=localhost;dbname=practice_security", "root", "Tluantt34@");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT username, password, credit_card_number FROM userdata WHERE username=?";
    $statement = $db->prepare($query);
    $statement->bindParam(1, $username);
    $statement->execute();

    $user_data = $statement->fetch(PDO::FETCH_ASSOC);
    
}
?>

<div class="text-danger">Wrong username or password !</div>

<div class="card m-3">
    <div class="card-header">
        <span><?php echo $user_data['username'] ?></span>
    </div>
    <div class="card-body">
        <p class="card-text">Your credit card number: <?php echo $user_data['credit_card_number']; ?></p>
    </div>
</div>
<hr>

<form action="" method="post" class="m-3">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Username" name="username">
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter password" name="password">
        </div>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">View your data</button>
    </div>
</form>

<?php
require_once 'templates/footer.php';
?>