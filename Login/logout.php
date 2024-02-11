<?php

session_start();
session_destroy();
header("Location: UserUI_sample.php");
exit;