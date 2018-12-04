<?php
/**
 * Created by PhpStorm.
 * User: paashaas
 * Date: 12/3/2018
 * Time: 22:11
 */
require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using

use Exchange\Api;

$names = Api::getNames(false);

?>
<html>
<body>
<pre>
    <?php
     var_dump($names);
    ?>
</pre>
</body>
</html>
