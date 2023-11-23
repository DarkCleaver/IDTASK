<?php
include 'connection.php';

if ($_GET['action'] == 'delete') {
    $hasil = mysqli_query($db, "DELETE FROM books WHERE id='" . $_GET['id'] . "'");
    header('location:index.php');

} else if ($_GET['action'] == 'insert') {
    $name = $_FILES['cover']['name'];
    $savephoto = "img/" . date('h-i-s') . $name;
    move_uploaded_file($_FILES["cover"]["tmp_name"], $savephoto);

    $hasil = mysqli_query($db, "INSERT INTO books 
    (title,category_id,publish_at,photo) VALUES ('$_POST[title]','$_POST[category]','$_POST[publish]','$savephoto') ");
    header('location:index.php');

} else if ($_GET['action'] == 'update') {
    $name = $_FILES['cover']['name'];
    $savephoto = "img/" . date('h-i-s') . $name;
    move_uploaded_file($_FILES["cover"]["tmp_name"], $savephoto);

    $idToUpdate = mysqli_real_escape_string($db, $_GET['id']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $publish_at = mysqli_real_escape_string($db, $_POST['publish']);

    $hasil = mysqli_query($db, "UPDATE books SET 
    title = '$title', publish_at = '$publish_at', photo = '$savephoto' WHERE id = '$idToUpdate'");
    header('location:index.php');
}
