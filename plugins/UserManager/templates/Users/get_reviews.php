 <div class="row TPContent">
    <div class="col-md-12 TPBbox">
        <h5 class="rating"><span><?= round($avg,1) ?> / 5</span>
            <?php for($s = 1; $s <= 5; $s++){
                if($s <= round($avg)){
                    echo '<i class="glyphicon glyphicon-star"></i>';
                }else{
                    echo '<i class="glyphicon glyphicon-star-empty" style=""></i>';
                }
            } ?>
         - <?= $reviews->count() ?> Rating</h5>
        <?php foreach($reviews as $review){ ?>
        <div class="col-md-12 ratebox">
            <p class="user"><?= $review->name ?><span><?= $review->designation ?></span></p>
            <p class="user">
                <?php for($s = 1; $s <= 5; $s++){
                    if($s <= $review->rating){
                        echo '<i class="glyphicon glyphicon-star"></i>';
                    }else{
                        echo '<i class="glyphicon glyphicon-star-empty" style=""></i>';
                    }
                } ?>
            </p>
            <p class="comment"><?php
                        echo $this->Text->truncate($review->description,450,
                                [
                                    'ellipsis' => '...',
                                    'exact' => false
                                ]
                            );
                            ?></p>
        </div>
    <?php } ?>
    </div>
</div>