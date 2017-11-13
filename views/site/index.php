<?php
use \yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Guest book</h1>

        <p class="lead">You can leave your review by clicking a button below.</p>

        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['/site/add-review'])?>">Add review</a></p>
    </div>

    <div class="body-content">
        <div class="row">
        <?php if(!empty($models)) : ?>
            <?php foreach ($models as $comment) : ?>
                <div class="col-lg-12">
                    <h2><?= $comment->author ? : 'Anonymous'?></h2>
                    <p>Created at: <?=date('h:i:s d.m.Y', $comment->update_time)?></p>
                    <p style="background-color: #fffad5; padding: 10px;"><?=$comment->text ? : ''?></p>
                    <p class="likes-counter">
                        <a class="likes" data-review="<?=$comment->id?>">
                            <span class="glyphicon glyphicon-heart"></span>
                        </a>
                        <span class="counter"><?=$comment->likes_counter > 0 ? $comment->likes_counter : ''?></span>
                    </p>
                    <?php if(!empty($comment->site_url)) : ?>
                        <p>Users website link: <a href="<?=$comment->site_url?>" target="_blank"><?=$comment->site_url?></a></p>
                    <?php endif; ?>
                    <?php if(!empty($comment->media)) :?>
                        <div class="animated-thumbnails">
                        <?php foreach ($comment->media as $picture) :?>
                            <a href="/<?=$picture->url?>">
                                <img src="/<?=$picture->url?>" style="height:100px">
                            </a>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <h3 class="text-center">There no reviews yet. Leave the first one!</h3>
        <?php endif;?>
        </div>
    </div>
</div>
