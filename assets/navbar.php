<nav class="navbar navbar-dark" style="background: #272525">
        <a class="navbar-brand" href="/">The Blood Bank Application</a>
        <?php
        if($_SESSION['authenticated'] == null || $_SESSION['authenticated'] == false)
            echo "<button class=\"btn btn-danger my-2 my-sm-0\" onclick = \"location.href = `/login.php` \">Login</button>";
        else{
            echo '
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle" style="color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Welcome '.$_SESSION['id']. '
                </button>';
                echo '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
            if($_SESSION['type'] == 2)
                echo '<a class="dropdown-item" href="/AvailableSamples.php">Available Samples</a>';
                    
            echo ' 
            <a class="dropdown-item" href="/src/Logout.php">Logout</a>
            </div>';
        }
        ?>

</nav>