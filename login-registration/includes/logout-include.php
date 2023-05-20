<?php

/* per distruggere una session devo prima avviarla */
session_start();
session_unset();
session_destroy();

header("location: ../index.php?error=none");