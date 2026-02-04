<?php
include "logic.php";

$users = getAllUsers();
if (isset($_POST['submit'])) {
    makeSaleLogic($_POST['user_id'], $_POST['amount']);
    echo "Sale completed<br>";
}
?>

<h3>Make Sale</h3>

<form method="post">
    Select User:
    <select name="user_id" required>
        <option value="">Select User</option>
        <?php foreach ($users as $user) { ?>
            <option value="<?php echo $user['id']; ?>">
                <?php echo $user['name']; ?>
            </option>
        <?php } ?>
    </select>
    <br>

    Sale Amount: <input type="number" name="amount" min="1" required><br>

    <button name="submit">Make Sale</button>
</form>
