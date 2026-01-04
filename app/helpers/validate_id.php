<?php
function validateId($id): ?int
{
    if ($id === null) {
        return null;
    }

    $id = (int) $id;

    return $id > 0 ? $id : null;
}
