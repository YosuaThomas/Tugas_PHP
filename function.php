<?php


$conn = mysqli_connect("localhost", "root", "", "tugas_php");

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{

    $kontent = htmlspecialchars($data["kontent"]);

    global $conn;

    $query = "INSERT INTO konten
    VALUES 
    ('', '$kontent')";
    mysqli_query($conn, $query);

    return (mysqli_affected_rows($conn));
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM konten WHERE id = $id");
    return (mysqli_affected_rows($conn));
}


function ubah($data)
{
    $id = $data["id"];
    $list = htmlspecialchars($data["list"]);   

    global $conn;

    $query = "UPDATE konten SET 
                kontent = '$list'            
                WHERE id = $id
                ";
    mysqli_query($conn,$query);          
 
    return (mysqli_affected_rows($conn));
}


function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_escape_string($conn, $data["password2"]);

   $result =  mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>alert('username telah di gunakan')</script>";
        return false;
    }

    if($password != $password2){
        echo "<script>alert('password tidak sesuai')</script>";
        return false;
    }
    
    $password = password_hash($password, PASSWORD_DEFAULT);    

    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);




}