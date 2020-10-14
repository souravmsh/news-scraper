<div class="row search"> 
  <div class="col-md-6 col-md-offset-3"> 
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-tags"></i></span>
          <input type="search" class="form-control" id="input-search" placeholder="Search for...">
          <span class="input-group-addon"><i class="fa fa-globe"></i></span>
        </div>

  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<?php foreach ($news_world as $value): ?>
    <div class="col-md-6" id="<?= $value->newspaper_name ?>">
        <div class="panel panel-default coupon">
            <div class="panel-heading" id="head">
                <div class="panel-title" id="title">
                    <?= (isset($value->newspager_logo)?('<img src='.$value->newspager_logo.' alt="" >'):null) ;?>
                    <span><?= "<a target='_blank' href=".$value->newspaper_url.">".$value->newspaper_name."</a>" ?></span> 
                </div>
            </div> 

            <div class="panel-body">
            <?php
                #------------------------------#
                $url = $value->newspaper_rss_url;
                $rss = new DOMDocument();
                $rss->load($url);

                $feed = array();
                $counter = 0;
                $limit = 5;
                #------------------------------#
                foreach ($rss->getElementsByTagName($value->config_item) as $node):
                    $title = $node->getElementsByTagName($value->config_title)->item(0)->nodeValue;
                    $link = $node->getElementsByTagName($value->config_link)->item(0)->nodeValue; 
                    if(isset($node->getElementsByTagName($value->config_image)->item(0)->nodeValue)):
                        $image = $node->getElementsByTagName($value->config_image)->item(0)->nodeValue;
                    else:
                        $image = null;
                    endif;
                    $description = $node->getElementsByTagName($value->config_description)->item(0)->nodeValue;
                    #------------------------------#
                    echo "<div class=\"media news\">";
                        echo "<div class=\"media-left media-middle\">";
                            echo "<a href=".base_url("details?url=$link").">"; 
                                echo "<img class=\"media-object\" src=".(isset($image)?($image):base_url('public/img/icons/noimg.png'))." alt=\"\" >";
                            echo "</a>";
                        echo "</div>";
                        echo "<div class=\"media-body\">";
                            echo "<h4 class=\"media-heading\">".strip_tags(character_limiter($title, 55))."</h4>";  
                            echo "<p>";
                                echo character_limiter(filter_var($description,FILTER_SANITIZE_STRING),120);
                            echo "</p>"; 
                        echo "</div>";
                        echo "<div class=\"media-right\">";
                            echo "<a href=".base_url("details?url=$link")." class=\"btn btn-xs btn-primary\">Details</a>";
                        echo "</div>";
                    echo "</div>";
                    #------------------------------#
                    if($counter==$limit):
                        break;
                    endif;
                    $counter++;
                endforeach;
            ?>
            </div>
            <!-- ends of panel-body -->


            <div class="panel-footer">
                <div class="coupon-code">
                    Latest News
                    <span class="print">
                        <a href="javascript:vaoid(0)" class="btn btn-link"><i class="fa fa-lg fa-print"></i> Print</a>
                    </span>
                </div>
                <div class="exp"> <?= date("F j, Y, g:i a") ?></div>
            </div>
            <!-- ends of panel-footer -->

        </div>
    </div> 
<?php endforeach; ?>

