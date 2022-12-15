<?php
echo shell_exec('wmic DISKDRIVE GET SerialNumber 2>&1');

?>