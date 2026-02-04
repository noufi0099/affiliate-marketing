<?php
include "logic.php";

$users=getAllUsers();
if (isset($_POST['submit'])){
    addUserLogic($_POST['name'], $_POST['email'], $_POST['parent_id']);
    echo "User added successfully";
}
?>

<h3>Add User</h3>

<form method="post">
    Name:<input type="text" name="name" required><br>
    Email:<input type="text" name="email" required><br>

    Parent User:
    <select name="parent_id">
        <option value="">Select Option</option>
        <?php foreach ($users as $user){ ?>
            <option value="<?php echo $user['id']; ?>">
                <?php echo $user['name']; ?>
            </option>
        <?php } ?>
    </select><br>

    <button name="submit">Add User</button>
</form>
