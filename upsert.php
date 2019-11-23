<?php
    require_once "actions/db_connect.php";

    if ($_GET['action']=="create") $action = "Create New";
    if ($_GET['action']=="update") $action = "Update";

    if (isset($_GET['item_id'])) {
        $item_id = $_GET['item_id'];
        $sqlTodo = "SELECT * FROM todos
            INNER JOIN `items` ON fk_todo_item_id = item_id
            INNER JOIN `categories` ON fk_category_id = category_id
            INNER JOIN `addresses` ON fk_address_id = address_id
            INNER JOIN `cities` ON fk_zip_code = zip_code
            WHERE $item_id = item_id";
        $resultTodo = $connect->query($sqlTodo);
        $itemTodo = mysqli_fetch_assoc($resultTodo);
    } else {
        $item_id = "";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $action ?> "Things To Do"-Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <fieldset>
        <legend><?php echo $action ?> "Things To Do"-Item</legend>

        <form class="border border-success form-group" action="actions/a_upsert.php" method="post">
            <table cellspacing="0" cellpadding="0">
                <input type="hidden" name="item_id" value=<?php echo $item_id; ?>>
                <tr>
                    <th>Image:</th>
                    <td>
                      <input type="text" class="form-control" name="image" placeholder="Image Link" value="<?php if ($item_id<>"") echo $itemTodo['image']; ?>" />
                    </td>
                </tr>    
                <tr>
                    <th>Name:</th>
                    <td>
                      <input type="text" class="form-control" name="name" placeholder="Title" value="<?php if ($item_id<>"") echo $itemTodo['name']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>ZIP Code:</th>
                    <td>
                      <input type="text" class="form-control" name="zip_code" placeholder="Title" value="<?php if ($item_id<>"") echo $itemTodo['zip_code']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td>
                      <input type="text" class="form-control" name="city" placeholder="Title" value="<?php if ($item_id<>"") echo $itemTodo['city']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Street:</th>
                    <td>
                      <input type="text" class="form-control" name="street" placeholder="Title" value="<?php if ($item_id<>"") echo $itemTodo['street']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>House No:</th>
                    <td>
                      <input type="text" class="form-control" name="house_no" placeholder="Title" value="<?php if ($item_id<>"") echo $itemTodo['house_no']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>
                      <input type="text" class="form-control" name="description" placeholder="Title" value="<?php if ($item_id<>"") echo $itemTodo['description']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Website:</th>
                    <td>
                      <input type="text" class="form-control" name="website" placeholder="Title" value="<?php if ($item_id<>"") echo $itemTodo['website']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Type:</th>
                    <td>
                        <select type="number" class="form-control" name="todo_type">
                            <option value="museum">Museum</option>
                            <option value="historical site">Historical Site</option>
                            <option value="must see">Must See</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><button type ="submit" class="btn btn-dark border">Submit</button></td>
                <tr>
                </tr>
                    <td><a href="adminpanel.php"><button type="button" class="btn btn-dark border">Back to Adminpanel</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>