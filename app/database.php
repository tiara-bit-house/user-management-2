<?php

$conn = new mysqli('localhost', 'root', '', 'store');

if ($conn->connect_error) {
    die('Koneksi gagal');
}
