<?php $currentFile=explode ('.', basename($_SERVER["REQUEST_URI"]));$currentFile=$currentFile[0] . '.php';$metaCurr=get_meta_tags($currentFile);      //echo '</ul>';$title=$metaCurr['description'];echo "<title>" . $title . "</title><nav id='bt-menu' class='bt-menu'>
    <a href='#' class='bt-menu-trigger'><span>Menu</span></a>
    <ul>
        <li  class='links txt myProjects'><a href='index.php'>Home</a></li>
        <li  class='links txt myProjects'><a href='projects.php'>Projects</a></li>  
        <li  class='links txt myResearch'><a href='research.php'>Research</a></li>
        <li  class='links txt myInterests'><a href='about.php'>About</a></li>

    </ul>
</nav>";
?>