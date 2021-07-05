
<?php


function fetchPembimbing($conn)
{
    $query = "SELECT * FROM tb_pembimbing";
    $execQuery = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
    return $result;
}
