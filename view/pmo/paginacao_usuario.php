<?php
// the page where this paging is used
$page_dom = "view_usuarios.php";
include_once '../../model/usuarioDAO.class.php';
include_once '../../config/database.class.php';

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = "";
}

$database = new Database();
$db = $database->getConnection();
$usuarioDAO = new usuarioDAO($db);



 
echo "<ul class=\"pagination\">";
 
// button for first page
if($page>1){
    echo "<li><a href='{$page_dom}' title='Go to the first page.'>";
        echo "<<";
    echo "</a></li>";
}
//numero de linhas por paginas
$records_per_page = 6;
// count all products in the database to calculate total pages
$total_rows = $usuarioDAO->countAll();
$total_pages = ceil($total_rows / $records_per_page);
 
// range de p�ginas a mostrar
$range = 5;
 
// mostra os link para 'range de p�ginas' em torno 'pagina atual'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
 
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
 
    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {
 
        // current page
        if ($x == $page) {
            echo "<li class='active'><a href=\"#\">$x <span class=\"sr-only\">(current)</span></a></li>";
        } 
 
        // not current page
        else {
            echo "<li><a href='{$page_dom}?page=$x'>$x</a></li>";
        }
    }
}
 
// button for last page
if($page<$total_pages){
    echo "<li><a href='" .$page_dom . "?page={$total_pages}' title='Last page is {$total_pages}.'>";
        echo ">>";
    echo "</a></li>";
}
 
echo "</ul>";
?>