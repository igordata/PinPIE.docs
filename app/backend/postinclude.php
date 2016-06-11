<?php
echo '<br>Page time: ' . number_format((microtime(true) - PIN_TIME_START) * 1000, 3, '.', '') . "ms";
echo '<br>Memory: ' . humanBytes(memory_get_peak_usage() - PIN_MEMORY_START);
PinPIE::report();

