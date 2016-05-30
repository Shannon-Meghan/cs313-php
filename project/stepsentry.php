<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Steps Entry Page</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Steps Entry Page</h1>
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
        <form action='./phpindex.php' method='post' id='stepsentry_page'>
            <input type='hidden' name='action' value='enter_newsteps' />
            <table>                
                <tr>
                    <td>Total Steps:</td>
                    <td><?php echo $totalsteps ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Latest Steps:</td>
                    <td><input type='text' name='new_steps' /></td>
                    <td><input type='submit' value='Enter' /></td>
                </tr>
            </table>
        </form>
        <p><a href='./phpindex.php?action=startover'>Start over!</a></p>
    </body>
</html>

