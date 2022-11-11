<?php
    function group_card($group) {
        $template = 
        "
            <a class=\"group_card\" href=\"./group.php?id=%s\">
                <div>
                    <p><img src=\"./images/icones/icons8-foule-96.png\"></p>
                    <b>%s</b>
                </div>
            </a>
        ";
        $template = sprintf($template, $group["id"], $group["name"]);

        echo $template;
    }
?>