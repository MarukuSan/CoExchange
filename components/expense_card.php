<?php
    function expense_card($group) {
        $template = 
        "
            <a class=\"expense_card\" href=\"./expense.php?id=%s\">
                <div>
                    <p><img src=\"./images/icones/icons8-sac-d'argent-96.png\"></p>
                    <b>%s</b>
                </div>
            </a>
        ";
        $template = sprintf($template, $group["id"], $group["name"]);

        echo $template;
    }
?>