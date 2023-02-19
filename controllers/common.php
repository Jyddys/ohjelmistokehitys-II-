<?php

// funktio muuntaa annetusta merkkijonosta koodin suorituksen kannalta oleellisia merkkejä 
//(kuten <>& vastaaviksi HTML-entitieksi

function escape($html)
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>