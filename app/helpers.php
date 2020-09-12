<?php

function flash($message, $type = 'success') {
    session()->flash('message', $message);
    session()->flash('message_type', $type);
}
