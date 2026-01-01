<?php
function hash_password($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}