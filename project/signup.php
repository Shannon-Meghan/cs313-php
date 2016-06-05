<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up Page</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Sign Up Page</h1>
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
        <form action="./phpindex.php" method="post">
            <input type="hidden" name="action" value="signup" />
            <?php echo $error ?>
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Sign Up" /></td>
                </tr>
            </table>
        </form> 
        <p><a href="./phpindex.php?action=signin">Already have an account? Sign in!</a></p>
    </body>
</html>