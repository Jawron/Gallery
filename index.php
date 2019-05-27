<?php include("includes/header.php"); ?>
<?php

$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1 ;

$page_items = 4;

$total_items= Photo::countAll();

$paginate = new Paginate($page,$page_items,$total_items);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$page_items} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::findByQuery($sql);

?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">
                <?php foreach($photos as $photo){ ?>


                        <div class="col-xs-12 col-md-12">
                            <a href="photo.php?id=<?php echo $photo->id ;?>" class="thumbnail">
                                <img class="img-responsive homepage_photo" src="admin/<?php echo $photo->picturePath($photo->filename) ;?>">
                            </a>
                        </div>



                <?php } ?>
                </div>
                <div class="row">
                    <ul class="pager">
                        <?php
                            if($paginate->totalPages() > 1){

                                if($paginate->hasNext()){
                                    echo "<li class=\"next\">
                                            <a href=\"index.php?page={$paginate->next()}\">Next</a>
                                          </li>";
                                }

                                for($i = 1; $i <= $paginate->totalPages(); $i++){
                                    if($i == $paginate->current_page) {
                                        echo " <li class='active'><a href=\"index.php?page={$i}\">$i</a></li>";
                                    } else {
                                        echo " <li><a href=\"index.php?page={$i}\">$i</a></li>";
                                    }
                                }

                                if($paginate->hasPrev()){
                                    echo "<li class=\"previous\">
                                            <a href=\"index.php?page={$paginate->prev()}\">Prev</a>
                                           </li>";
                                }


                            }

                        ?>


                    </ul>
                </div>



            </div>
        </div>

        <?php include("includes/footer.php"); ?>
