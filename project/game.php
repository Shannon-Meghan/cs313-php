<?php ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Personal Project</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Game Page</h1>
        </header>
        <nav>
            <ul class="nav_ul">
                <li class="nav_li"><a href="index.html">Home</a></li>
                <li class="nav_li"><a href="assignments.html">Assignments</a></li>
                <li class="nav_li"><a href="aboutme.html">About Me</a></li>
                <li class="nav_li" id="proj_color"><a href="personalproject.html">Project</a></li>
            </ul>
        </nav>
        <img src="../spiderweb.jpg" alt="spiderweb" width="800" height="300">
        <h2>Game Page is under construction.</h2>
        <form action="./phpindex.php" method="post" name="game_form">
            <input type="hidden" name="action" value="game">
            <?php if ($click == true) : ?>
                <table>
                    <tr>
                        <td>Total Steps:</td>
                        <td><?php echo $total_steps ?></td>
                        <td>&nbsp;</td>
                    </tr>

                    <?php foreach ($items_array as $item): ?>   
                        <?php $value = $item[0]; ?>
                        <?php echo "<tr><td>Item: </td> <td>" . $value . "</td>" ?>           
                        <?php echo "<td>" ?>
                        <?php
                        $item_descriptions_array = select_item_description($value);
                        $desc_count = COUNT($item_descriptions_array);
                        $desc_index = $count - 2;
                        ?>
                        <?php for ($i = 0; $i <= $index; $i++) : ?>
                            <?php $item_description = $item_descriptions_array[$i]; ?>
                            <?php echo $item_description ?>
                        <?php endfor; ?>
                        <?php " </td> </tr>" ?>
                    <?php endforeach; ?>

                    <br>
                    <br>
                </table>
                <?php echo $story; ?>
            <?php endif; ?>
            <input type="submit" value="Click Me!">
        </form>
    </body>
</html>