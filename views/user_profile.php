<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$users = isset($_SESSION['users']) ? $_SESSION['users'] : [];

?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://puteborgne.sexy/_css/normalize.css"/>
    <link rel="stylesheet" href="https://puteborgne.sexy/_css/skeleton.css"/>
    <style>
        fieldset {
            border: 0.25rem solid rgba(225, 225, 225, 0.5);
            border-radius: 4px;
            padding: 1rem 2rem;
        }

        .errors {
            color: #ff5555;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <form method="post" action="../controllers/chatrooms_controller.php?action=create" id="chatRoomCreateForm">
            <label for="chatroomName">
                Nom de la chatroom
                <input name="name" type="text" id="chatroomName"/>
            </label>
            <input name="user_id" hidden value='1' />
            <button type="submit">Create Chatroom</button>
        </form>

    </div>

    <div class="row">
        <h2>Users</h2>
        <table class="u-full-width">
            <thead>
            <tr>
                <th>id</th>
                <th>login</th>
                <th>password</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user) {
                ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->login ?></td>
                    <td><?= $user->password ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="column">
            $_SESSION
            <pre><?php print_r($_SESSION) ?></pre>
        </div>

    </div>

    <div class="row">
        <div class="one-half column">
            $_GET
            <pre><?php print_r($_GET) ?></pre>
        </div>
        <div class="one-half column">
            $_POST :
            <pre><?php print_r($_POST) ?></pre>
        </div>
    </div>

</div>
</body>
</html>